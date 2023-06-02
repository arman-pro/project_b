<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <p> You temporary password: {{ $temp }} <br/>
        <a href="{{route('admin.forgot.password.change', ['email' => $email])}}">Click Here</a> for reset password</p>
</body>
</html>