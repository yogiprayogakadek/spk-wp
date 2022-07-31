<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\NilaiRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        return view('main.nilai.index');
    }

    public function render()
    {
        $kriteria = Kriteria::all();
        $satuan = [
            '(m)', '', '(m)', ''
        ];
        $data = Alternatif::with('nilai')->get();
        $view = [
            'data' => view('main.nilai.render', compact('data', 'kriteria', 'satuan'))->render(),
        ];

        return response()->json($view);
    }

    public function store(NilaiRequest $request)
    {
        try {
            $kriteria = Kriteria::all();
            // $nilai = Nilai::where('id_alternatif', $request->id_alternatif)->get();

            foreach($kriteria as $kriteria) {
                $nama = strtolower(str_replace(' ', '_', $kriteria->nama));
                $nilai = Nilai::where('id_alternatif', $request->id_alternatif)->where('id_kriteria', $kriteria->id_kriteria)->first();
                $nilai->update([
                    'nilai' => $request->$nama
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
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

    public function edit($id)
    {
        $nilai = Nilai::where('id_alternatif', $id)->get();
        $kriteria = Kriteria::all();
        $dataKriteria = [];
        foreach($kriteria as $kriteria) {
            $nama = strtolower(str_replace(' ', '_', $kriteria->nama));
            $dataKriteria[] = $nama;
        }

        return response()->json([
            'nilai' => $nilai,
            'kriteria' => $dataKriteria,
        ]);
    }
}
