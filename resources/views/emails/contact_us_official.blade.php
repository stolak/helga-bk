<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #222;">
    <h2 style="margin: 0 0 12px 0;">New Contact Us Message</h2>
    <p style="margin: 0 0 12px 0;">
        You received a new message via the Contact Us endpoint.
    </p>

    <table cellpadding="6" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $contact->name }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $contact->email }}</td>
        </tr>
        <tr>
            <td><strong>Phone</strong></td>
            <td>{{ $contact->phone_number ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Subject</strong></td>
            <td>{{ $contact->subject }}</td>
        </tr>
        <tr>
            <td valign="top"><strong>Content</strong></td>
            <td style="white-space: pre-wrap;">{{ $contact->content }}</td>
        </tr>
        <tr>
            <td><strong>Received At</strong></td>
            <td>{{ $contact->created_at }}</td>
        </tr>
    </table>

    <p style="margin: 16px 0 0 0;">
        Regards,<br>
        {{ $officialName }}
    </p>
</body>

</html>
