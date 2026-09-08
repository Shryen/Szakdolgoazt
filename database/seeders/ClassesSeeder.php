<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(9, 12) as $grade) {
            foreach (range('A', 'D') as $section) {
                SchoolClass::firstOrCreate([
                    'name' => "{$grade}/{$section}",
                ]);
            }
        }
    }
}
