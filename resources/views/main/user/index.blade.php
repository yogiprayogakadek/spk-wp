@extends('templates.master')

@section('title', 'Data Pengguna')
@section('pwd', 'Data Pengguna')
@section('sub-pwd', 'Data')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Pengguna</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" role="grid" id="tableData">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No. Hp</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->no_hp}}</td>
                            <td>
                                <img src="{{$data->foto}}" class="img-fluid" width="50px">
                            </td>
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
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>
@endpush