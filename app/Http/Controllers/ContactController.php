<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactMailService;

class ContactController extends Controller
{
    public function __construct(protected ContactMailService $mailer) {}

    public function show(string $locale)
    {
        return view('pages.contact', compact('locale'));
    }

    public function send(StoreContactRequest $request, string $locale)
    {
        try {
            $this->mailer->send($request->validated());

            return back()->with('success', __('contact.success'));
        } catch (\Throwable $e) {
            return back()->with('error', __('contact.error'))->withInput();
        }
    }
}
