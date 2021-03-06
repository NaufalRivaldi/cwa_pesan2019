<!doctype html>
<html lang="en">
    <head>
        @include('admin.header')
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            @include('admin.sidebar')

            <!-- Page Content Holder -->
            <div id="content">

                @include('admin.navbar')
                
                @include('admin.defpass')
                @include('admin.alert')
                @yield('content')
            </div>
        </div>

        <!-- modal -->
        @yield('modal')

        <!-- javascript -->
        @include('admin.javascript')
    </body>
</html>