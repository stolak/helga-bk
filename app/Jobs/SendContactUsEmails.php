<?php

namespace App\Jobs;

use App\Mail\ContactUsAutoReply;
use App\Mail\ContactUsToOfficial;
use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContactUsEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $contactId;

    public function __construct(int $contactId)
    {
        $this->contactId = $contactId;
    }

    public function handle(): void
    {
        //  Log::info('Sending contact us emails', ['contact_id' => $this->contactId]);
        $contact = ContactUs::find($this->contactId);
        if (!$contact) {
            return;
        }

        $officialEmail = env('Coy_Email', env('OFFICIAL_EMAIL', config('mail.from.address', 'info@domain.com')));
        $officialEmail = is_string($officialEmail) ? preg_replace('/\s+/', '', $officialEmail) : '';
        if (!filter_var($officialEmail, FILTER_VALIDATE_EMAIL)) {
            Log::error('ContactUs official mail skipped - invalid official email', [
                'contact_id' => $this->contactId,
                'official_email' => $officialEmail,
            ]);
            return;
        }
        $officialName = env('Coy_Name', config('mail.from.name', 'Official'));

        // Mail to official email (reply-to is user)
        try {
            Mail::to($officialEmail)->send(new ContactUsToOfficial($contact, $officialName));
        } catch (\Throwable $e) {
            Log::error('ContactUs official mail failed', [
                'contact_id' => $this->contactId,
                'official_email' => $officialEmail,
                'error' => $e->getMessage(),
            ]);
        }

        // Auto reply to user
        try {
            Mail::to($contact->email)->send(new ContactUsAutoReply($contact, $officialName));
        } catch (\Throwable $e) {
            Log::error('ContactUs auto-reply mail failed', [
                'contact_id' => $this->contactId,
                'user_email' => $contact->email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}

