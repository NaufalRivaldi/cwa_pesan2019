$(document).ready(function () {
    // remove pengumuman
    $('.remove-pengumuman').click(function () {
        var postId = $(this).data('id');
        swal({
                title: "Hapus data?",
                text: "Data akan terhapus secara permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pengumuman/delete/" + postId;
                }
            });
    });

    // remove pesan
    $('.remove-pesan').click(function () {
        var postId = $(this).data('id');
        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus secara permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/inbox/hapus/" + postId;
                }
            });
    });

    // normal alert
    const flash = $('.flash').data('status');

    if (flash == 'simpan-success') {
        swal({
            title: "Success",
            text: "Data Telah Tersimpan",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'fail-login') {
        swal({
            title: "Login Gagal",
            text: "Username dan password tidak terdaftar.",
            icon: "error",
            button: "OK",
        });
    }

    if (flash == 'success-score') {
        swal({
            title: "Success",
            text: "Score telah tersimpan",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'error-score') {
        swal({
            title: "Error",
            text: "Score gagal tersimpan!",
            icon: "error",
            button: "OK",
        });
    }

    if (flash == 'success-pesan') {
        swal({
            title: "Success",
            text: "Pesan telah terkirim.",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'delete-pesan') {
        swal({
            title: "Success",
            text: "Pesan telah dihapus.",
            icon: "success",
            button: "OK",
        });
    }
});
