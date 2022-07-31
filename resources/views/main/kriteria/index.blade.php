@extends('templates.master')

@section('title', 'Kriteria')
@section('pwd', 'WP Product')
@section('sub-pwd', 'Kriteria')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="card render">
    <div class="card-body ">
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
                @foreach ($kriteria as $kriteria)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$kriteria->kode_kriteria}}</td>
                    <td>{{$kriteria->nama}}</td>
                    <td>{{$kriteria->bobot}}</td>
                    <td>{{$kriteria->bobot/100}}</td>
                    <td>{{ucfirst($kriteria->tipe)}}</td>
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