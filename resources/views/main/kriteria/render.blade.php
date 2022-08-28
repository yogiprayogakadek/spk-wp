<div class="col-12">
    <div class="alert alert-info">
        <i class="fa fa-exclamation-triangle"></i>
        Penentuan kriteria sudah dalam tahapan wawancara, sehingga kriteria yang digunakan sudah fix!
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-responsive table-bordered text-nowrap border-bottom dataTable no-footer" role="grid" id="tableData">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Normalisasi</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
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
                        <td>{{$kriteria->deskripsi ?? '-'}}</td>
                        <td>
                            <button class="btn btn-primary btn-edit" data-id="{{$kriteria->id_kriteria}}"><i class="fa fa-pencil"></i></button>
                        </td>
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
</div>

<!-- Modal Alternatif-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <label for="nama">Nama Kriteria</label>
                        <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama alternatif">
                        <div class="invalid-feedback error-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control deskripsi" rows="5" placeholder="masukkan deskripsi"></textarea>
                        <div class="invalid-feedback error-deskripsi"></div>
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