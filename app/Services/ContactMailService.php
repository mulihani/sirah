<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactMailService
{
    /**
     * Send a contact message to the configured contact email.
     */
    public function send(array $data): void
    {
        $contactEmail = Setting::get('contact_email', config('mail.from.address'));

        if (! $contactEmail) {
            return;
        }

        Mail::to($contactEmail)->send(new ContactMail($data));
    }
}
