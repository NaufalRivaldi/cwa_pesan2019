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

    // remove pesan inbox
    $('.remove-pesan').click(function () {
        var postId = $(this).data('id');
        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus ke tempat sampah.",
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

    // remove pesan checked
    $(document).on('click', '.remove-pesan-checked', function () {
        // masukkan ke array dulu data idnya
        var id = $('.chcks').map(function () {
            if ($(this).is(':checked')) {
                return $(this).val();
            }
        }).get();

        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus ke tempat sampah.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/inbox/hapuscek/" + id;
                }
            });
    });

    // remove pesan outbox
    $('.remove-pesan-outbox').click(function () {
        var postId = $(this).data('id');
        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus ke tempat sampah.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/outbox/hapus/" + postId;
                }
            });
    });

    // remove pesan trash
    $('.remove-pesaninbox-trash').click(function () {
        var postId = $(this).data('id');
        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/trash/hapusin/" + postId;
                }
            });
    });

    // remove pesan trash
    $('.remove-pesanoutbox-trash').click(function () {
        var postId = $(this).data('id');
        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/trash/hapusout/" + postId;
                }
            });
    });

    // remove pesan checked outbox
    $(document).on('click', '.remove-pesan-checked-outbox', function () {
        // masukkan ke array dulu data idnya
        var id = $('.chcksOutbox').map(function () {
            if ($(this).is(':checked')) {
                return $(this).val();
            }
        }).get();

        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus ke tempat sampah.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/outbox/hapuscek/" + id;
                }
            });
    });

    // remove pesan checked trash
    $(document).on('click', '.remove-pesan-checked-trash', function () {
        // masukkan ke array dulu data idnya
        var id = $('.chckstrash').map(function () {
            if ($(this).is(':checked')) {
                return $(this).val();
            }
        }).get();

        swal({
                title: "Hapus pesan?",
                text: "Pesan akan terhapus permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/trash/hapuscek/" + id;
                }
            });
    });

    // remove pesan checked kembali
    $(document).on('click', '.backup-pesan-checked-trash', function () {
        // masukkan ke array dulu data idnya
        var id = $('.chckstrash').map(function () {
            if ($(this).is(':checked')) {
                return $(this).val();
            }
        }).get();

        swal({
                title: "Kembalikan Pesan?",
                text: "Pesan akan dipulihkan.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin/pesan/trash/pulihcek/" + id;
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

    if (flash == 'error-status) {
        swal({
            title: "Error",
            text: "User sudah tidaks aktif!",
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

    if (flash == 'pulih-pesan') {
        swal({
            title: "Success",
            text: "Pesan telah dikembalikan.",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'formhrd-success') {
        swal({
            title: "Success",
            text: "Form telah diajukan.",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'reset-success') {
        swal({
            title: "Success",
            text: "Password telah direset.",
            icon: "success",
            button: "OK",
        });
    }
});
