<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Donation;
use App\Models\StaticPage;
use App\Models\PageBanner;
use App\Services\MpesaService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DonationPage extends Component
{
    public $donor_name = '';
    public $donor_email = '';
    public $donor_phone = '';
    public $amount = '';
    public $currency = 'KES';
    public $payment_method = '';
    public $message = '';
    public $showSuccess = false;
    public $showError = false;
    public $errorMessage = '';

    // M-Pesa specific properties
    public $mpesaProcessing = false;
    public $mpesaCheckoutId = null;
    public $mpesaStatus = null;
    public $mpesaSuccessMessage = '';

    // Static page content properties
    public $pageBanner;
    public $pageContent;

    protected $rules = [
        'donor_name' => 'required|min:2|max:255',
        'donor_email' => 'required|email',
        'donor_phone' => 'required|min:10|max:15',
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required|in:mpesa,paypal,bank',
        'message' => 'nullable|max:500',
    ];

    public function mount()
    {
        // Set default currency based on location or preference
        $this->currency = 'KES';

        // Fetch static page content for donation page
        $this->pageBanner = PageBanner::getBannerForPage('donation');
        $this->pageContent = StaticPage::getByPageName('donation');
    }

    public function updatedPaymentMethod()
    {
        // Reset any payment-specific validation
        $this->resetValidation();
    }

    /**
     * Validate M-Pesa phone number format
     */
    /**
     * Validate M-Pesa phone number format
     */
    public function validatePhoneNumber()
    {
        // Only validate if M-Pesa is selected
        if ($this->payment_method !== 'mpesa') {
            return true;
        }

        // Clear any existing errors first
        $this->resetErrorBag();

        $phone = $this->donor_phone;

        // Remove any non-digit characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Check if it's a valid Kenyan phone number
        if (strlen($cleanPhone) < 9 || strlen($cleanPhone) > 12) {
            $this->addError('donor_phone', 'Phone number must be between 9 and 12 digits.');
            return false;
        }

        // Check if it starts with valid Kenyan prefixes
        $validPrefixes = ['254', '07', '01', '11', '13', '15', '16', '17', '18'];
        $isValid = false;

        foreach ($validPrefixes as $prefix) {
            if (strpos($cleanPhone, $prefix) === 0) {
                $isValid = true;
                break;
            }
        }

        if (!$isValid) {
            $this->addError('donor_phone', 'Please enter a valid Kenyan phone number (e.g., 0712345678, +254712345678, or 254712345678).');
            return false;
        }

        return true;
    }





    public function donate()
    {
        // Debug: Log that the method is being called
        Log::info('Donation form submitted', [
            'donor_name' => $this->donor_name,
            'donor_email' => $this->donor_email,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount
        ]);

        // Validate basic rules first
        $this->validate();

        // Additional validation for M-Pesa phone numbers
        if ($this->payment_method === 'mpesa' && !$this->validatePhoneNumber()) {
            return;
        }

        try {
            // Create donation record
            $donation = Donation::create([
                'donor_name' => $this->donor_name,
                'donor_email' => $this->donor_email,
                'donor_phone' => $this->donor_phone,
                'amount' => $this->amount,
                'currency' => $this->currency,
                'payment_method' => $this->payment_method,
                'status' => 'pending',
                'transaction_reference' => 'DON-' . Str::random(10),
                'meta' => [
                    'message' => $this->message,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ],
            ]);

            // Process payment based on method
            if ($this->payment_method === 'mpesa') {
                return $this->processMpesaPayment($donation);
            } elseif ($this->payment_method === 'paypal') {
                return $this->processPayPalPayment($donation);
            } elseif ($this->payment_method === 'bank') {
                return $this->processBankPayment($donation);
            }
        } catch (\Exception $e) {
            $this->showError = true;
            $this->errorMessage = 'An error occurred while processing your donation. Please try again.';
        }
    }

    private function processMpesaPayment($donation)
    {
        try {
            $this->mpesaProcessing = true;
            $this->mpesaStatus = 'initiating';

            // Create M-Pesa service instance
            $mpesaService = new MpesaService();

            // Initiate STK push
            $result = $mpesaService->initiateSTKPush(
                $this->donor_phone,
                $this->amount,
                $donation->transaction_reference,
                'Donation to ASN Upendo Village'
            );

            if ($result['success']) {
                $this->mpesaCheckoutId = $result['checkout_request_id'];
                $this->mpesaStatus = 'pending';
                $this->mpesaSuccessMessage = 'STK push sent successfully! Please check your phone and enter your M-Pesa PIN to complete the payment.';

                // Update donation with checkout ID
                $donation->update([
                    'meta' => array_merge($donation->meta ?? [], [
                        'mpesa_checkout_id' => $result['checkout_request_id'],
                        'mpesa_merchant_id' => $result['merchant_request_id'],
                        'stk_push_sent_at' => now(),
                    ]),
                ]);

                // Start polling for status
                $this->startMpesaStatusPolling();
            } else {
                $this->mpesaStatus = 'failed';
                $this->showError = true;
                $this->errorMessage = $result['message'];

                // Update donation status to failed
                $donation->update(['status' => 'failed']);
            }
        } catch (\Exception $e) {
            $this->mpesaStatus = 'failed';
            $this->showError = true;
            $this->errorMessage = 'Failed to initiate M-Pesa payment: ' . $e->getMessage();

            // Update donation status to failed
            $donation->update(['status' => 'failed']);

            Log::error('M-Pesa payment initiation failed: ' . $e->getMessage());
        } finally {
            $this->mpesaProcessing = false;
        }
    }

    private function processPayPalPayment($donation)
    {
        // For now, we'll simulate PayPal payment
        // In a real implementation, you would integrate with PayPal API
        $donation->update([
            'status' => 'completed',
            'transaction_reference' => 'PAYPAL-' . Str::random(8),
        ]);

        $this->showSuccess = true;
        $this->resetForm();
    }

    private function processBankPayment($donation)
    {
        // For bank transfers, we'll set status to pending until confirmation
        // In a real implementation, you would send bank details and wait for confirmation
        $donation->update([
            'status' => 'pending',
            'transaction_reference' => 'BANK-' . Str::random(8),
        ]);

        $this->showSuccess = true;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['donor_name', 'donor_email', 'donor_phone', 'amount', 'payment_method', 'message']);
    }

    /**
     * Start polling for M-Pesa payment status
     */
    private function startMpesaStatusPolling()
    {
        if (!$this->mpesaCheckoutId) {
            return;
        }

        // Poll for status every 5 seconds for up to 2 minutes
        $this->dispatch('start-mpesa-polling', [
            'checkoutId' => $this->mpesaCheckoutId,
            'maxAttempts' => 24, // 2 minutes with 5-second intervals
        ]);
    }

    /**
     * Check M-Pesa payment status
     */
    public function checkMpesaStatus()
    {
        if (!$this->mpesaCheckoutId) {
            return;
        }

        try {
            $mpesaService = new MpesaService();
            $status = $mpesaService->checkTransactionStatus($this->mpesaCheckoutId);

            if ($status && isset($status['ResultCode'])) {
                if ($status['ResultCode'] === 0) {
                    // Payment successful
                    $this->mpesaStatus = 'completed';
                    $this->mpesaSuccessMessage = 'M-Pesa payment completed successfully! You will receive a confirmation SMS shortly.';
                    $this->showSuccess = true;
                    $this->resetForm();

                    // Find and update the donation
                    $donation = Donation::where('meta->mpesa_checkout_id', $this->mpesaCheckoutId)->first();
                    if ($donation) {
                        $donation->update(['status' => 'completed']);
                    }
                } elseif ($status['ResultCode'] === 1032) {
                    // User cancelled
                    $this->mpesaStatus = 'cancelled';
                    $this->showError = true;
                    $this->errorMessage = 'Payment was cancelled by user.';
                } elseif ($status['ResultCode'] === 1037) {
                    // Timeout
                    $this->mpesaStatus = 'timeout';
                    $this->showError = true;
                    $this->errorMessage = 'Payment request timed out. Please try again.';
                } else {
                    // Other failure
                    $this->mpesaStatus = 'failed';
                    $this->showError = true;
                    $this->errorMessage = 'Payment failed: ' . ($status['ResultDesc'] ?? 'Unknown error');
                }
            }
        } catch (\Exception $e) {
            Log::error('M-Pesa status check failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.frontend.donation-page');
    }
}
