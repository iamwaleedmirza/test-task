<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/todo', [
            'title' => 'Test Task',
            'priority' => 1, // Use integer for priority
        ]);
        $response->assertRedirect('/todo');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'priority' => 1,
        ]);
    }

    public function test_tasks_are_listed_for_user()
    {
        $user = User::factory()->create();
        Task::create([
            'user_id' => $user->id,
            'title' => 'List Task',
            'priority' => 'Low',
            'completed' => false,
        ]);
        $this->actingAs($user);
        $response = $this->get('/todo');
        $response->assertStatus(200);
        $response->assertSee('List Task');
    }
}
