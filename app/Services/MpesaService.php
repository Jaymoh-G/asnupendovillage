<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class MpesaService
{
    protected $baseUrl;
    protected $consumerKey;
    protected $consumerSecret;
    protected $passkey;
    protected $shortcode;
    protected $environment;

    public function __construct()
    {
        $this->environment = config('services.mpesa.environment', 'sandbox');
        $this->baseUrl = $this->environment === 'live'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';

        $this->consumerKey = config('services.mpesa.consumer_key');
        $this->consumerSecret = config('services.mpesa.consumer_secret');
        $this->passkey = config('services.mpesa.passkey');
        $this->shortcode = config('services.mpesa.shortcode');
    }

    /**
     * Get access token for M-Pesa API
     */
    public function getAccessToken()
    {
        $cacheKey = 'mpesa_access_token';

        // Check if we have a cached token
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
                ->get($this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials');

            if ($response->successful()) {
                $data = $response->json();
                $accessToken = $data['access_token'];

                // Cache the token for 55 minutes (tokens expire in 1 hour)
                Cache::put($cacheKey, $accessToken, now()->addMinutes(55));

                return $accessToken;
            }
        } catch (\Exception $e) {
            Log::error('Failed to get M-Pesa access token: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Initiate STK Push
     */
    public function initiateSTKPush($phoneNumber, $amount, $reference, $description = 'Donation')
    {
        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Failed to get access token');
            }

            // Format phone number (remove + and add 254 if needed)
            $formattedPhone = $this->formatPhoneNumber($phoneNumber);

            $timestamp = date('YmdHis');
            $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

            $payload = [
                'BusinessShortCode' => $this->shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $formattedPhone,
                'PartyB' => $this->shortcode,
                'PhoneNumber' => $formattedPhone,
                'CallBackURL' => route('mpesa.callback'),
                'AccountReference' => $reference,
                'TransactionDesc' => $description,
            ];

            $response = Http::withToken($accessToken)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', $payload);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['CheckoutRequestID'])) {
                    // Store the request for callback processing
                    Cache::put('mpesa_request_' . $data['CheckoutRequestID'], [
                        'phone' => $formattedPhone,
                        'amount' => $amount,
                        'reference' => $reference,
                        'description' => $description,
                        'timestamp' => now(),
                    ], now()->addHours(24));

                    return [
                        'success' => true,
                        'checkout_request_id' => $data['CheckoutRequestID'],
                        'merchant_request_id' => $data['MerchantRequestID'] ?? null,
                        'message' => 'STK push sent successfully. Please check your phone.',
                    ];
                } else {
                    throw new \Exception('Invalid response from M-Pesa API');
                }
            } else {
                $errorData = $response->json();
                throw new \Exception($errorData['errorMessage'] ?? 'Failed to initiate STK push');
            }
        } catch (\Exception $e) {
            Log::error('STK Push failed: ' . $e->getMessage(), [
                'phone' => $phoneNumber,
                'amount' => $amount,
                'reference' => $reference,
            ]);

            return [
                'success' => false,
                'message' => 'Failed to initiate payment: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Format phone number for M-Pesa API
     */
    protected function formatPhoneNumber($phone)
    {
        // Remove any non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If it starts with 0, replace with 254
        if (substr($phone, 0, 1) === '0') {
            $phone = '254' . substr($phone, 1);
        }

        // If it starts with +254, remove the +
        if (substr($phone, 0, 4) === '+254') {
            $phone = substr($phone, 1);
        }

        // If it doesn't start with 254, add it
        if (substr($phone, 0, 3) !== '254') {
            $phone = '254' . $phone;
        }

        return $phone;
    }

    /**
     * Check transaction status
     */
    public function checkTransactionStatus($checkoutRequestId)
    {
        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('Failed to get access token');
            }

            $timestamp = date('YmdHis');
            $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

            $payload = [
                'BusinessShortCode' => $this->shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'CheckoutRequestID' => $checkoutRequestId,
            ];

            $response = Http::withToken($accessToken)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($this->baseUrl . '/mpesa/stkpushquery/v1/query', $payload);

            if ($response->successful()) {
                return $response->json();
            } else {
                $errorData = $response->json();
                throw new \Exception($errorData['errorMessage'] ?? 'Failed to check transaction status');
            }
        } catch (\Exception $e) {
            Log::error('Transaction status check failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Process callback from M-Pesa
     */
    public function processCallback($callbackData)
    {
        try {
            $checkoutRequestId = $callbackData['CheckoutRequestID'] ?? null;
            $resultCode = $callbackData['ResultCode'] ?? null;
            $resultDesc = $callbackData['ResultDesc'] ?? null;
            $amount = $callbackData['Amount'] ?? null;
            $mpesaReceiptNumber = $callbackData['MpesaReceiptNumber'] ?? null;
            $transactionDate = $callbackData['TransactionDate'] ?? null;
            $phoneNumber = $callbackData['PhoneNumber'] ?? null;

            if (!$checkoutRequestId) {
                throw new \Exception('Missing CheckoutRequestID in callback');
            }

            // Get stored request data
            $requestData = Cache::get('mpesa_request_' . $checkoutRequestId);

            if (!$requestData) {
                throw new \Exception('Request data not found for: ' . $checkoutRequestId);
            }

            // Process the result
            if ($resultCode === 0) {
                // Success
                $this->handleSuccessfulPayment($checkoutRequestId, $requestData, [
                    'mpesa_receipt_number' => $mpesaReceiptNumber,
                    'transaction_date' => $transactionDate,
                    'phone_number' => $phoneNumber,
                    'amount' => $amount,
                ]);
            } else {
                // Failed
                $this->handleFailedPayment($checkoutRequestId, $requestData, $resultDesc);
            }

            // Clean up cache
            Cache::forget('mpesa_request_' . $checkoutRequestId);

            return true;
        } catch (\Exception $e) {
            Log::error('M-Pesa callback processing failed: ' . $e->getMessage(), [
                'callback_data' => $callbackData,
            ]);
            return false;
        }
    }

    /**
     * Handle successful payment
     */
    protected function handleSuccessfulPayment($checkoutRequestId, $requestData, $mpesaData)
    {
        try {
            // Find the donation by reference
            $donation = \App\Models\Donation::where('transaction_reference', $requestData['reference'])->first();

            if ($donation) {
                $donation->update([
                    'status' => 'completed',
                    'transaction_reference' => 'MPESA-' . $mpesaData['mpesa_receipt_number'],
                    'meta' => array_merge($donation->meta ?? [], [
                        'mpesa_receipt_number' => $mpesaData['mpesa_receipt_number'],
                        'mpesa_transaction_date' => $mpesaData['transaction_date'],
                        'mpesa_phone_number' => $mpesaData['phone_number'],
                        'checkout_request_id' => $checkoutRequestId,
                        'payment_completed_at' => now(),
                    ]),
                ]);

                Log::info('M-Pesa payment completed successfully', [
                    'donation_id' => $donation->id,
                    'mpesa_receipt' => $mpesaData['mpesa_receipt_number'],
                    'amount' => $mpesaData['amount'],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to handle successful M-Pesa payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle failed payment
     */
    protected function handleFailedPayment($checkoutRequestId, $requestData, $resultDesc)
    {
        try {
            // Find the donation by reference
            $donation = \App\Models\Donation::where('transaction_reference', $requestData['reference'])->first();

            if ($donation) {
                $donation->update([
                    'status' => 'failed',
                    'meta' => array_merge($donation->meta ?? [], [
                        'failure_reason' => $resultDesc,
                        'checkout_request_id' => $checkoutRequestId,
                        'payment_failed_at' => now(),
                    ]),
                ]);

                Log::info('M-Pesa payment failed', [
                    'donation_id' => $donation->id,
                    'reason' => $resultDesc,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to handle failed M-Pesa payment: ' . $e->getMessage());
        }
    }
}
