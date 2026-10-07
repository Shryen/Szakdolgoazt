<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::create(2026, 9, 1); // szeptember 1
        $endDate = Carbon::create(2027, 6, 15);   // június 15

        // Szünetek definíciója
        $holidays = [
            ['from' => '2024-10-28', 'to' => '2024-11-04', 'name' => 'Őszi szünet'],
            ['from' => '2024-12-21', 'to' => '2025-01-06', 'name' => 'Téli szünet'],
            ['from' => '2025-02-10', 'to' => '2025-02-17', 'name' => 'Tavaszi szünet'],
            ['from' => '2025-04-18', 'to' => '2025-04-22', 'name' => 'Húsvéti szünet'],
        ];

        $weekNumber = 1;
        $currentDate = $startDate->clone();

        while ($currentDate < $endDate) {
            $weekStart = $currentDate->clone()->startOfWeek(); // hétfő
            $weekEnd = $weekStart->clone()->addDays(6); // vasárnap

            // Szünet ellenőrzése
            $isHoliday = false;
            $holidayName = null;
            foreach ($holidays as $holiday) {
                $holidayFrom = Carbon::parse($holiday['from']);
                $holidayTo = Carbon::parse($holiday['to']);
                if ($weekStart >= $holidayFrom && $weekStart <= $holidayTo) {
                    $isHoliday = true;
                    $holidayName = $holiday['name'];
                    break;
                }
            }

            AcademicYear::create([
                'year' => 2026,
                'week_number' => $weekNumber,
                'start_date' => $weekStart,
                'end_date' => $weekEnd,
                'is_holiday' => $isHoliday,
                'holiday_name' => $holidayName,
            ]);

            $weekNumber++;
            $currentDate->addWeek();
        }
    }
}