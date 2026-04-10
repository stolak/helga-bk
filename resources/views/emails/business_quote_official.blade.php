<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Quote Request</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #222;">
    <h2 style="margin: 0 0 12px 0;">New Business Quote Request</h2>
    <p style="margin: 0 0 12px 0;">
        A new business quote request has been submitted. You can reply directly to this email to contact the requester.
    </p>

    <table cellpadding="6" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr>
            <td><strong>Business Name</strong></td>
            <td>{{ $quote->businessName }}</td>
        </tr>
        <tr>
            <td><strong>Contact Person</strong></td>
            <td>{{ $quote->contactPerson }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $quote->businessEmail }}</td>
        </tr>
        <tr>
            <td><strong>Phone</strong></td>
            <td>{{ $quote->businessPhone ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Business Type</strong></td>
            <td>{{ $quote->businessType ?? '' }}</td>
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
        <tr>
            <td valign="top"><strong>Message</strong></td>
            <td style="white-space: pre-wrap;">{{ $quote->quoteMessage ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Received At</strong></td>
            <td>{{ $quote->created_at }}</td>
        </tr>
    </table>

    <p style="margin: 16px 0 0 0;">
        Regards,<br>
        {{ $officialName }}
    </p>
</body>

</html>

