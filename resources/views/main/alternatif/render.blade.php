<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Data Alternatif</div>
            <div class="card-options">
                <button class="btn btn-primary btn-add">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" role="grid" id="tableData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->nama}}</td>
                        <td>
                            <span data-id="{{$data->id_alternatif}}" class="{{$data->nilai()->sum('nilai') == 0 ? 'badge bg-primary btn-add-nilai' : 'badge bg-info btn-edit-nilai'}}" style="cursor: pointer">{!!$data->nilai()->sum('nilai') == 0 ? 'Tambah Nilai' : 'Lihat/Ubah Nilai'!!}</span>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-edit" data-id="{{$data->id_alternatif}}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-delete" data-id="{{$data->id_alternatif}}">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Alternatif-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Title</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama">Nama Alternatif</label>
                        <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama alternatif">
                        <div class="invalid-feedback error-nama"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Nilai --}}
<div class="modal fade" id="modalNilai" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Title</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id_alternatif" id="id_alternatif">
                    @foreach ($kriteria as $key => $kriteria)
                    <div class="form-group">
                        <label for="nama">{{$kriteria->nama}} {{$satuan[$key]}}</label>
                        <input type="text" class="form-control nilai {{strtolower(str_replace(' ','_',$kriteria->nama))}}" name="{{strtolower(str_replace(' ','_',$kriteria->nama))}}" id="{{strtolower(str_replace(' ','_',$kriteria->nama))}}" placeholder="masukkan nilai {{strtolower($kriteria->nama)}}">
                        <div class="invalid-feedback error-{{strtolower(str_replace(' ','_',$kriteria->nama))}}"></div>
                    </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

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