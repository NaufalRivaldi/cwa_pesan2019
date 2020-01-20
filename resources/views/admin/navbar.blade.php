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
            <!-- ultah -->
            <div class="navbar-nav col-md-6">
                @if(count(Helper::getUltah()) > 0)
                <marquee behavior="" direction=""><span class="navbar-text font-weight-bold" style="font-size: .8em">
                    Happy birthday to 
                    @foreach(Helper::getUltah() as $data)
                        {{ $data->nama.' ('.$data->divisi.'),' }}
                    @endforeach
                    Wish you all the best.
                </span></marquee>
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
                <a class="nav-item btn btn-danger" href="{{ url('logout') }}"><i class="fas fa-power-off"></i></a>
            </div>
        </div>
    </div>
</nav>