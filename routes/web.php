<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/menu', function () {
        return Inertia::render('Menu');
    })->name('menu');
    Route::get('/todo', [\App\Http\Controllers\TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [\App\Http\Controllers\TodoController::class, 'store'])->name('todo.store');
    Route::put('/todo/{id}', [\App\Http\Controllers\TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [\App\Http\Controllers\TodoController::class, 'destroy'])->name('todo.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/poll/create', [\App\Http\Controllers\PollController::class, 'create'])->name('poll.create');
    Route::post('/poll', [\App\Http\Controllers\PollController::class, 'store'])->name('poll.store');
    Route::get('/poll', function () {
        return redirect()->route('poll.create');
    })->name('poll');
});
Route::get('/poll/vote/{token}', [\App\Http\Controllers\PollController::class, 'showVote'])->name('poll.vote');
Route::post('/poll/vote/{token}', [\App\Http\Controllers\PollController::class, 'submitVote'])->name('poll.vote.submit');
Route::get('/poll/results/{token}', [\App\Http\Controllers\PollController::class, 'results'])->name('poll.results');

require __DIR__.'/auth.php';
