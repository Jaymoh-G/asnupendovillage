<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\MpesaService;

class MpesaController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    /**
     * Handle M-Pesa callback
     */
    public function callback(Request $request)
    {
        try {
            Log::info('M-Pesa callback received', $request->all());

            // Validate the callback data
            $callbackData = $request->all();

            if (empty($callbackData)) {
                Log::error('Empty callback data received');
                return response()->json(['status' => 'error', 'message' => 'Empty callback data'], 400);
            }

            // Process the callback
            $result = $this->mpesaService->processCallback($callbackData);

            if ($result) {
                Log::info('M-Pesa callback processed successfully');
                return response()->json(['status' => 'success', 'message' => 'Callback processed successfully']);
            } else {
                Log::error('Failed to process M-Pesa callback');
                return response()->json(['status' => 'error', 'message' => 'Failed to process callback'], 500);
            }
        } catch (\Exception $e) {
            Log::error('M-Pesa callback error: ' . $e->getMessage(), [
                'callback_data' => $request->all(),
                'exception' => $e,
            ]);

            return response()->json(['status' => 'error', 'message' => 'Internal server error'], 500);
        }
    }

    /**
     * Check transaction status
     */
    public function checkStatus(Request $request)
    {
        try {
            $checkoutRequestId = $request->input('checkout_request_id');

            if (!$checkoutRequestId) {
                return response()->json(['status' => 'error', 'message' => 'Checkout request ID is required'], 400);
            }

            $status = $this->mpesaService->checkTransactionStatus($checkoutRequestId);

            if ($status) {
                return response()->json(['status' => 'success', 'data' => $status]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to check status'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Transaction status check error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Internal server error'], 500);
        }
    }
}
