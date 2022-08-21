@extends('templates.master')

@section('title', 'Perhitungan')
@section('pwd', 'WP Product')
@section('sub-pwd', 'Perhitungan')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('assets/css/perhitungan.css')}}">
@endpush

@section('content')
<div class="row printableArea">
    <div class="col-md-12">
        <h3 style="text-align: center">
            <b>Data Perhitungan</b>
        </h3>
    </div>
    <div class="col-md-12">
        <div class="pull-left">
            <address>
                <p class="m-t-30">
                    <img src="{{asset('assets/images/logo.png')}}" height="100">
                </p>
                <p class="m-t-30">
                    <b>Dicetak oleh :</b>
                    <i class="fa fa-user"></i> {{nama()}}
                </p>
                <p class="m-t-30">
                    <b>Tanggal Laporan :</b>
                    <i class="fa fa-calendar"></i> {{date('d-m-Y')}}
                </p>
            </address>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kriteria</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-nowrap border-bottom dataTable no-footer tableData" role="grid"
                id="tableData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Normalisasi</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteria as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->kode_kriteria}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->bobot}}</td>
                        <td>{{$data->bobot/100}}</td>
                        <td>{{ucfirst($data->tipe)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{$bobot}}</td>
                        <td>{{$bobot/100}}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alternatif</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-nowrap border-bottom dataTable no-footer tableData" role="grid"
                id="tableData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatif as $al)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$al->nama}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}

    {{-- nilai --}}
    <div class="row mt-5">
        <div class="col-lg-6 col-xl-4 weighted-product">
            <h3 class="text-center">Nilai W</h3>
            <table class="table table-bordered" role="grid">
                {{-- <tbody> --}}
                    @foreach ($kriteria as $key => $item)
                    <tr>
                        <td width='5%' class="align-middle">
                            <i>W</i><sub>{{$loop->iteration}}</sub>
                        </td>

                        <td width='1%' class="align-middle">=</td>
                        <td class="text-center">
                            <span>{{$item->bobot}}</span>
                            <hr class="solid">
                            <span>{{$dataBobot}}</span>
                        </td>

                        <td width='1%' class="align-middle">=</td>
                        <td class="text-center">
                            <span>{{$item->bobot}}</span>
                            <hr class="solid">
                            <span>{{$kriteria->sum('bobot')}}</span>
                        </td>

                        <td width='1%' class="align-middle">=</td>
                        <td class="text-center align-middle">
                            <span>{{$item->bobot/$kriteria->sum('bobot')}}</span>
                        </td>
                    </tr>
                    @endforeach
                {{-- </tbody> --}}
            </table>
        </div>
        <div class="col-lg-6 col-xl-4 weighted-product mt-5">
            <div class="card">
                <h3 class="text-center">Nilai W ternormalisasi</h3>
                <table class="table table-bordered" role="grid">
                    {{-- <tbody> --}}
                        @foreach ($nilaiW as $nilaiW)
                        <tr>
                            <td width='5%'>
                                <i>W</i><sub>{{$loop->iteration}}</sub>
                            </td>

                            <td width='1%'>=</td>
                            <td width="18%">
                                <span>{{$nilaiW['nilai']}} * {{$nilaiW['tipe'] == 'cost' ? '-1' : '1'}}</span>
                            </td>

                            <td width='1%'>=</td>
                            <td>
                                <span>{{$nilaiW['total']}}</span>
                            </td>
                        </tr>
                        @endforeach
                    {{-- </tbody> --}}
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 weighted-product mt-5">
            <div class="card">
                <h3 class="text-center">Nilai S ternormalisasi dari setiap alternatif</h3>
                <table class="table table-bordered" role="grid">
                    {{-- <tbody> --}}
                        {{-- {{$nilaiAlternatif}} --}}
                        @forelse ($alternatif as $alt)
                        <tr>
                            <td width='5%'>
                                <i>S</i><sub>{{$loop->iteration}}</sub>
                            </td>

                            <td width='1%'>=</td>
                            <td width="30%">
                                <span>
                                    @foreach ($nilaiAlternatif[$alt->id_alternatif] as $key => $item)
                                    {!! '(' .$item['nilai']. '<sup>' . $item['nilaiW'] . '</sup>' . ')' !!}
                                    @endforeach
                                </span>
                            </td>

                            <td width='1%'>=</td>
                            <td width="8%">
                                <span>
                                    {{$nilaiS[$alt->id_alternatif]}}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <h4>Tidak ada data alternatif</h4>
                            </td>
                        </tr>
                        @endforelse
                    {{-- </tbody> --}}
                </table>
            </div>
        </div>

        <div class="col-12 weighted-product mt-5">
            <div class="card">
                <h3 class="text-center">Nilai V (mencari alternatif terbaik)</h3>
                <table class="table table-bordered" role="grid">
                    {{-- <tbody> --}}
                        @forelse ($alternatif as $key => $value)
                        <tr>
                            <td width='1%' class="align-middle">
                                <i>V</i><sub>{{$loop->iteration}}</sub>
                            </td>

                            <td width='1%' class="align-middle">=</td>
                            <td width='7%' class="text-center">
                                <span>{{$nilaiS[$value->id_alternatif]}}</span>
                                <hr class="solid">
                                <span>{{$dataNilaiS}}</span>
                            </td>

                            <td width='1%' class="align-middle">=</td>
                            <td width='5%' class="text-center">
                                <span>{{$nilaiS[$value->id_alternatif]}}</span>
                                <hr class="solid">
                                <span>{{array_sum($nilaiS)}}</span>
                            </td>

                            <td width='1%' class="align-middle">=</td>
                            <td width='5%' class="align-middle">
                                <span>{{round($nilaiS[$value->id_alternatif]/array_sum($nilaiS), 4)}}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4>Tidak ada data alternatif</h4>
                            </td>
                        </tr>
                        @endforelse
                    {{-- </tbody> --}}
                </table>
            </div>
        </div>

        <div class="col-12 weighted-product mt-5">
            <div class="card">
                <h3 class="text-center">Ranking</h3>
                <table class="table table-bordered" role="grid">
                    <tr>
                        <th>Rank</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                        {{-- @foreach ($ranking as $key => $rank)
                        <th class="bg-primary text-white">Ranking {{$key+1}}</th>
                        @endforeach --}}
                    </tr>
                    {{-- <tbody> --}}
                        @forelse ($ranking as $key => $rank)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{!!$rank['alternatif'] . ' (V<sub>' . $rank['no'] . '</sub>)'!!}</td>
                            <td>{{round($rank['nilai'], 4)}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <h4>Tidak ada data alternatif</h4>
                            </td>
                        </tr>
                        @endforelse
                    {{-- </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection