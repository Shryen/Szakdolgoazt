<?php

namespace Database\Seeders;

use App\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'turóbert93'],
            [
                'first_name'      => 'Turcsányi',
                'last_name'       => 'Róbert',
                'mothers_name'    => 'Turcsányi Róbert édesanyja',
                'address'         => 'Budapest, Iskola utca 1.',
                'om_id'           => '71000000001',
                'role'            => RoleEnum::STUDENT,
                'school_class_id' => 1,
                'email'           => 'turobert93@example.com',
                'password'        => Hash::make('jelszó'),
            ],
        );  
    }
}