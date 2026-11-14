<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lesson;
use App\Models\Absence;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index', ['user' => auth()->user()]);
    }

    public function absences()
    {
        $absences = Absence::with('lesson.subject')
            ->where('student_id', auth()->id())
            ->latest('date')
            ->get();

        return view('profile.absences', compact('absences'));
    }

    public function timetable()
{
    $user = auth()->user();
    $isStudent = $user->role->value === 'student';

    $grid = Lesson::with(['subject', 'schoolClass'])
        ->when($isStudent,
            fn ($q) => $q->where('school_class_id', $user->school_class_id),
            fn ($q) => $q->where('teacher_id', $user->id)
        )
        ->orderBy('start_time')
        ->get()
        ->groupBy(fn ($lesson) => $lesson->start_time->format('H:i'))
        ->map(fn ($row) => $row->keyBy('day_of_week'));

    return view('profile.timetable', [
        'grid'      => $grid,
        'isStudent' => $isStudent,
        'classId'   => $user->school_class_id,
    ]);
}

}
