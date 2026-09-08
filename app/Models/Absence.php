<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'lesson_id',
        'date',
        'is_justified',
        'justification_reason',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_justified' => 'boolean',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
