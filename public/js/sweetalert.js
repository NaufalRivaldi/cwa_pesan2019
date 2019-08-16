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
});
