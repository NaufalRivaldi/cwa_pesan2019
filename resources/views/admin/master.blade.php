<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

        <title>Admin Portal CWJA @yield('title')</title>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <div class="row">
                        <div class="col-2" style="padding:0">
                            <img src="{{ asset('img/logo-cwa.png') }}" alt="logo-cwa" width="100%">
                        </div>
                        <div class="col-10" style="padding:0">
                            <h3>PORTAL CWJA</h3>
                        </div>
                    </div>
                </div>

                <ul class="list-unstyled components">
                    <p>
                        <a href="{{ url('admin/pesan/form') }}" class="btn btn-warning btn-lg btn-block"><i class="fas fa-envelope"></i> Buat Pesan Baru</a>
                    </p>
                    <li <?= ($menu == '1') ? 'class="active"' : '' ?>>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-envelope"></i> Pesan</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="{{ url('admin/pesan/inbox') }}">Pesan Masuk</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/pesan/outbox') }}">Pesan Keluar</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/pesan/trash') }}">Tempat Sampah</a>
                            </li>
                        </ul>
                    </li>
                    <li <?= ($menu == '2') ? 'class="active"' : '' ?>>
                        <a href="{{ url('admin/pengumuman') }}"><i class="fas fa-bullhorn"></i> Pengumuman</a>
                    </li>
                    <li <?= ($menu == '3') ? 'class="active"' : '' ?>>
                        <a href="{{ url('admin/scoreboard') }}"><i class="fas fa-star"></i> Scoreboard Penjualan</a>
                    </li>
                    <li <?= ($menu == '4') ? 'class="active"' : '' ?>>
                        <a href="{{ url('admin/penjualanpu') }}"><i class="fas fa-star"></i> Penjualan PU</a>
                    </li>
                    <li <?= ($menu == '5') ? 'class="active"' : '' ?>>
                        <a href="{{ url('/admin/finance') }}"><i class="fas fa-file"></i> Finance</a>
                    </li>
                    <li <?= ($menu == '6') ? 'class="active"' : '' ?>>
                        <a href="{{ url('/admin/master') }}"><i class="fas fa-file-download"></i> Update Master</a>
                    </li>
                    <li <?= ($menu == '7') ? 'class="active"' : '' ?>>
                        <a href="{{ url('admin/repassword') }}"><i class="fas fa-cog"></i> Ubah Password</a>
                    </li>
                    <li <?= ($menu == '8') ? 'class="active"' : '' ?>>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-signature"></i> E-Form</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="{{ url('admin/formhrd') }}">HRD</a>
                            </li>
                            <li>
                                <a href="#">IT</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <p class="footer">Copyright © 2019. Naufal Rivaldi.</p>
            </nav>

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
                            <div class="navbar-nav ml-auto">
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
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Flash Data -->
        <span class="flash" data-status="{{ session('status') }}"></span>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- data table -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

        <!-- tinymce -->
        <script src="https://cdn.tiny.cloud/1/8umgjhgub5p9ybjnnc9zo5xwvo264tfnvficzvbynegdl1c4/tinymce/5/tinymce.min.js"></script>

        <!-- fileupload -->
        <script src="{{ asset('dist/jquery.fileuploader.min.js') }}" type="text/javascript"></script>

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('js/sweetalert.js') }}"></script>

        <!-- select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

        <!-- Custom JS -->
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>