<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroCivico;

class IndexController extends Controller
{
    public function index()
    {
        $centros = CentroCivico::all(); // Obtiene todos los centros
        return view('home', compact('centros'));
    }
}
