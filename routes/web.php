<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\ClanController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\BattleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts.home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Остальные маршруты
Route::get('/battle', [BattleController::class, 'index'])->name('battle.index');
Route::get('/apply', [ApplyController::class, 'show'])->name('apply.show');
Route::post('/apply', [ApplyController::class, 'submit'])->name('apply.submit');
Route::get('/interview', [InterviewController::class, 'index'])->name('interview.index');
Route::get('/clan', [ClanController::class, 'index'])->name('clan.index');
Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');

// Чат (только для авторизованных пользователей)
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/user/heartbeat', function () {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->update(['is_online' => true]);
        }
        return response()->json(['status' => 'ok']);
    })->middleware('auth');
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

// Профиль (только для авторизованных пользователей)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile'); // ✅ Добавлен маршрут для показа профиля
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar'); // ✅ Исправлен нейминг
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.deleteAvatar');
});

Route::get('/update-status', [UserController::class, 'updateStatus']);

require __DIR__.'/auth.php';
