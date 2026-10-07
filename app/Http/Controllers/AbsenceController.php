<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Lesson;

class AbsenceController extends Controller
{
    public function index(){
        // Lekérjük az éppen bejelentkezett tanár id-ját
        $teacherId = auth()->id();

        // Aktuális hét
        $currentWeek = AcademicYear::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        $lessons = Lesson::where('teacher_id', $teacherId)
            ->with(['schoolClass', 'subject'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        dd($lessons);
    }
}
