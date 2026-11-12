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
                <li><x-navlink href="/kezdolap">Kezdőlap</x-navlink></li>
                <li><x-navlink href="/hirfolyam" match="hirfolyam*">Hírfolyam</x-navlink></li>
            </ul>
            <ul>
                <li><x-navlink href="/profil">{{ auth()->user()->first_name }}</x-navlink></li>
                <li><x-navlink href="/uzenetek" match="uzenet*">Üzenetek</x-navlink></li>
                <li><x-navlink href="/logout">Kijelentkezés</x-navlink></li>
                @if(auth()->user()->username === 'Admin')
                    <li><x-navlink href="/admin" match="admin*">Admin panel</x-navlink></li>
                @endif
            </ul>
        </nav>
    @endauth
    
    <div class="content">{{ $slot }}</div>

</body>
</html>