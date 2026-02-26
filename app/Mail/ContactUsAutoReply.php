<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public ContactUs $contact;
    public string $officialName;

    public function __construct(ContactUs $contact, string $officialName)
    {
        $this->contact = $contact;
        $this->officialName = $officialName;
    }

    public function build()
    {
        return $this
            ->subject('We received your message')
            ->view('emails.contact_us_autoreply');
    }
}

