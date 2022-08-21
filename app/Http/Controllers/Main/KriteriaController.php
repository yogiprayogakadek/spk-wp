<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        return view('main.kriteria.index');
        // $kriteria = Kriteria::all();
        // $bobot = Kriteria::sum('bobot');
        // return view('main.kriteria.index', compact('kriteria', 'bobot'));
    }

    public function render()
    {
        $kriteria = Kriteria::all();
        $bobot = Kriteria::sum('bobot');

        $view = [
            'data' => view('main.kriteria.render')->with([
                'kriteria' => $kriteria,
                'bobot' => $bobot
            ])->render()
        ];

        return response()->json($view);
    }

    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return response()->json($kriteria);
    }

    public function update(KriteriaRequest $request)
    {
        try {
            $data = Kriteria::find($request->id_kriteria);
            $data->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'title' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Error',
            ]);
        }
    }
}
