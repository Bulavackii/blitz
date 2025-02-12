<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClanController extends Controller
{
    public function index()
    {
        return view('clan'); // Создай `resources/views/clan.blade.php`
    }
}
