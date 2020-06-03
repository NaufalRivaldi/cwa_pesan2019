@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Verifikasi</h2>
                    </div>
                    <div class="card-body">
                    <h3><i class="fas fa-spinner"></i> Progress</h3>
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- office -->
                                    @if(!empty($form_office) && auth()->user()->level == 7)
                                        @foreach($form_office as $row)
                                        @if($row->stat <= 2)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">
                                                    {{ Helper::setDate($row->created_at) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    @endif

                                    @foreach($form as $row)
                                        @if($row->karyawanAll->stat > 1 && auth()->user()->level != 7)
                                            @if($row->karyawanAll->stat == 2 && $row->stat < 2)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">
                                                            {{ Helper::setDate($row->created_at) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                                    </td>
                                                    <!-- <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ Helper::setAlasan($row->id) }}</a>
                                                    </td> -->
                                                </tr>
                                            @endif
                                        @elseif(auth()->user()->level == 7 && $row->stat == 2)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">
                                                    {{ Helper::setDate($row->created_at) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h3><i class="fas fa-check-circle"></i> Selesai</h3>
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- office -->
                                    @if(!empty($form_office) && auth()->user()->level == 7)
                                        @foreach($form_office as $row)
                                        @if($row->stat > 2)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">
                                                    {{ Helper::setDate($row->created_at) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    @endif

                                    @foreach($form as $row)
                                        @if($row->karyawanAll->stat > 1 && auth()->user()->level != 7)
                                            @if($row->karyawanAll->stat == 2 && $row->stat >= 2)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">
                                                            {{ Helper::setDate($row->created_at) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                                    </td>
                                                    <!-- <td>
                                                        <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ Helper::setAlasan($row->id) }}</a>
                                                    </td> -->
                                                </tr>
                                            @endif
                                        @elseif(auth()->user()->level == 7 && $row->stat > 2)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">
                                                    {{ Helper::setDate($row->created_at) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('verifikasi.detail', ['id' => $row->id]) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection