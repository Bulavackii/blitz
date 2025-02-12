<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\ClanController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\BattleController;

Route::get('/battle', [BattleController::class, 'index'])->name('battle.index');

Route::get('/apply', [ApplyController::class, 'show'])->name('apply.show');
Route::post('/apply', [ApplyController::class, 'submit'])->name('apply.submit');

Route::get('/interview', [InterviewController::class, 'index'])->name('interview.index');

Route::get('/clan', [ClanController::class, 'index'])->name('clan.index');

Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');

// Чат
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

// Новости
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::middleware('auth')->group(function () {
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
});

// Маршруты для звонков
Route::middleware('auth')->group(function () {
    Route::get('/calls', [CallController::class, 'index'])->name('calls.index');
    Route::post('/call/start', [CallController::class, 'startCall'])->name('call.start');
    Route::put('/call/end/{id}', [CallController::class, 'endCall'])->name('call.end');
});

Route::get('/', function () {
    return view('layouts.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
