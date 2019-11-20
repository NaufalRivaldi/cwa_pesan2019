$(document).ready(function () {
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

    if (flash == 'import-success') {
        swal({
            title: "Success",
            text: "Data berhasil di import.",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'form-success') {
        swal({
            title: "Success",
            text: "Form berhasil di acc.",
            icon: "success",
            button: "OK",
        });
    }

    if (flash == 'form-error') {
        swal({
            title: "Error",
            text: "Form gagal di acc!",
            icon: "error",
            button: "OK",
        });
    }
});
