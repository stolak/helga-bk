<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsToOfficial extends Mailable
{
    use Queueable, SerializesModels;

    public ContactUs $contact;
    public string $officialName;

    public function __construct(ContactUs $contact, string $officialName)
    {
        $this->contact = $contact;
        $this->officialName = $this->contact->name;
    }

    public function build()
    {
        return $this
            ->subject('Contact Us: ' . $this->contact->subject)
            ->replyTo($this->contact->email, $this->contact->name)
            ->view('emails.contact_us_official');
    }
}

