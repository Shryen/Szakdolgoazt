<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use RuntimeException;

class LessonsSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = Subject::query()->get();

        if ($subjects->count() < 6) {
            throw new RuntimeException('At least six subjects are required to seed lessons.');
        }

        $teacher = User::query()
            ->where('username', 'Admin')
            ->firstOrFail();

        foreach (SchoolClass::query()->get() as $schoolClass) {
            foreach (range(1, 5) as $dayOfWeek) {
                foreach ($subjects->shuffle()->take(6)->values() as $lessonNumber => $subject) {
                    $startTime = CarbonImmutable::createFromTime(8, 0)
                        ->addMinutes($lessonNumber * 55);

                    Lesson::updateOrCreate(
                        [
                            'school_class_id' => $schoolClass->id,
                            'day_of_week' => $dayOfWeek,
                            'start_time' => $startTime->format('H:i:s'),
                        ],
                        [
                            'subject_id' => $subject->id,
                            'teacher_id' => $teacher->id,
                            'end_time' => $startTime->addMinutes(45)->format('H:i:s'),
                        ],
                    );
                }
            }
        }
    }
}
