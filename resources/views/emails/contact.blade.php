<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $data['subject'] }}</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2 style="color: #7c3aed;">{{ __('contact.mail_heading') }}</h2>
    <hr style="border-color: #e5e7eb;" />

    <p><strong>{{ __('contact.mail_name') }}:</strong> {{ $data['name'] }}</p>
    <p><strong>{{ __('contact.mail_email') }}:</strong> {{ $data['email'] }}</p>
    <p><strong>{{ __('contact.mail_subject_label') }}:</strong> {{ $data['subject'] }}</p>

    <div style="margin-top: 20px; padding: 16px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb;">
        <strong>{{ __('contact.mail_message') }}:</strong>
        <p style="margin-top: 8px; white-space: pre-wrap;">{{ $data['message'] }}</p>
    </div>

    <p style="color: #9ca3af; font-size: 12px; margin-top: 24px;">
        {{ __('contact.mail_footer') }}
    </p>
</body>
</html>
