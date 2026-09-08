<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <title>E-napló</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/kezdolap">Kezdőlap</a></li>
            <li><a href="/hirfolyam">Hírfolyam</a></li>
        </ul>
    </nav>
    {{$slot}}
</body>
</html>