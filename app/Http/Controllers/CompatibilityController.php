<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompatibilityController extends Controller
{
    public function index()
    {
        return view('compatibility.index');
    }

    public function calculate(Request $request)
    {
        // Заглушка для калькулятора
        return view('compatibility.result');
    }
}
