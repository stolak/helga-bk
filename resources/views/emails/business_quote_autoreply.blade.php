<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We received your quote request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #222;">
    <p style="margin: 0 0 12px 0;">Dear {{ $quote->contactPerson }},</p>

    <p style="margin: 0 0 12px 0;">
        Thank you for contacting us. We’ve received your business quote request and our team will review it shortly.
        If you provided enough details, we’ll follow up with any questions and a quote as soon as possible.
    </p>

    <p style="margin: 0 0 12px 0;"><strong>Request Summary</strong></p>
    <table cellpadding="6" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr>
            <td><strong>Business Name</strong></td>
            <td>{{ $quote->businessName }}</td>
        </tr>
        <tr>
            <td><strong>Pickup Needed</strong></td>
            <td>
                @if(is_null($quote->pickupNeeded))
                    {{ '' }}
                @else
                    {{ $quote->pickupNeeded ? 'Yes' : 'No' }}
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Estimated Volume</strong></td>
            <td>{{ $quote->volume ?? '' }}</td>
        </tr>
    </table>

    @if(!empty($quote->quoteMessage))
        <p style="margin: 12px 0 8px 0;"><strong>Your Message</strong></p>
        <div style="white-space: pre-wrap; background: #f7f7f7; padding: 12px; border-radius: 6px;">
            {{ $quote->quoteMessage }}
        </div>
    @endif

    <p style="margin: 16px 0 0 0;">
        Sincerely,<br>
        {{ $officialName }}
    </p>
</body>
</html>

