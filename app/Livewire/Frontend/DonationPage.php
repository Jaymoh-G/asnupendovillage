<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Donation;
use App\Models\StaticPage;
use App\Models\PageBanner;
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



    public function donate()
    {
        // Debug: Log that the method is being called
        Log::info('Donation form submitted', [
            'donor_name' => $this->donor_name,
            'donor_email' => $this->donor_email,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount
        ]);

        $this->validate();

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
        // For now, we'll simulate M-Pesa payment
        // In a real implementation, you would integrate with M-Pesa API
        $donation->update([
            'status' => 'completed',
            'transaction_reference' => 'MPESA-' . Str::random(8),
        ]);

        $this->showSuccess = true;
        $this->resetForm();
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

    public function render()
    {
        return view('livewire.frontend.donation-page');
    }
}
