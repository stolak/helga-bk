<?php

namespace App\Mail;

use App\Models\BusinessQuote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BusinessQuoteAutoReply extends Mailable
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
        return $this
            ->subject('We received your quote request')
            ->view('emails.business_quote_autoreply');
    }
}

