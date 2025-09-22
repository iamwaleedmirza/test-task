<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    // Show poll creation form
    public function create()
    {
        $polls = Poll::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        return Inertia::render('PollCreate', [
            'polls' => $polls
        ]);
    }

    // Store new poll
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2|max:10',
            'options.*' => 'required|string|max:100',
        ]);
        $token = Str::random(16);
        $poll = Poll::create([
            'user_id' => $request->user()->id,
            'question' => $validated['question'],
            'options' => json_encode($validated['options']),
            'token' => $token,
        ]);
        $polls = Poll::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return redirect()->route('poll.create')->with([
            'success' => 'Poll created!',
            'poll' => $poll,
            'polls' => $polls
        ]);
    }

    // Show voting page
    public function showVote($token)
    {
        $poll = Poll::where('token', $token)->firstOrFail();
        return Inertia::render('PollVote', [
            'poll' => $poll,
        ]);
    }

    // Submit vote
    public function submitVote(Request $request, $token)
    {
        $poll = Poll::where('token', $token)->firstOrFail();
        $validated = $request->validate([
            'option' => 'required|string',
        ]);
        $voter_token = $request->cookie('voter_token_' . $token) ?? Str::random(16);
        $alreadyVoted = Vote::where('poll_id', $poll->id)->where('voter_token', $voter_token)->exists();
        if ($alreadyVoted) {
            return redirect()->route('poll.results', $token)->with('error', 'You have already voted.');
        }
        Vote::create([
            'poll_id' => $poll->id,
            'option' => $validated['option'],
            'voter_token' => $voter_token,
        ]);
        return redirect()->route('poll.results', $token)->withCookie(cookie('voter_token_' . $token, $voter_token, 60*24*30));
    }

    // Show poll results
    public function results($token)
    {
        $poll = Poll::where('token', $token)->firstOrFail();
        $votes = Vote::where('poll_id', $poll->id)->get();
        $options = json_decode($poll->options, true);
        $results = [];
        foreach ($options as $option) {
            $results[$option] = $votes->where('option', $option)->count();
        }
        return Inertia::render('PollResults', [
            'poll' => $poll,
            'results' => $results,
            'total' => $votes->count(),
        ]);
    }
}
