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

    // normal alert
    const flash = $('.flash').data('status');

    if (flash == 'simpan-success') {
        swal({
            title: "Success",
            text: "Simpan Telah Tersimpan",
            icon: "success",
            button: "OK",
        });
    }
});
