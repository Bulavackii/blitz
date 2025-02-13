<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserStatusUpdated;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Получить список пользователей
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'avatar')->paginate(10);
        return response()->json($users);
    }

    /**
     * Получить информацию о конкретном пользователе
     */
    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'avatar')->findOrFail($id);
        return response()->json($user);
    }

    public function updateStatus()
{
    if (Auth::check()) {
        $user = Auth::user();
        $user->is_online = true;
        $user->save();

        $onlineUsers = User::where('is_online', true)->get(['id', 'name', 'avatar']);

        broadcast(new UserStatusUpdated($onlineUsers));
    }
}


}
