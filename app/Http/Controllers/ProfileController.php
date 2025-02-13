<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Отображение страницы профиля.
     */
    public function edit(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user(); // <-- явное получение пользователя

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Обновление информации профиля пользователя.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user(); // <-- явное получение пользователя

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Профиль успешно обновлен.');
    }

    /**
     * Удаление аккаунта пользователя.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        // Проверяем пароль
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('info', 'Ваш личный кабинет успешно удален.');
    }

    /**
     * Обновление аватара пользователя.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Удаление старого аватара
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        // Загрузка нового
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->save();

        return redirect()->route('profile.edit')->with('info', 'Аватар успешно обновлен.');
    }

    /**
     * Удаление аватара пользователя.
     */
    public function deleteAvatar(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
            $user->avatar = null;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Аватар успешно удален.');
    }

}
