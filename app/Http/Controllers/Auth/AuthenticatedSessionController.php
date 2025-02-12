<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();

        // Обновляем статус онлайна
        Auth::user()->update(['is_online' => true]);

        return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors(['email' => 'Неверные учетные данные']);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
{
    $user = Auth::user();
    if ($user) {
        $user->update(['is_online' => false]); // Обновляем статус
    }

    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}
