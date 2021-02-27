<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Email</title>
</head>
<body>
    <h1>Hi {{ $user->name }} </h1>

    <p> If you didn't request to change the password, please ignore this email. If you would like to proceed. </p>

    <a href="http://127.0.0.1:8000/" target="_blank"><button>Click here to verify your email</button></a>

</body>
</html>