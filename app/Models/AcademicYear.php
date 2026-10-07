<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'year',
        'semester',
        'week_number',
        'start_date',
        'end_date',
        'is_holiday',
        'holiday_name',
        'note',
    ];

    // Az adatbázis csak szöveget és számokat tud tárolni így a $casts változót használjuk, ami
    // azt mondja a Laravelnek, hogy amikor ezt a mezőt olvassa konvertálja erre a típusra
    // pl.: start_date és end_date nem szövegek lesznek hanem date típusok
    // Hasznos, ha nem akarjuk a saját format függvényeinket megírni, hogy használni tudjuk

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_holiday' => 'boolean',
        'year' => 'integer',
        'week_number' => 'integer',
    ];

    public function absences(){
        return $this->hasManyThrough(
            Absence::class,
            Lesson::class,
            'id',
            'lesson_id'
        )->whereBetween('absences.date', [$this->start_date, $this->end_date]);
    }

    public function lessons()
    {
        return Lesson::whereHas('schoolClass', function($q) {})
            ->whereBetween('created_at', [$this->start_date, $this->end_date])
            ->get(); // vagy relationship
    }

     public function getDayLabel($dayOfWeek)
    {
        $days = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap'];
        return $days[$dayOfWeek] ?? null;
    }

    public function getFormattedDate()
    {
        return $this->start_date->format('Y.m.d') . ' - ' . $this->end_date->format('Y.m.d');
    }

}
