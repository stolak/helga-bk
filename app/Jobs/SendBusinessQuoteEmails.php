<?php

namespace App\Jobs;

use App\Mail\BusinessQuoteAutoReply;
use App\Mail\BusinessQuoteToOfficial;
use App\Models\BusinessQuote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBusinessQuoteEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $quoteId;

    public function __construct(int $quoteId)
    {
        $this->quoteId = $quoteId;
    }

    public function handle(): void
    {
        $quote = BusinessQuote::find($this->quoteId);
        if (!$quote) {
            return;
        }

        $officialEmail = env('Coy_Email', env('OFFICIAL_EMAIL', config('mail.from.address', 'info@domain.com')));
        $officialEmail = is_string($officialEmail) ? preg_replace('/\s+/', '', $officialEmail) : '';
        if (!filter_var($officialEmail, FILTER_VALIDATE_EMAIL)) {
            Log::error('BusinessQuote official mail skipped - invalid official email', [
                'quote_id' => $this->quoteId,
                'official_email' => $officialEmail,
            ]);
            return;
        }

        $officialName = env('Coy_Name', config('mail.from.name', 'Official'));

        // Mail to official email (reply-to is requester)
        try {
            Mail::to($officialEmail)->send(new BusinessQuoteToOfficial($quote, $officialName));
        } catch (\Throwable $e) {
            Log::error('BusinessQuote official mail failed', [
                'quote_id' => $this->quoteId,
                'official_email' => $officialEmail,
                'error' => $e->getMessage(),
            ]);
        }

        // Auto reply to requester
        try {
            Mail::to($quote->businessEmail)->send(new BusinessQuoteAutoReply($quote, $officialName));
        } catch (\Throwable $e) {
            Log::error('BusinessQuote auto-reply mail failed', [
                'quote_id' => $this->quoteId,
                'user_email' => $quote->businessEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }
}

