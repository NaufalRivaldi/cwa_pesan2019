@extends('admin.master')

@section('title', '- Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form HRD Proses</div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countPending() }} Form</p>
                    <a href="{{ route('form.hrd') }}" class="btn btn-dark btn-sm btn-block"><i class="fas fa-eye"></i> Lihat</a>
                </div>
            </div>
        </div>
        @if(Helper::isVerifikasi())
        <div class="col-md-4">
            <div class="card text-white bg-success mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form HRD Belum terverifikasi</div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countVerifikasi() }} Form</p>
                    <a href="{{ route('verifikasi') }}" class="btn btn-dark btn-sm btn-block"><i class="fas fa-eye"></i> Lihat</a>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-4">
            <div class="card text-white bg-info mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form Desain (Proses)</div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countFormDesain() }} Form</p>
                    <a href="{{ route('desainIklan') }}" class="btn btn-dark btn-sm btn-block"><i class="fas fa-eye"></i> Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form Perbaikan Sarana (Proses)</div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countFormPerbaikan() }} Form</p>
                    <a href="{{ route('desainIklan') }}" class="btn btn-dark btn-sm btn-block"><i class="fas fa-eye"></i> Lihat</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pengumuman Internal</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Tanggal</th>
                                <th>Pengirim</th>
                                <th>Subject</th>
                            </thead>
                            <tbody>
                                @if(!empty($pengumuman))
                                    @foreach($pengumuman as $row)
                                        <tr>
                                            <td width="20%">
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block"><span class="badge badge-warning">{{ $row->tgl }}</span></a>
                                            </td>
                                            <td width="30%">
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block">{{ $row->user->nama.' - '.$row->user->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block">{{ $row->subject }}
                                                <?php  
                                                    $date1 = new DateTime($row->tgl);
                                                    $date2 = new DateTime($date_now);
                                                    $diff = $date1->diff($date2);
                                                ?>
                                                @if($diff->days < 2)
                                                    <span class="text-blink">New!</span>
                                                @endif
                                                </a>
                                                @foreach($row->attachPengumuman as $att)
                                                    <a href="{{ asset('Upengumuman/'.$att->nama_file) }}" download="{{ $att->nama }}">
                                                        <span class="badge badge-info">{{ $att->nama }}</span>
                                                    </a> 
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="margin-top:1%">
                        <div class="col-12">
                            {{ $pengumuman->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection