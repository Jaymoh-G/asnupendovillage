<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\DonationFormMail;

class DonationRequestController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'required|string|max:50',
            'amount' => 'nullable|numeric|min:1',
            'preferred_payment_method' => 'required|string|in:mpesa,paypal,bank,other',
            'preferred_contact_method' => 'nullable|string|in:email,phone',
            'currency' => 'nullable|string|max:10',
            'donation_purpose' => 'nullable|string|max:500',
            'message' => 'nullable|string|max:2000',
        ]);

        $toEmail = \App\Models\Setting::get('donation_email')
            ?: \App\Models\Setting::get('contact_email')
            ?: 'info@breezetech.co.ke';

        try {
            // Send beautifully formatted HTML email
            Mail::to($toEmail)->send(new DonationFormMail($validated));

            return back()->with('success', 'Your donation request has been sent. We will contact you shortly.');
        } catch (\Throwable $e) {
            Log::error('Donation request email failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send your request. Please try again later.');
        }
    }
}
