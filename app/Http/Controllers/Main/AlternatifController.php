<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlternatifRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    public function index()
    {
        return view('main.alternatif.index');
    }

    public function render()
    {
        $kriteria = Kriteria::all();
        $satuan = [
            '(m)', '', '(m)', ''
        ];
        $data = Alternatif::with('nilai')->get();
        $view = [
            'data' => view('main.alternatif.render', compact('data', 'kriteria', 'satuan'))->render(),
        ];

        return response()->json($view);
    }

    public function store(AlternatifRequest $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $alternatif = Alternatif::create([
                    'nama' => $request->nama,
                    'kelurahan' => $request->kelurahan,
                ]);
                $kriteria = Kriteria::all();
    
                foreach($kriteria as $kriteria) {
                    Nilai::create([
                        'id_alternatif' => $alternatif->id_alternatif,
                        'id_kriteria' => $kriteria->id_kriteria,
                        'nilai' => 0,
                    ]);
                }
            });
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
        $data = Alternatif::find($id);

        return response()->json($data);
    }

    public function update(AlternatifRequest $request)
    {
        try {
            $data = Alternatif::find($request->id_alternatif);
            $data->update([
                'nama' => $request->nama,
                'kelurahan' => $request->kelurahan,
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

    public function delete($id)
    {
        try {
            $data = Alternatif::find($id);
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
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
