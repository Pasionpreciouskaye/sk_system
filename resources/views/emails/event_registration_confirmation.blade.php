<!DOCTYPE html>
<html>
<head>
    <title>Event Registration Confirmation</title>
</head>
<body>
    <h2>Thank you for registering for {{ $event->title }}!</h2>
    <p>Hello {{ $registration->full_name }},</p>
    <p>
        We're excited to have you join us. Here are the event details:
    </p>
    <ul>
        <li><strong>Title:</strong> {{ $event->title }}</li>
        <li><strong>Date:</strong> [Insert event date here]</li>
        <li><strong>Location:</strong> [Insert location here]</li>
    </ul>
    <p>Check your email for a calendar invite and more details about the event. See you there!</p>
</body>
</html>
