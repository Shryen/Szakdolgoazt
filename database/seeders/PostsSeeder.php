<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::query()->where('username', 'Admin')->firstOrFail();

        $posts = [
            [
                'title' => 'Üdvözlünk az új tanévben!',
                'content' => 'Sok sikert és élményekben gazdag tanévet kívánunk minden diáknak. A fontos tudnivalókat itt tesszük közzé.',
            ],
            [
                'title' => 'Könyvtári nyitvatartás',
                'content' => 'Az iskolai könyvtár hétköznapokon 8:00 és 16:00 között várja a diákokat.',
            ],
            [
                'title' => 'Diákprojektek bemutatója',
                'content' => 'A félév végi projektbemutatóra minden osztály készülhet egy rövid előadással vagy bemutatóval.',
            ],
        ];

        foreach ($posts as $post) {
            Post::firstOrCreate(
                [
                    'author_id' => $author->id,
                    'title' => $post['title'],
                ],
                ['content' => $post['content']],
            );
        }
    }
}
