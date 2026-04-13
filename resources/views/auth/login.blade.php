<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In </title>
</head>
<body>
    <h1>Log In</h1>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        @error('error')
            <p style="color: red">{{$message}}</p>
        @enderror
        <input type="password" name="password">
        <input type="submit">

    </form>
    
</body>
</html>