function getData() {
    $.ajax({
        type: "get",
        url: "alternatif/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-add', function () {
        $('#modal').modal('show');
        $('#modal .modal-title').html('Tambah Alternatif');
        $('#modal .modal-body').find('form').attr('id', 'formAdd');
        $('#modal .modal-footer').find('.btn-primary').addClass('btn-save').removeClass('btn-update');
        $('#modal .modal-body').find('form').find('input[name="nama"]').val('');
        $('#modal').find('#id_alternatif').remove();
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formAdd')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "alternatif/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-save').attr('disable', 'disabled')
                $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-save').removeAttr('disable')
                $('.btn-save').html('Simpan')
            },
            success: function (response) {
                $('#formAdd').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                $('#modal').modal('hide')
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formAdd').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $('#modal').find('#id_alternatif').remove();
        $.get("alternatif/edit/"+id, function (data) {
            $('#modal').modal('show');
            $('#modal .modal-title').html('Edit Alternatif');
            $('#modal .modal-body').find('form').attr('id', 'formEdit');
            $('#modal .modal-footer').find('.btn-primary').addClass('btn-update').removeClass('btn-save');
            $('#modal .modal-body').find('form').append('<input type="hidden" id="id_alternatif" name="id_alternatif" value="' + id + '">');
            $('#modal .modal-body').find('form').find('input[name="nama"]').val(data.nama);
        });
    });

    // on update button
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formEdit')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "alternatif/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-update').attr('disable', 'disabled')
                $('.btn-update').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-update').removeAttr('disable')
                $('.btn-update').html('Simpan')
            },
            success: function (response) {
                $('#formAdd').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                $('#modal').modal('hide')
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formEdit').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-delete', function () {
        let id = $(this).data('id')
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "alternatif/delete/" + id,
                    dataType: "json",
                    success: function (response) {
                        $(".render").html(response.data);
                        getData();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    },
                });
            }
        })
    });


    // NILAI
    $('body').on('click', '.btn-add-nilai', function () {
        let id = $(this).data('id')
        $('#modalNilai').modal('show');
        $('#modalNilai .modal-title').html('Tambah Nilai');
        $('#modalNilai .modal-body').find('form').attr('id', 'formAddNilai');
        $('#modalNilai .modal-footer').find('.btn-primary').addClass('btn-save-nilai');
        $('#modalNilai .modal-body').find('form').trigger('reset');
        $('#modalNilai').find('#id_alternatif').val(id);
        $('body').find('.nilai').inputFilter(function(value) {
            return /^\d*$/.test(value);
        }, 'hanya angka yang diperbolehkan');
    });

    $('body').on('click', '.btn-edit-nilai', function () {
        let id = $(this).data('id')
        $('#modalNilai').find('#id_alternatif').val(id);
        $.get("nilai/edit/"+id, function (data) {
            $('#modalNilai').modal('show');
            $('#modalNilai .modal-title').html('Edit Nilai');
            $('#modalNilai .modal-body').find('form').attr('id', 'formAddNilai');
            $('#modalNilai .modal-footer').find('.btn-primary').addClass('btn-save-nilai');
            $('body').find('.nilai').inputFilter(function(value) {
                return /^\d*$/.test(value);
            }, 'hanya angka yang diperbolehkan');
            $.each(data.kriteria, function (index, value) { 
                $('#modalNilai .modal-body').find('form').find('input[name="'+value+'"]').val(data.nilai[index].nilai);
            });
        });
    });

    $('body').on('click', '.btn-save-nilai', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formAddNilai')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "nilai/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-save-nilai').attr('disable', 'disabled')
                $('.btn-save-nilai').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-save-nilai').removeAttr('disable')
                $('.btn-save-nilai').html('Simpan')
            },
            success: function (response) {
                $('#formAddNilai').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                $('#modalNilai').modal('hide')
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formAddNilai').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });
});