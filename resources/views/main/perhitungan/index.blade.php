@extends('templates.master')

@section('title', 'Perhitungan')
@section('pwd', 'WP Product')
@section('sub-pwd', 'Perhitungan')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    hr.dashed {
        border-top: 2px dashed #999;
    }

    hr.dotted {
        border-top: 2px dotted #999;
    }

    hr.solid {
        border-top: 2px solid #999;
    }


    hr.hr-text {
        position: relative;
        border: none;
        height: 1px;
        background: #999;
    }

    hr.hr-text::before {
        content: attr(data-content);
        display: inline-block;
        background: #fff;
        font-weight: bold;
        font-size: 0.85rem;
        color: #999;
        border-radius: 30rem;
        padding: 0.2rem 2rem;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #button {
        display: block;
        margin: 20px auto;
        padding: 10px 30px;
        background-color: #eee;
        border: solid #ccc 1px;
        cursor: pointer;
    }

    #overlay {
        position: fixed;
        top: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        display: none;
        background: rgba(0, 0, 0, 0.6);
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px #ddd solid;
        border-top: 4px #2e93e6 solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
    }

    @keyframes sp-anime {
        100% {
            transform: rotate(360deg);
        }
    }

    .is-hide {
        display: none;
    }
</style>
@endpush

@section('content')
<div class="pull-right mb-2">
    <button class="btn btn-primary" id="btn-hitung">Hitung</button>
</div>

<div class="card">
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
</div>

{{-- nilai --}}
<div class="row">
    <div class="col-lg-6 col-xl-4 weighted-product">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nilai W</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless" role="grid">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4 weighted-product">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nilai W ternormalisasi</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless" role="grid">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4 weighted-product">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nilai S ternormalisasi dari setiap alternatif</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless" role="grid">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 weighted-product">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nilai V (mencari alternatif terbaik)</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless" role="grid">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 weighted-product">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ranking</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless" role="grid">
                    <thead>
                        <th>Rank</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                        {{-- @foreach ($ranking as $key => $rank)
                        <th class="bg-primary text-white">Ranking {{$key+1}}</th>
                        @endforeach --}}
                    </thead>
                    <tbody>
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




                        {{-- @if (count($ranking) > 0)  
                        <tr>
                            <td>Alternatif</td>
                            @foreach ($ranking as $key => $rank)
                            <td>{!!$rank['alternatif'] . ' (V<sub>' . $rank['no'] . '</sub>)'!!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Nilai</td>
                            @foreach ($ranking as $key => $ranking)
                            <td>{{round($ranking['nilai'], 4)}}</td>
                            @endforeach
                        </tr>
                        @else
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4>Tidak ada data alternatif</h4>
                            </td>
                        </tr>
                        @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>
<script>
    $(document).ready(function () {
        $('.weighted-product').prop('hidden', true);
        $('.tableData').DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                },
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                lengthMenu: "Show _MENU_ data",
                search: "Search:",
                emptyTable: "No data available",
                zeroRecords: "No matching data",
                loadingRecords: "Loading data...",
                processing: "Process...",
                infoFiltered: "(Filter from _MAX_ total data)"
            },
            lengthMenu: [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],
        });
        $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);　
        });
        $('#btn-hitung').click(function () {
            $.ajax({
            type: 'GET',
            success: function(data){
                // console.log(data);
            }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                    $('.weighted-product').prop('hidden', false);
                    $('#btn-hitung').prop('hidden', true);
                },500);
            });
        });
    });
</script>
@endpush