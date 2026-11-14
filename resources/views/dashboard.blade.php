<x-layout>
    @php
        $role = $user->role->value;

        if ($role === 'student') {
            $cards = [
                ['/profil/orarend',  'Órarendem',   'A heti órarended'],
                ['/profil/hianyzas', 'Hiányzásaim', 'Rögzített hiányzásaid és az igazolásuk'],
                ['/hirfolyam',       'Hírfolyam',   'Iskolai hírek'],
                ['/uzenetek',        'Üzenetek',    'Beszélgetések tanárokkal és diákokkal'],
                ['/profil',          'Profilom',    'Személyes adataid'],
            ];

            // A jegytábla az osztály és a diák azonosítóját is kéri, osztály nélkül nincs hova mutatnia
            if ($user->school_class_id) {
                array_unshift($cards, [
                    '/jegyek/' . $user->school_class_id . '/' . $user->id,
                    'Jegyeim',
                    'Jegyeid tantárgyanként és havonta',
                ]);
            }
        } else {
            $cards = [
                ['/jegyek',                'Jegyek beírása',  'Válassz osztályt, majd diákot'],
                ['/hianyzas',              'Hiányzások',      'Rögzítés és megtekintés'],
                ['/profil/orarend',        'Órarendem',       'Az óráid az osztályokkal'],
                ['/hirfolyam/letrehozas',  'Hír létrehozása', 'Új bejegyzés a hírfolyamba'],
                ['/hirfolyam',             'Hírfolyam',       'Iskolai hírek'],
                ['/uzenetek',              'Üzenetek',        'Beszélgetések'],
                ['/profil',                'Profilom',        'Személyes adataid'],
            ];

            if ($role === 'admin') {
                array_push($cards,
                    ['/register', 'Diák felvétele', 'Új felhasználó létrehozása'],
                    ['/admin',    'Admin panel',    'Kezelőfelület'],
                );
            }
        }
    @endphp

    <div class="dashboard">
        <div class="dashboard-header">
            <h1>Üdv, {{ $user->first_name }}!</h1>
            <p>{{ now()->locale('hu')->isoFormat('YYYY. MMMM D., dddd') }}</p>
        </div>

        <div class="dashboard-grid">
            @foreach($cards as [$href, $title, $text])
                <a href="{{ $href }}" class="dashboard-card">
                    {{ $title }}
                    <span>{{ $text }}</span>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>