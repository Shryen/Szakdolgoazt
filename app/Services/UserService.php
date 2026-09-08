<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService {
    public function createUser(array $data)
    {
        $username = $this->generateUsername($data['first_name'], $data['last_name']);
        $password = Str::password(8); // random jelszó

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mothers_name' => $data['mothers_name'],
            'address' => $data['address'],
            'email' => $data['email'],
            'school_class_id' => 1,

            'username' => $username,
            'om_id' => $this->generateOmId(),
            'password' => Hash::make($password),
        ]);

        return [
            'user' => $user,
            'username' => $username,
            'password' => $password,
        ];
    }

    public function generateUsername(string $firstName, string $lastName){
        // Ékezetek eltávolítása és kisbetű
        $cleanFirst = Str::slug($firstName, ''); 
        $cleanLast = Str::slug($lastName, '');

        $baseUsername = substr($cleanFirst, 0, 2) . $cleanLast . rand(10, 99); //első kettő betű családnév, teljes keresztnév + 2 random szám

        // Megnézzük, hogy van-e már ilyen és ha igen újat generálunk
        while (User::where('username', $baseUsername)->exists()) {
            $baseUsername = substr($cleanFirst, 0, 2) . $cleanLast . rand(10, 99);
        }

        return $baseUsername;
    }

    public function generateOMID(){
         do {
            $omId = '71' . random_int(1000000, 9999999);
        } while (User::where('om_id', $omId)->exists());

        return $omId;
    }
}