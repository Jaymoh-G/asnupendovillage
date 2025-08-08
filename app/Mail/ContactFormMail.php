<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $phone;
    public $formMessage; // renamed from $message
    public $timestamp;

    public function __construct($contactData)
    {
        $this->name = (string) $contactData['name'];
        $this->email = (string) $contactData['email'];
        $this->subject = (string) $contactData['subject'];
        $this->phone = (string) ($contactData['phone'] ?? '');
        $this->formMessage = (string) $contactData['message']; // renamed here
        $this->timestamp = date('F j, Y \a\t g:i A');
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission - ASN Upendo Village')
                    ->view('emails.contact-form');
    }
}
