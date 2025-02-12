<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        return view('stats'); // Создай `resources/views/stats.blade.php`
    }
}
