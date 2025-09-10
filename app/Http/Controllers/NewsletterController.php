<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $apiKey = config('services.mailchimp.key');
        $listId = config('services.mailchimp.list_id');

        if (empty($apiKey) || empty($listId)) {
            return back()->with('error', 'Subscription service is not configured.');
        }

        $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
        $endpoint = "https://{$dataCenter}.api.mailchimp.com/3.0/lists/{$listId}/members";

        $response = Http::withBasicAuth('anystring', $apiKey)
            ->acceptJson()
            ->post($endpoint, [
                'email_address' => $validated['email'],
                'status' => 'subscribed',
            ]);

        if ($response->successful() || ($response->status() === 400 && str_contains($response->body(), 'is already a list member'))) {
            return back()->with('success', 'Thanks for subscribing!');
        }

        return back()->with('error', 'Could not subscribe at this time. Please try again later.');
    }
}
