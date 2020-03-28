<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="row">
            <div class="col-2" style="padding:0">
                <img src="{{ asset('img/logo-cwa.png') }}" alt="logo-cwa" width="100%">
            </div>
            <div class="col-10" style="padding:0">
                <h3><a href="{{ route('dashboard') }}">PORTAL CWJA</a></h3>
            </div>
        </div>
    </div>

    <ul class="list-unstyled components">
        <p>
            <a href="{{ url('admin/pesan/form') }}" class="btn btn-warning btn-lg btn-block"><i class="fas fa-envelope"></i> Buat Pesan Baru</a>
        </p>
        <li <?= ($menu == '0') ? 'class="active"' : '' ?>>
            <a href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="right" title="Berisi Informasi seputaran CWJA"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>

        @if(Helper::isLaporan())
        <li <?= ($menu == '13') ? 'class="active"' : '' ?>>
            <a href="#dataMaster" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-database"></i> Data Master</a>
            <ul class="collapse list-unstyled" id="dataMaster">
                <li>                    
                    <a href="#masterIT" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-laptop-code"></i> IT</a>
                    <ul class="collapse list-unstyled" id="masterIT">
                        <a href="#mixingMaster" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-paint-brush"></i> Mixing</a>
                        <ul class="collapse list-unstyled" id="mixingMaster">
                            <li>
                                <a class="nav-link" href="{{ route('mixing.merk') }}"><i class="fa fa-fw fas fa-dolly"></i> Mesin </a>
                            </li>

                            <li>
                                <a class="nav-link" href="{{ route('mixing.product') }}"><i class="fa fa-fw fas fa-dolly"></i> Produk </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('mixing.formula') }}"><i class="fas fa-flask"></i> Formula</a>
                            </li>
                        </ul>
                    </ul>
                </li>
                @if(Helper::isHRD())
                <li>
                    <a href="#laporanHRD" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users"></i> HRD</a>
                    <ul class="collapse list-unstyled" id="laporanHRD">
                        <li>    
                            <a href="{{ route('laporan.hrd.karyawan') }}" data-toggle="tooltip" data-placement="right" title="Data Karyawan Citra Warna."><i class="fas fa-users"></i> Karyawan</a>
                        </li>
                        <a href="#masterPKK" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users"></i> Kinerja Karyawan</a>
                        <ul class="collapse list-unstyled" id="masterPKK">                            
                            <li>
                                <a class="nav-link" href="{{ route('pkk.periode') }}"><i class="fa fa-fw fa-users"></i> Periode </a>
                            </li> 
                            <li>
                                <a class="nav-link" href="{{ route('pkk.kuisioner') }}"><i class="fa fa-fw fa-users"></i> Kuesioner </a>
                            </li> 
                            <li>
                                <a class="nav-link" href="{{ route('pkk.indikator') }}"><i class="fa fa-fw fa-users"></i> Indikator </a>
                            </li> 
                        </ul>
                        <a href="#masterForms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users"></i> Form Cuti</a>
                        <ul class="collapse list-unstyled" id="masterForms">                            
                            <li>
                                <a class="nav-link" href="{{ route('form.hrd.cuti') }}"><i class="fa fa-fw fa-users"></i> Cuti </a>
                            </li>                            
                            <li>
                                <a class="nav-link" href="{{ route('form.hrd.cuti.kategori') }}"><i class="fa fa-fw fa-users"></i> Kategori Cuti </a>
                            </li> 
                        </ul>
                    </ul>
                </li>
                @endif

                @if(Helper::isGA())
                <li>
                    <a href="#masterGA" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-signature"></i> General Affair</a>
                    <ul class="collapse list-unstyled" id="masterGA">
                        <li>    
                            <a href="#masterPeminjaman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users"></i> Form Peminjaman</a>
                            <ul class="collapse list-unstyled" id="masterPeminjaman">     
                                <li>
                                    <a class="nav-link" href="{{ route('master.sarana.index') }}"><i class="fa fa-fw fa-users"></i> List Sarana </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </li>
        @endif
        
        @if(Helper::isPengumuman())
            <li <?= ($menu == '2') ? 'class="active"' : '' ?>>
                <a href="{{ url('admin/pengumuman') }}" data-toggle="tooltip" data-placement="right" title="Pengumuman internal CWJA."><i class="fas fa-bullhorn"></i> Pengumuman</a>
            </li>
        @endif

        <li <?= ($menu == '1') ? 'class="active"' : '' ?>>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-envelope"></i> Pesan <span class="badge badge-warning">{{ Helper::countRead() }}</span></a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="{{ url('admin/pesan/inbox') }}">Pesan Masuk <span class="badge badge-warning">{{ Helper::countRead() }}</span></a>
                </li>
                <li>
                    <a href="{{ url('admin/pesan/outbox') }}">Pesan Keluar</a>
                </li>
                <li>
                    <a href="{{ url('admin/pesan/trash') }}">Tempat Sampah</a>
                </li>
            </ul>
        </li>

        <li <?= ($menu == '3') ? 'class="active"' : '' ?>>
            <a href="{{ url('admin/scoreboard') }}" data-toggle="tooltip" data-placement="right" title="Total score penjualan PU."><i class="fas fa-star"></i> Scoreboard Penjualan</a>
        </li>

        @if(Helper::isPenjualanPU())
            <li <?= ($menu == '4') ? 'class="active"' : '' ?>>
                <a href="{{ url('admin/penjualanpu') }}" data-toggle="tooltip" data-placement="right" title="Jumlah tonase dari penjualan PU."><i class="fas fa-star"></i> Penjualan PU</a>
            </li>
        @endif

        @if(Helper::isAM())
        <li <?= ($menu == '10') ? 'class="active"' : '' ?>>
            <a href="{{ route('score.produk') }}" data-toggle="tooltip" data-placement="right" title="Score produk PU secara spesifik."><i class="fas fa-star"></i> Score Produk</a>
        </li>
        @endif

        <li <?= ($menu == '8') ? 'class="active"' : '' ?>>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-file-signature"></i> E-Form <span class="text-warning">*</span>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#pageHRD" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">HRD</a> 
                    <ul class="collapse list-unstyled" id="pageHRD">
                        <li>
                            <a href="{{ url('admin/formhrd') }}">Form Umum<span class="badge badge-warning">{{ Helper::countPending() }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('form.hrd.cuti') }}">Form Cuti <span class="badge badge-warning">{{ Helper::countPending() }}</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageIT" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">IT Support <span class="badge badge-warning">{{ (auth()->user()->dep == 'IT')? Helper::countFormDesain() : '' }}</span></a>
                    <ul class="collapse list-unstyled" id="pageIT">
                        <li>
                            <a href="{{ route('penanganan.it') }}">Penanganan IT</a>
                        </li>
                        <li>
                            <a href="{{ route('desainIklan') }}">Pengajuan Desain <span class="badge badge-warning">{{ Helper::countFormDesain() }}</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageGA" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">General Affair <span class="text-warning">*</span></a>
                    <ul class="collapse list-unstyled" id="pageGA">
                        @if(Helper::isOffice())
                        <li>
                            <a href="{{ route('form.ga.peminjaman') }}">Peminjaman Sarana <span class="badge badge-warning">{{ Helper::countFormPeminjaman() }}</span></a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('form.ga.perbaikan') }}">Perbaikan Sarana <span class="badge badge-warning">{{ Helper::countFormPerbaikan() }}</span></a>
                        </li>
                    </ul>
                </li>
                @if(Helper::isVerifikasi())
                <li>
                    <a href="{{ url('admin/formhrd/verifikasi') }}">Verifikasi <span class="badge badge-warning">{{ Helper::countVerifikasi() }}</span></a>
                </li>
                @endif
            </ul>
        </li>

        @if(Helper::isFinance())
            <li <?= ($menu == '5') ? 'class="active"' : '' ?>>
                <a href="{{ url('/admin/finance') }}" data-toggle="tooltip" data-placement="right" title="File penjualan harian cabang."><i class="fas fa-file"></i> {{ (Helper::ubahFinance()) ? 'Kirim Data Ke Pusat' : 'Finance' }}</a>
            </li>
        @endif

        @if(Helper::isMaster())
        <li <?= ($menu == '6') ? 'class="active"' : '' ?>>
            <a href="{{ url('/admin/master') }}"><i class="fas fa-file-download"></i> Update Master</a>
        </li>
        @endif
        
        @if(Helper::isMixing())
            @if(auth()->user()->dep != 'IT')
                <li>
                    <a href="" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-file-signature"></i> Mixing
                    </a>
                </li>
                <li>
                    <a href="{{ route('mixing.customers') }}" class="ml-3"><i class="fa fa-users"></i> Pelanggan </a>
                </li>
                <li>
                    <a href="{{ route('mixing.mixing') }}" class="ml-3"><i class="fa fas fa-paint-brush"></i> Mixing </a>
                </li>
            @else
                <li <?= ($menu == '11') ? 'class="active"' : '' ?> data-toggle="tooltip" data-placement="right" title="Perekapan data mixing.">
                    <a href="#pageMixing" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-file-signature"></i> Mixing
                    </a>
                    <ul class="collapse list-unstyled" id="pageMixing">
                        <li>
                            <a class="nav-link" href="{{ route('mixing.customers') }}"><i class="fa fa-fw fa-users"></i> Pelanggan </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('mixing.mixing') }}"><i class="fa fa-fw fas fa-paint-brush"></i> Mixing </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif
        
        <li <?= ($menu == '12') ? 'class="active"' : '' ?>>
            <a href="#pagePkk" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-file-signature"></i> P. Kinerja Karyawan
            </a>
            <ul class="collapse list-unstyled" id="pagePkk">
                <li>
                    <a class="nav-link" href="{{ route('pkk.penilaian') }}"><i class="fa fa-fw fa-users"></i> Penilaian </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('pkk.bestemp.index') }}"><i class="fa fa-fw fa-users"></i> Kandidat Best Employee</a>
                </li>
            </ul>
        </li>

        <li <?= ($menu == '7') ? 'class="active"' : '' ?>>
            <a href="#ubahPassword" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> Ubah Password</a>
            <ul class="collapse list-unstyled" id="ubahPassword">
                <li>
                    <a href="{{ url('admin/repassword') }}" data-toggle="tooltip" data-placement="right" title="Perubahan password terhadap akun utama cabang.">User Password</a>
                </li>
                <li>
                    <a href="{{ route('kode.verifikasi') }}" data-toggle="tooltip" data-placement="right" title="Perubahan password terhadap kapala bagian sebagai verifikasi form.">Kode Verifikasi Form</a>
                </li>
            </ul>
        </li>
        
        @if(Helper::isLaporan())
        <li <?= ($menu == '9') ? 'class="active"' : '' ?>>
            <a href="#laporan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-signature"></i> Laporan</a>
            <ul class="collapse list-unstyled" id="laporan">
                @if(Helper::isHRD())
                <li>
                    <a href="#laporanHRD" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-signature"></i> HRD</a>
                    <ul class="collapse list-unstyled" id="laporanHRD">
                        <li>
                            <a href="{{ url('admin/formhrd/laporan') }}">Form HRD</a>
                        </li>
                        <li>
                            <a href="{{ route('laporan.hrd.hasilpoling') }}">Hasil Poling & Kandidat</a>
                        </li>
                        <li>
                            <a href="{{ route('laporan.hrd.penilaian.bestemp') }}">Hasil Best Employee</a>
                        </li>
                        <li>
                            <a href="{{ route('laporan.hrd.penilaian.kabag') }}">Hasil Penilaian Kabag</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Helper::isGA())
                <li>
                    <a href="#laporanGA" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-signature"></i> General Affair</a>
                    <ul class="collapse list-unstyled" id="laporanGA">
                        <li>    
                            <a href="{{ route('laporan.ga.peminjaman.index') }}">Peminjaman Sarana</a>
                        </li>
                        <li>    
                            <a href="{{ route('laporan.ga.perbaikan') }}">Perbaikan Sarana</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
    <p class="footer text-white">Copyright © 2019. Naufal Rivaldi.</p>
</nav>