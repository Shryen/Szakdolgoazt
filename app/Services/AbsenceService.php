<?php

namespace App\Services;

use App\Models\AcademicYear;
use App\Models\Lesson;
use App\Models\Absence;

class AbsenceService{

    public function getCurrentWeek(){
        $currentWeek = AcademicYear::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
        return $currentWeek;
    }

    public function getLessonsForTeacher($teacherID){
        $lessons = Lesson::where('teacher_id', $teacherID)
            ->with(['schoolClass', 'subject'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return $lessons;
    }

    public function getCurrentWeekLessons($teacherID){
        // Aktuális hét
        $currentWeek = $this->getCurrentWeek();

        // Tanórák amiket ez a tanár tart
       $lessons = $this->getLessonsForTeacher($teacherID);
        
        return [
            'lessons' => $lessons,
            'currentWeek' => $currentWeek,
        ];
    }

    public function CreateAbsence(array $data){
        return Absence::create([
            'student_id' => $data['student_id'],
            'subject_id' => $data['subject_id'],
            'date' => $data['date'],
            'is_justified' => $data['is_justified'],
            'lesson_id' => $data['lesson_id'],
            'teacher_id' => $data['teacher_id']
        ]);
    }
}
