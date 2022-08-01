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

        // temporary data
        $nilaiW = [];
        $dataBobot = '';
        $nilaiAlternatif = [];
        $nilaiS = [];
        $dataNilaiS = '';
        $ranking = [];

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
                'total' => pow($value->nilai, $nilaiW[$key % count($nilaiW)]['total']),
            ];
        }

        // nilai s ternormalisasi
        foreach ($nilaiAlternatif as $key => $value) {
            $nilaiS[$key] = round(array_product(array_column($value, 'total')), 4);
            $dataNilaiS .= $nilaiS[$key] . ' + ';
        }

        // ranking
        foreach ($nilaiS as $key => $value) {
            $ranking[$key] = [
                'nilai' => $value/array_sum($nilaiS),
                'alternatif' => Alternatif::find($key)->nama,
                'no' => $key - count($nilaiS) + 1,
            ];
        }
        
        // sorting
        usort($ranking, function ($a, $b) {
            return $a['nilai'] < $b['nilai'];
        });
        
        return view('main.perhitungan.index')->with([
            'kriteria' => $kriteria, //data kriteria
            'bobot' => $bobot, //jumlah bobot kriteria
            'nilaiW' => $nilaiW, //nilai w normalisasi
            'dataBobot' => rtrim($dataBobot, ' + '), //data bobot kriteria
            'nilaiAlternatif' => $nilaiAlternatif, //data nilai alternatif
            'alternatif' => $alternatif, //data alternatif
            'nilaiS' => $nilaiS, //data nilai s ternormalisasi
            'dataNilaiS' => rtrim($dataNilaiS, ' + '), //data nilai s ternormalisasi
            'ranking' => $ranking, //data ranking
        ]);
    }
}
