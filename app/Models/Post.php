<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'title',
        'content',
        'school_class_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
