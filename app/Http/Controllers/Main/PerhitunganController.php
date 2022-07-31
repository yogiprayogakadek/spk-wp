<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        $bobot = Kriteria::sum('bobot');
        $nilai = Nilai::all();
        $alternatif = Alternatif::all();

        $nilaiW = [];
        $dataBobot = '';
        $nilaiAlternatif = [];
        $dataNilai = [];

        foreach ($kriteria as $key => $value) {
            // $nilaiW[] = $value->bobot / $bobot;
            $nilaiW[] = [
                'nilai' => $value->bobot / $bobot,
                'tipe' => $value->tipe,
                'total' => $value->tipe == 'benefit' ? $value->bobot / $bobot : -$value->bobot / $bobot,
            ];
            $dataBobot .= $value->bobot . ' + ';
        }

        foreach ($nilai as $key => $value) {
            // $nilaiAlternatif[$value->alternatif_id][] = $value->nilai;
            $nilaiAlternatif[$value->id_alternatif][] = [
                'nilai' => $value->nilai,
                'nilaiW' => $nilaiW[$key % count($nilaiW)]['total'],
                // 'nilaiW' => $nilaiW[count($nilai)/count($kriteria)]['total'],
            ];
        }

        // dd($nilaiAlternatif);

        // return view('main.perhitungan.index', compact('kriteria', 'bobot', 'nilaiW', 'dataBobot'));
        return view('main.perhitungan.index')->with([
            'kriteria' => $kriteria, //data kriteria
            'bobot' => $bobot, //jumlah bobot kriteria
            'nilaiW' => $nilaiW, //nilai w normalisasi
            'dataBobot' => rtrim($dataBobot, ' + '), //data bobot kriteria
            'nilaiAlternatif' => $nilaiAlternatif, //data nilai alternatif
            'alternatif' => $alternatif, //data alternatif
        ]);
    }
}
