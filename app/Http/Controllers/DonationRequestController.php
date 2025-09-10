<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DonationRequestController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'required|string|max:50',
            'amount' => 'required|numeric|min:1',
            'preferred_payment_method' => 'required|string|in:mpesa,paypal,bank,other',
            'preferred_contact_method' => 'nullable|string|in:email,phone',
            'currency' => 'nullable|string|max:10',
            'donation_purpose' => 'nullable|string|max:500',
            'message' => 'nullable|string|max:2000',
        ]);

        $toEmail = \App\Models\Setting::get('contact_email', 'info@asnupendovillage.org');

        try {
            $lines = [
                'New Donation Request',
                '',
                'Name: ' . $validated['donor_name'],
                'Email: ' . $validated['donor_email'],
                'Phone: ' . $validated['donor_phone'],
                'Amount: ' . $validated['amount'] . (!empty($validated['currency']) ? (' ' . $validated['currency']) : ''),
                'Preferred Payment Method: ' . strtoupper($validated['preferred_payment_method']),
                'Preferred Contact Method: ' . (!empty($validated['preferred_contact_method']) ? ucfirst($validated['preferred_contact_method']) : 'Not specified'),
                'Donation Purpose: ' . (!empty($validated['donation_purpose']) ? $validated['donation_purpose'] : 'N/A'),
                'Message: ' . (!empty($validated['message']) ? $validated['message'] : 'N/A'),
            ];

            Mail::raw(implode("\n", $lines), function ($message) use ($toEmail) {
                $message->to($toEmail)
                    ->subject('Donation Request');
            });

            return back()->with('success', 'Your donation request has been sent. We will contact you shortly.');
        } catch (\Throwable $e) {
            Log::error('Donation request email failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send your request. Please try again later.');
        }
    }
}
