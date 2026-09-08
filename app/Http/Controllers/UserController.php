<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Bejelentkezéshez kell

// A request és a service amit készítettünk, hogy tudjuk használni, request a validálásra való a service pedig business logicot tartalmaz
use App\Http\Requests\UserRequest; 
use App\Services\UserService;

class UserController extends Controller
{
    // létrehozzuk a userservice változónkat, amikor ez a class megépül
    public function __construct(
        private UserService $userService
    ) {}

    public function store(UserRequest $request){ // Használjuk a létrehozott UserRequestet (ez fogja validálni az értékeket, amit a felhasználó megadott)
        $user = $this->userService->createUser( // felhasználjuk a userservice változót a felhasználó által bevitt adatokkal (request)
            $request->validated()
        );

        return redirect()->back()->with([ // visszatérünk az űrlaphoz egy üzenettel és a generált jelszóval és felhasználónévvel, amit a diákunk tud használni majd
            'success' => 'Diák sikeresen rögzítve a rendszerben.',
            'username' => $user['username'],
            'password' => $user['password'],
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        
        // Megpróbáljuk bejelentkeztetni a felhasználót
        if (Auth::attempt($credentials)) {
            // Sikeres belépés esetén rögzítjük a munkamenetet a Session Fixation támadások ellen
            $request->session()->regenerate(); 
            
            return redirect()->intended('kezdolap');
        }

        return back()->withErrors([
            'username' => 'A megadott hitelesítő adatok nem megfelelőek.',
         ]);
    }
}