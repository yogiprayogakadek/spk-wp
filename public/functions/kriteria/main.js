function getData() {
    $.ajax({
        type: "get",
        url: "kriteria/render",
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
    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $('#modal').find('#id_kriteria').remove();
        $.get("kriteria/edit/"+id, function (data) {
            $('#modal').modal('show');
            $('#modal .modal-title').html('Edit Kriteria');
            $('#modal .modal-body').find('form').attr('id', 'formEdit');
            $('#modal .modal-footer').find('.btn-primary').addClass('btn-update').removeClass('btn-save');
            $('#modal .modal-body').find('form').append('<input type="hidden" id="id_kriteria" name="id_kriteria" value="' + id + '">');
            $('#modal .modal-body').find('form').find('input[name="nama"]').val(data.nama);
            $('#modal .modal-body').find('form').find('input[name="deskripsi"]').val(data.deskripsi);
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
            url: "kriteria/update",
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
                $('#formEdit').trigger('reset')
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
});