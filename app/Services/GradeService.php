<?php

namespace App\Services;

use App\Models\User;

class GradeService {
   private array $months = [
    "Szeptember",
    "Október",
    "November",
    "December",
    "Január",
    "Február",
    "Március",
    "Április",
    "Május",
    "Június"
   ];

   // Létrehozzuk a mappot a jegyeknek, hogy meg tudjuk jeleníteni a hónapokat akkor is, ha nincs benne jegy
   public function createGradesMap(){
        $map = [];

        foreach($this->months as $month)
            $map[$month] = [];

        return $map;
   }

   // miután létrehoztuk a mappot a jegyeknek, feltöltjük őket
   public function getGradesByMonthAndSubject(User $student){
        $map = $this->createGradesMap();

        foreach($student->grades as $grade){
            // lekérjük a jegy hónapját
            $month = $grade->month;
            // lekérjük a tantárgy nevét
            $subject = $grade->subject->name;

            // hónap és tantárgy alapján hívatkozunk rá
            // a harmadik üres [] olyan mintha += lenne, hozzáadja a maphoz a jegy értékét
            // tehát $map['Szeptember']['Történelem'] visszaad nekünk egy ötöst például vagy többet, ha több jegyünk van szeptemberben történelemből
            $map[$month][$subject][] = $grade;
        }

        $subjects = $student->schoolClass->lessons->map(fn ($lesson) => $lesson->subject)->unique('id');

        return ['grades' => $map, 'subjects' => $subjects];
   }
}