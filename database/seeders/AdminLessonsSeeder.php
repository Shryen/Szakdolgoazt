<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminLessonsSeeder extends Seeder
{
    private const MIN_PER_DAY = 4;
    private const MAX_PER_DAY = 7;

    public function run(): void
    {
        $admin    = User::where('username', 'Admin')->firstOrFail();
        $classes  = SchoolClass::all();
        $subjects = Subject::all();

        if ($classes->isEmpty() || $subjects->isEmpty()) {
            $this->command->error('Nincs osztály vagy tantárgy az adatbázisban.');
            return;
        }

        // Az admin korábbi óráit töröljük, hogy újrafuttatásnál ne duplikálódjanak
        Lesson::where('teacher_id', $admin->id)->delete();

        foreach (range(0, 4) as $day) {                 // 0 = hétfő ... 4 = péntek
            $count = random_int(self::MIN_PER_DAY, self::MAX_PER_DAY);

            foreach (range(0, $count - 1) as $slot) {   // 45 perces órák, 10 perc szünettel
                $start = Carbon::createFromTime(8, 0)->addMinutes($slot * 55);

                Lesson::create([
                    'school_class_id' => $classes->random()->id,
                    'subject_id'      => $subjects->random()->id,
                    'teacher_id'      => $admin->id,
                    'day_of_week'     => $day,
                    'start_time'      => $start->format('H:i:s'),
                    'end_time'        => $start->copy()->addMinutes(45)->format('H:i:s'),
                ]);
            }
        }
    }
}