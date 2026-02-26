<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendContactUsEmails;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactUsApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
        ]);

        $contact = ContactUs::create($request->only([
            'name',
            'email',
            'phone_number',
            'subject',
            'content',
        ]));

        // Queue (or at least send after the HTTP response) so user doesn't wait.
        SendContactUsEmails::dispatch($contact->id)
            ->onConnection('database')
            ->onQueue('default')
            ->afterCommit()
            ->afterResponse();

        return response()->json([
            'message' => 'Your email is received and we are currently working on it. We will get back to you soon.',
            'data' => [
                'id' => $contact->id,
            ],
        ], 201);
    }
}

