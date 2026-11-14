<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('username', 'Admin')->firstOrFail();
        $student = User::query()->where('username', 'test.user')->firstOrFail();

        $messages = [
            [
                'sender_id' => $student->id,
                'receiver_id' => $admin->id,
                'content' => 'Szeretnék érdeklődni a közelgő projektbemutató részleteiről.',
            ],
            [
                'sender_id' => $admin->id,
                'receiver_id' => $student->id,
                'content' => 'A bemutató időpontjáról hamarosan közzétesszük a részleteket a hírfolyamban.',
            ],
        ];

        foreach ($messages as $message) {
            Message::firstOrCreate($message);
        }
    }
}
