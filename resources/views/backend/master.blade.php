<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
        <link rel="icon" href="{{ asset('/img/logo-cwa.png') }}">

        <!-- data table -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        
        <!-- fileupload -->
        <link href="{{ asset('dist/font/font-fileuploader.css') }}" media="all" rel="stylesheet">
        <link href="{{ asset('dist/jquery.fileuploader.min.css') }}" media="all" rel="stylesheet">

        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

        <title>Portal CWJA @yield('title')</title>
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo-cwa.png') }}" width="38" class="d-inline-block align-top" alt="">
                    BACKEND PORTAL CWJA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href="{{ url('/backend/scoreboard') }}"> <i class="fas fa-star"></i> Scoreboard</a>
                        <a class="nav-item nav-link" href="{{ url('/backend/user') }}"><i class="fas fa-user-plus"></i></i> User</a>
                        <a class="nav-item nav-link" href="{{ url('/backend/member') }}"><i class="fas fa-user"></i> Member</a>
                        <a class="nav-item nav-link btn btn-danger" style="color:white" href="{{ url('/backend/logout') }}"><i class="fas fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar -->

        @yield('content')

        <!-- footer -->
        <div class="footer">
            <p>Copyright © 2019. Naufal Rivaldi.</p>
        </div>
        <!-- footer -->

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

        <!-- select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('js/sweetalert.js') }}"></script>

        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>