<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Prepare email data
            $emailData = [
                'name' => (string) $request->name,
                'email' => (string) $request->email,
                'subject' => (string) $request->subject,
                'message' => (string) $request->message,
                'phone' => $request->phone ? (string) $request->phone : '',
            ];

            // Debug: Log the email data types
            Log::info('Email data types', [
                'name_type' => gettype($emailData['name']),
                'email_type' => gettype($emailData['email']),
                'subject_type' => gettype($emailData['subject']),
                'message_type' => gettype($emailData['message']),
                'phone_type' => gettype($emailData['phone']),
                'name_value' => $emailData['name'],
                'email_value' => $emailData['email'],
                'subject_value' => $emailData['subject'],
                'message_value' => $emailData['message'],
                'phone_value' => $emailData['phone'],
            ]);

            // Log the attempt
            Log::info('Contact form submission attempt', $emailData);

            // Send email
            $adminEmail = \App\Models\Setting::get('contact_email', 'info@asnupendovillage.org');

            Mail::to($adminEmail)->send(new ContactFormMail($emailData));

            Log::info('Contact form email sent successfully');

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We will get back to you soon.'
            ]);
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'form_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
