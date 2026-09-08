<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Informatika',
            'Nyelvtan',
            'Irodalom',
            'Történelem',
            'Matematika',
            'Etika',
            'Testnevelés',
        ] as $name) {
            Subject::firstOrCreate(['name' => $name]);
        }
    }
}
