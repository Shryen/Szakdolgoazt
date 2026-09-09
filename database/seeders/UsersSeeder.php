<?php

namespace Database\Seeders;

use App\RoleEnum;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $firstNames = [
            'Nagy',
            'Kovács',
            'Tóth',
            'Szabó',
            'Horváth',
            'Varga',
        ];

        $lastNames = [
            'Bence',
            'Dóra',
            'Eszter',
            'Gergő',
            'Lilla',
            'Máté',
            
        ];

        // Az első for loop létrehozza ugyanazokat a diákokat minden osztálynak, mert lusta vagyok különbözőket kitalálni
        // A második létrehoz egy egyedi felhasználónevet osztálytól függően tehát Kovács Bence 9/A-ban más felhasználónévvel lesz mint 10/A-ban
        foreach (SchoolClass::query()->orderBy('id')->get() as $schoolClass) {
            foreach ($firstNames as $index => $firstName) {
                $studentNumber = $index + 1;
                $username = "student_{$schoolClass->id}_{$studentNumber}";

                User::updateOrCreate(
                    ['username' => $username],
                    [
                        'first_name' => $firstName,
                        'last_name' => $lastNames[$index],
                        'mothers_name' => "{$firstName} édesanyja",
                        'address' => 'Budapest, Iskola utca 1.',
                        'om_id' => fake()->unique()->numerify('71#########'),
                        'role' => RoleEnum::STUDENT,
                        'school_class_id' => $schoolClass->id,
                        'email' => "{$username}@example.com",
                        'password' => 'password',
                    ],
                );
            }
        }
    }
}
