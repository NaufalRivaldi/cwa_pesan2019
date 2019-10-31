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
        
        @if(Helper::isPengumuman())
            <li <?= ($menu == '2') ? 'class="active"' : '' ?>>
                <a href="{{ url('admin/pengumuman') }}"><i class="fas fa-bullhorn"></i> Pengumuman</a>
            </li>
        @endif

        <li <?= ($menu == '3') ? 'class="active"' : '' ?>>
            <a href="{{ url('admin/scoreboard') }}"><i class="fas fa-star"></i> Scoreboard Penjualan</a>
        </li>

        @if(Helper::isPenjualanPU())
            <li <?= ($menu == '4') ? 'class="active"' : '' ?>>
                <a href="{{ url('admin/penjualanpu') }}"><i class="fas fa-star"></i> Penjualan PU</a>
            </li>
        @endif

        @if(Helper::isFinance())
            <li <?= ($menu == '5') ? 'class="active"' : '' ?>>
                <a href="{{ url('/admin/finance') }}"><i class="fas fa-file"></i> Finance</a>
            </li>
        @endif

        @if(Helper::isMaster())
        <li <?= ($menu == '6') ? 'class="active"' : '' ?>>
            <a href="{{ url('/admin/master') }}"><i class="fas fa-file-download"></i> Update Master</a>
        </li>
        @endif

        <li <?= ($menu == '7') ? 'class="active"' : '' ?>>
            <a href="#ubahPassword" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> Ubah Password</a>
            <ul class="collapse list-unstyled" id="ubahPassword">
                <li>
                    <a href="{{ url('admin/repassword') }}">User Password</a>
                </li>
                <li>
                    <a href="{{ route('kode.verifikasi') }}">Kode Verifikasi Form</a>
                </li>
            </ul>
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

        @if(Helper::isFormHRD())
        <li <?= ($menu == '9') ? 'class="active"' : '' ?>>
            <a href="#formHRD" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-signature"></i> Form HRD</a>
            <ul class="collapse list-unstyled" id="formHRD">
                <li>
                    <a href="{{ url('admin/formhrd/verifikasi') }}">Verifikasi</a>
                </li>
                <li>
                    <a href="{{ url('admin/formhrd/laporan') }}">Laporan</a>
                </li>
            </ul>
        </li>
        @endif
        
    </ul>
    <p class="footer">Copyright © 2019. Naufal Rivaldi.</p>
</nav>