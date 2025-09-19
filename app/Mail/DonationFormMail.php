<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donorName;
    public $donorEmail;
    public $donorPhone;
    public $amount;
    public $currency;
    public $paymentMethod;
    public $contactMethod;
    public $donationPurpose;
    public $donorMessage;
    public $timestamp;

    public function __construct($donationData)
    {
        $this->donorName = (string) $donationData['donor_name'];
        $this->donorEmail = (string) $donationData['donor_email'];
        $this->donorPhone = (string) $donationData['donor_phone'];
        $this->amount = $donationData['amount'] ?? null;
        $this->currency = $donationData['currency'] ?? 'KES';
        $this->paymentMethod = (string) $donationData['preferred_payment_method'];
        $this->contactMethod = $donationData['preferred_contact_method'] ?? null;
        $this->donationPurpose = $donationData['donation_purpose'] ?? null;
        $this->donorMessage = $donationData['message'] ?? null;
        $this->timestamp = date('F j, Y \a\t g:i A');
    }

    public function build()
    {
        return $this->subject('New Donation Request - ASN Upendo Village')
            ->view('emails.donation-form');
    }
}
