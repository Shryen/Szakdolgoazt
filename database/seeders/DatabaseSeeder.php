<?php

namespace Database\Seeders;

use App\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassesSeeder::class,
            SubjectsSeeder::class,
        ]);

        User::updateOrCreate(
            ['username' => 'Admin'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'mothers_name' => 'Admin',
                'address' => 'Admin address',
                'om_id' => '00000000000',
                'role' => RoleEnum::ADMIN,
                'email' => 'admin@example.com',
                'password' => 'Admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'test.user'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'mothers_name' => 'Test Mother',
                'address' => 'Test address',
                'om_id' => '00000000001',
                'role' => RoleEnum::STUDENT,
                'email' => 'test@example.com',
                'password' => 'password',
            ]
        );
    }
}
