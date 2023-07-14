<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Email</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Forget Email</h1>
    <p>Dear User,</p>
    <p>Click the following link to reset your password:</p>
    <a href="{{route('newpassword')}}/{{$forgetLink}}">Reset Password</a>
    <p>If you didn't request this forget email, please ignore it.</p>
</body>
</html>
