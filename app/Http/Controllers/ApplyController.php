<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function show()
    {
        return view('apply');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Здесь можно добавить логику обработки заявки (сохранение в БД, отправка email и т. д.)

        return redirect()->route('apply.show')->with('success', 'Ваша заявка отправлена!');
    }
}
