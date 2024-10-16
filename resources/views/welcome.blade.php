<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, ">
    <title>Početna</title>
    <link rel="icon" href="{{ asset('../resources/css/img/logo_krug.png') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/styles.css') }}">
</head>
<body>
<header>
    <h1>Dobrodošli</h1>
</header>
<form>
    <div>
        <a href="{{ route('login') }}" class="button">Prijava</a>
    </div>
    <br>
    <a href="{{ route('register') }}" class="button">Registracija</a>
</form>

<footer>
    Milica Lazić I011-41/2020<br>Copyright © 2024
</footer>
</body>
</html>
