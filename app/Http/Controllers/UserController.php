<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
