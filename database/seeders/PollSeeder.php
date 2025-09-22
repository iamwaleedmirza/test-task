<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poll;
use Illuminate\Support\Str;
use App\Models\User;

class PollSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) {
                Poll::create([
                    'user_id' => $user->id,
                    'question' => "Sample poll question $i for {$user->name}",
                    'options' => json_encode([
                        "Option A", "Option B", "Option C"
                    ]),
                    'token' => Str::random(16),
                ]);
            }
        }
    }
}
