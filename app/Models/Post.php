<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'title',
        'content',
    ];

    public function author()
    {
        // itt csak úgy tudjuk elérni a usert aki létrehozta, hogy authorként hívatkozunk rá user helyett
        // Tehát ha post alapján akarjuk a usert lekérdezni: $post->author->first_name és nem $post->user->first_name
        return $this->belongsTo(User::class, 'author_id'); 
    }
}
