<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>
    <p>
    <a href="{{ URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]) }}">
        Verify Email
    </a>
</p>

    <p>Best regards,<br>The Team</p>
</body>
</html>

