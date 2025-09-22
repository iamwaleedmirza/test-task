<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)
            ->orderBy('priority', 'desc')
            ->paginate(4);
        return Inertia::render('TodoList', [
            'tasks' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority' => 'required|integer|in:1,2,3',
        ]);
        $task = Task::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'priority' => $validated['priority'],
            'completed' => false,
        ]);
        return redirect('/todo');
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $task->update($request->only(['title', 'description', 'priority', 'completed']));
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $task->delete();
        return redirect()->back();
    }
}
