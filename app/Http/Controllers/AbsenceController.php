<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Lesson;
use App\Services\AbsenceService;
use App\Http\Requests\AbsenceRequest;

class AbsenceController extends Controller
{
    private $teacherId = null;
    public function __construct(private AbsenceService $absenceService){
        $this->teacherId = auth()->id();
    }

    public function index(){
        return view('absence.index');
    }

    public function create(){
        // Lekérjük az éppen bejelentkezett tanár id-ját
        if($this->teacherId == null){
            $this->teacherId = auth()->id();
        }

        // Az aktuális hét lekérése a Serviceből
        $currentWeek = $this->absenceService->getCurrentWeekLessons($this->teacherId);

        // átadjuk egyszerű tömbként
        return view('absence.create', $currentWeek);
    }

    public function show(Lesson $lesson){
        $students = $lesson->schoolClass->students;
        $subject = $this->absenceService->getCurrentWeekLessons($this->teacherId);
        $subject = $subject['lessons'][$lesson->id-1];
        return view('absence.show', compact('students', 'lesson', 'subject'));
    }

    public function store(AbsenceRequest $absenceRequest){
        $request = $absenceRequest->validated();
        $request['teacher_id'] = $this->teacherId;
        $absence = $this->absenceService->CreateAbsence($request);
        return back()->with('success', 'Hiányzás rögzítve.');
    }
}
