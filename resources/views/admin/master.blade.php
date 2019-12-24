<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
        <link rel="icon" href="{{ asset('/img/logo-cwa.png') }}">

        <!-- data table -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        
        <!-- fileupload -->
        <link href="{{ asset('dist/font/font-fileuploader.css') }}" media="all" rel="stylesheet">
        <link href="{{ asset('dist/jquery.fileuploader.min.css') }}" media="all" rel="stylesheet">

        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

        <!-- jquery ui -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <title>Admin Portal CWJA @yield('title')</title>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            @include('admin.sidebar')

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="navbar-nav">
                                @if(count(Helper::getUltah()) > 0)
                                <span class="text-blink navbar-text" style="font-size: .8em">
                                    Happy birthday to 
                                    @foreach(Helper::getUltah() as $data)
                                        {{ $data->nama.' ('.$data->divisi.'),' }}
                                    @endforeach
                                    Wish you all the best.
                                </span>
                                @endif
                            </div>
                            <div class="navbar-nav ml-auto">
                                <!-- dropdown -->
                                <div class="dropdown">
                                    <a class="nav-link mr-3 clickNotif" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-bell text-primary"></i>
                                        <span class="badge badge-danger countNotif">{{ Helper::countNotif() }}</span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @if(count(Helper::showNotifikasi()) > 0)
                                            @foreach(Helper::showNotifikasi() as $n)
                                                <a class="custom-item-dropdown notif" href="{{ url($n->link) }}" data-id="{{ $n->id }}">
                                                    <p class="<?= ($n->baca == 1) ? 'font-weight-bold' : '' ?>">
                                                        {{date('d F Y, H:i;s', strtotime($n->created_at))}}<br>
                                                        {!! $n->keterangan !!}
                                                    </p>
                                                </a>
                                            @endforeach
                                        @else
                                            <a class="custom-item-dropdown">
                                                <p>Tidak ada notifikasi.</p>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!-- dropdown -->

                                <img src="{{ asset('img/user.png') }}" alt="logo-cwa" width="40">
                                <span class="navbar-text">
                                    Halo, {{ auth()->user()->nama }} &nbsp;
                                </span>
                                <a class="nav-item btn btn-danger" href="{{ url('logout') }}"><i class="fas fa-power-off"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <div class="container">
                    @include('admin.defpass')
                    @include('admin.alert')
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- modal -->
        @yield('modal')

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

                // remove pesan inbox
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
            });
        </script>

        <!-- modal -->
        @yield('js')
    </body>
</html>