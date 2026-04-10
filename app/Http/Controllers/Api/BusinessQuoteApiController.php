<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendBusinessQuoteEmails;
use App\Models\BusinessQuote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessQuoteApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'businessName' => 'required|string|max:255',
            'contactPerson' => 'required|string|max:255',
            'businessEmail' => 'required|email|max:255',
            'businessPhone' => 'nullable|string|max:50',
            'businessType' => 'nullable|string|max:255',
            'pickupNeeded' => 'nullable|boolean',
            'volume' => 'nullable|string|max:255',
            'quoteMessage' => 'nullable|string|max:10000',
        ]);

        $quote = BusinessQuote::create($request->only([
            'businessName',
            'contactPerson',
            'businessEmail',
            'businessPhone',
            'businessType',
            'pickupNeeded',
            'volume',
            'quoteMessage',
        ]));

        // Queue (or at least send after the HTTP response) so user doesn't wait.
        SendBusinessQuoteEmails::dispatch($quote->id)
            ->onConnection('database')
            ->onQueue('default')
            ->afterCommit()
            ->afterResponse();

        return response()->json([
            'message' => 'Your quote request has been received. We will get back to you soon.',
            'data' => [
                'id' => $quote->id,
            ],
        ], 201);
    }
}

