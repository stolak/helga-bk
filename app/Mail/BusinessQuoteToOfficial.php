<?php

namespace App\Mail;

use App\Models\BusinessQuote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BusinessQuoteToOfficial extends Mailable
{
    use Queueable, SerializesModels;

    public BusinessQuote $quote;
    public string $officialName;

    public function __construct(BusinessQuote $quote, string $officialName)
    {
        $this->quote = $quote;
        $this->officialName = $officialName;
    }

    public function build()
    {
        $subject = 'Business Quote Request: ' . $this->quote->businessName;

        return $this
            ->subject($subject)
            ->replyTo($this->quote->businessEmail, $this->quote->contactPerson)
            ->view('emails.business_quote_official');
    }
}

