<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'head_teacher_id'];

    public function headTeacher()
    {
        return $this->belongsTo(User::class, 'head_teacher_id');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'school_class_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
