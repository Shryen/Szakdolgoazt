<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'subject_id',
        'grade_value',
        'description',
        'issued_at',
    ];

    protected function casts(): array
    {
        return [
            'grade_value' => 'integer',
            'issued_at' => 'date',
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

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
