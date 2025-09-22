<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Poll;

class PollTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_poll()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/poll', [
            'question' => 'Test Poll?',
            'options' => ['Yes', 'No'],
        ]);
        $response->assertRedirect('/poll/create');
        $this->assertDatabaseHas('polls', [
            'question' => 'Test Poll?'
        ]);
    }

    public function test_poll_can_be_voted_and_results_returned()
    {
        $user = User::factory()->create();
        $poll = Poll::create([
            'user_id' => $user->id,
            'question' => 'Vote Poll?',
            'options' => json_encode(['A', 'B']),
            'token' => 'testtoken123',
        ]);
        $response = $this->post("/poll/vote/{$poll->token}", [
            'option' => 'A',
        ]);
        $response->assertRedirect("/poll/results/{$poll->token}");
        $this->assertDatabaseHas('votes', [
            'poll_id' => $poll->id,
            'option' => 'A',
        ]);
        $results = $this->get("/poll/results/{$poll->token}");
        $results->assertStatus(200);
    }
}
