<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hi {{ $user->name }} </h1>

    <p> {{ $details }} </p>

    <p> the new password is:  <b>{{ $user->reset_key }}</b> </p>
</body>
</html>