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
    @auth
        <nav>
            <ul>
                <li><a href="/kezdolap">Kezdőlap</a></li>
                <li><a href="/hirfolyam">Hírfolyam</a></li>
            </ul>
            <ul>
                <li><a href="">{{auth()->user()->first_name}}</a></li>
                <li><a href="/logout">Kijelentkezés</a></li>
                @if(auth()->user()->username === 'Admin')
                    <li><a href="/admin">Admin panel</a></li>
                @endif 
            </ul>
        </nav>
    @endauth

    {{$slot}}
</body>
</html>