<?php

namespace Database\Seeders;

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

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'mothers_name' => 'Test Mother',
            'address' => 'Test address',
            'om_id' => '00000000001',
            'username' => 'test.user',
            'role' => 'student',
            'email' => 'test@example.com',
        ]);
    }
}
