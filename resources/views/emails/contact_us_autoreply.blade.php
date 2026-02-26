<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We received your message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #222;">
    <p style="margin: 0 0 12px 0;">Hi {{ $contact->name }},</p>

    <p style="margin: 0 0 12px 0;">
        Your email is received and we are currently working on it. We will get back to you soon.
    </p>

    <p style="margin: 0 0 8px 0;"><strong>Your Subject:</strong> {{ $contact->subject }}</p>
    <p style="margin: 0 0 12px 0;"><strong>Your Message:</strong></p>
    <div style="white-space: pre-wrap; background: #f7f7f7; padding: 12px; border-radius: 6px;">
        {{ $contact->content }}
    </div>

    <p style="margin: 16px 0 0 0;">
        Regards,<br>
        {{ $officialName }}
    </p>
</body>
</html>

