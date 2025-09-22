<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            for ($i = 1; $i <= 5; $i++) {
                Task::create([
                    'user_id' => $user->id,
                    'title' => "Sample Task $i for {$user->name}",
                    'priority' => ['Low', 'Medium', 'High'][rand(0,2)],
                    'completed' => false,
                ]);
            }
        }
    }
}
