<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        $bobot = Kriteria::sum('bobot');
        return view('main.kriteria.index', compact('kriteria', 'bobot'));
    }
}
