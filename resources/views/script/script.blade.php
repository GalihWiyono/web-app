<script type="text/javascript">
    console.log("script running");

    $(document).ready(function() {
        if ($('#toastNotification').hasClass("show")) {
            if ($('#toast-header').hasClass("text-success")) {
                setTimeout(function() {
                    $('#toastNotification').toast('hide');
                }, 2000);
            }

            if ($('#toast-header').hasClass("text-danger")) {
                setTimeout(function() {
                    $('#toastNotification').toast('hide');
                }, 10000);
            }
        }
    });

    $(document).on('click', '#searchNim', function() {
        $('#searchNim').attr("disabled", true);
        let nim = $('#nim_search').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/mahasiswa",
            data: {
                nim: nim,
            },
            method: 'POST',
            success: function(response) {
                console.log(response);
                if (response.status == "Valid" && response.errorMessage == "") {
                    $('#cariMahasiswaModal').modal('hide');
                    $('#nim_search').val('');
                    $('#searchNim').attr("disabled", false);
                    $('#nim_show').val(response.data.nim);
                    $('#nama_show').val(response.data.nama);
                    $('#tambahNilaiModal').modal('show');
                } else {
                    $('#nim_search').addClass('is-invalid');
                    $('#messageError').text(response.errorMessage)
                    $('#searchNim').attr("disabled", false);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    // $(document).on('click', '#hapusPegawai', function() {
    //     let id = $(this).attr('data-id');
    //     let nama = $(this).attr('data-nama');
    //     $('#id_hapus').val(id);
    //     $('#nama_hapus').val(nama);
    // });
</script>
