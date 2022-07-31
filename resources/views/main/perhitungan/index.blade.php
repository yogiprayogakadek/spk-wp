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
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" role="grid" id="tableData">
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

{{-- nilai W --}}
<div class="row">
    <div class="col-lg-6 col-xl-4">
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
    <div class="col-lg-6 col-xl-4">
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
    <div class="col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nilai S ternormalisasi dari setiap alternatif</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless" role="grid">
                    <tbody>
                        {{-- {{$nilaiAlternatif}} --}}
                        @foreach ($alternatif as $alternatif)
                        <tr>
                            <td width='5%'>
                                <i>S</i><sub>{{$loop->iteration}}</sub>
                            </td>

                            <td width='1%'>=</td>
                            <td width="18%">
                                <span>
                                    @foreach ($nilaiAlternatif[$alternatif->id_alternatif] as $key =>  $item)
                                        {!! '(' .$item['nilai']. '<sup>' . $item['nilaiW'] . '</sup>' . ')' !!}
                                    @endforeach
                                </span>
                            </td>


                            {{-- <td width='1%'>=</td>
                            <td width="18%">
                                <span>
                                    @foreach ($nilaiAlternatif[$alternatif->id_alternatif] as $key =>  $item)
                                        {!! '('. $item . '<sup>' . $nilaiW['total'] . '</sup>' . ')' !!}
                                    @endforeach
                                </span>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('#tableData').DataTable({
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
    });
</script>
@endpush