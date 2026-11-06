<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Lesson;
use App\Models\Absence;
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

    public function showAllAbsences(){
        $absences = Absence::all();
        return view('absence.absences', compact('absences'));
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
        // TODO: Kis ablak létrehozása üzeneteknek.
        return back()->with('success', 'Hiányzás rögzítve.');
    }

    public function edit(Absence $absence){
        return view('absence.edit', compact('absence'));
    }

    public function update(Request $request, Absence $absence){
        $validate = $request->validate([
            'date' => 'required',
            'is_justified' => 'required'
        ]);
        $absence->update($validate);
        
        return redirect()->route('hianyzasok');
    }

    public function destroy($id){
        Absence::destroy($id);
        return back()->with('success');
    }
}
