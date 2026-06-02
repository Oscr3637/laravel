<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/css/style.css','resources/js/app.js'])
</head>

<body>
    @if (session('status'))
    {{ session('status') }}
    @endif
    <br>
    @session('key-xx')
    {{ $value }}
    @endsession

    @yield('content')
    <br><br>
    <a href="/dashboard" style="border:1px black solid; padding:5px;"> Dashboard </a>
</body>

</html>