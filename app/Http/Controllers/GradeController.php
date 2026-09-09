<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Subject;
use App\Services\GradeService;

class GradeController extends Controller
{
    // ez a konstruktór egyenlő azzal, hogy létrehozunk egy változót és értéket adunk neki a konstruktorban
    // tehát
    // private GradeService $gradeSerivce
    // public function __construct(GradeService $gradeService) { $this->gradeService = $gradeService }
    public function __construct(private GradeService $gradeService){} 

    public function index(){
        $schoolClasses = SchoolClass::all();
        return view('grade.index', compact('schoolClasses'));
    }

    // Hülyén van elnevezve, showClass mint mutasd az osztályt->listázd ki a tanulókat az osztályból
    public function showClass(int $classId){
        $students = User::where('school_class_id', $classId)->get();
        return view('grade.class', compact('students'));
    }

    public function show(int $classId, int $userId){
        $student = User::where('school_class_id', $classId)
                        ->where('id', $userId)->firstOrFail();

        $gradesByMonthAndSubject =
            $this->gradeService->getGradesByMonthAndSubject($student);
                        
        return view('grade.show', compact('student', 'gradesByMonthAndSubject'));
    }
}
