<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- data table -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<!-- tinymce -->
<script src="https://cdn.tiny.cloud/1/8umgjhgub5p9ybjnnc9zo5xwvo264tfnvficzvbynegdl1c4/tinymce/5/tinymce.min.js"></script>

<!-- fileupload -->
<script src="{{ asset('dist/jquery.fileuploader.min.js') }}" type="text/javascript"></script>

<!-- sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{ asset('js/sweetalert.js') }}"></script>

<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    // set status notif
    $(document).ready(function(){
        // click
        $('.clickNotif').click(function(){
            $.get("{{ url('admin/clicknotif') }}/", function(data, status){
                $('.countNotif').empty();
                $('.countNotif').append('0');
            });
        });
        
        // read
        $('.notif').click(function(){
            var id = $(this).data('id');
            $.get("{{ url('admin/readnotif/') }}/"+id, function(data, status){});
        });

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
                        window.location.href = "{{ url('admin/pengumuman/delete/') }}/" + postId;
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
                        window.location.href = "{{ url('admin/pesan/inbox/hapus/') }}/" + postId;
                    }
                });
        });

        // remove desain
        $('.remove-form-desain').click(function () {
            var postId = $(this).data('id');
            swal({
                    title: "Hapus Form Desain?",
                    text: "Form ini akan terhapus secara permanen.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "{{ url('admin/formit/desain/delete/') }}/" + postId;
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
                        window.location.href = "{{ url('admin/pesan/inbox/hapuscek/') }}/" + id;
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
                        window.location.href = "{{ url('admin/pesan/outbox/hapus/') }}/" + postId;
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
                        window.location.href = "{{ url('admin/pesan/trash/hapusin/') }}/" + postId;
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
                        window.location.href = "{{ url('admin/pesan/trash/hapusout/') }}/" + postId;
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
                        window.location.href = "{{ url('admin/pesan/outbox/hapuscek/') }}/" + id;
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
                        window.location.href = "{{ url('admin/pesan/trash/hapuscek/') }}/" + id;
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
                        window.location.href = "{{ url('admin/pesan/trash/pulihcek/') }}/" + id;
                    }
                });
        });

        // remove form-hrd
        $('.delete_form_hrd').click(function () {
            var postId = $(this).data('id');
            swal({
                    title: "Hapus form?",
                    text: "Form akan terhapus permanen.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "{{ url('admin/formhrd/delete/') }}/" + postId;
                    }
                });
        });

        // remove form-it
        $('.delete_form_it').click(function () {
            var postId = $(this).data('id');
            swal({
                    title: "Hapus form?",
                    text: "Form akan terhapus permanen.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "{{ url('admin/formit/delete/') }}/" + postId;
                    }
                });
        });

        // pengumuman
        $('.clickPengumuman').click(function(){
            var id = $(this).data('id');
            $('.pengumuman_id').val(id);
        });

        // form
        $('.remove-form-hrd').click(function(){
            var id = $(this).data('id');
            $('.form_hrd_id').val(id);
        });

        // enable tooltip
        $('[data-toggle="tooltip"]').tooltip()

        // reset password
        $('.confirmPassword').on('keyup', function() {
            var newPass = $('.newPassword').val();
            var confirmPass = $('.confirmPassword').val();            
            if (newPass != confirmPass) {
            $('.btnSave').attr("disabled",'disabled');
            $('.confirmPassword').addClass('is-invalid');            
            $('.confirmPassword').removeClass('is-valid');
            }else{              
            $('.confirmPassword').removeClass('is-invalid');
            $('.confirmPassword').addClass('is-valid');
            $('.btnSave').removeAttr('disabled');
            }
            // console.log(confirmPass);
        
        })
    });
</script>

<!-- Script -->
@yield('js')