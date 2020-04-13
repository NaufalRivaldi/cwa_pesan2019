@extends('admin.master')

@section('title', '- Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="display-4" style="font-size: 2.5em">Pengumuman Internal</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover tableCustom" id="myTable2">
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
                                                <a href="{{ url('/admin/dashboard/detailp/'.$row->id) }}" class="a-block"><span class="badge badge-warning">{{ Helper::setDate($row->tgl) }}</span></a>
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
        </div>

        <!-- card -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form HRD <span class="badge badge-pill badge-danger">Proses</span></div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countPending() }} Form</p>
                    <a href="{{ route('form.hrd') }}" class="btn btn-dark btn-sm btn-block"><i class="far fa-eye"></i> Lihat</a>
                </div>
            </div>

            @if(Helper::isVerifikasi())
            <div class="card text-white bg-success mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form HRD Belum terverifikasi <span class="badge badge-pill badge-danger">Proses</span></div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countVerifikasi() }} Form</p>
                    <a href="{{ route('verifikasi') }}" class="btn btn-dark btn-sm btn-block"><i class="far fa-eye"></i> Lihat</a>
                </div>
            </div>
            @endif
           
            <div class="card text-white bg-info mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form Desain <span class="badge badge-pill badge-danger">Proses</span></div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countFormDesain() }} Form</p>
                    <a href="{{ route('desainIklan') }}" class="btn btn-dark btn-sm btn-block"><i class="far fa-eye"></i> Lihat</a>
                </div>
            </div>
           
           <div class="card text-white bg-info mb-2">
               <div class="card-header"><i class="fas fa-file-signature"></i> Form Penanganan IT <span class="badge badge-pill badge-danger">Proses</span></div>
               <div class="card-body">
                   <p class="card-text">{{ Helper::countFormPenangananIT() }} Form</p>
                   <a href="{{ route('penanganan.it') }}" class="btn btn-dark btn-sm btn-block"><i class="far fa-eye"></i> Lihat</a>
               </div>
           </div>

            <div class="card text-white bg-warning mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form Perbaikan Sarana <span class="badge badge-pill badge-danger">Proses</span></div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countFormPerbaikan() }} Form</p>
                    <a href="{{ route('form.ga.perbaikan') }}" class="btn btn-dark btn-sm btn-block"><i class="far fa-eye"></i> Lihat</a>
                </div>
            </div>

            @if(Helper::isOffice())
            <div class="card text-white bg-warning mb-2">
                <div class="card-header"><i class="fas fa-file-signature"></i> Form Peminjaman Sarana <span class="badge badge-pill badge-danger">Proses</span></div>
                <div class="card-body">
                    <p class="card-text">{{ Helper::countFormPeminjaman() }} Form</p>
                    <a href="{{ route('form.ga.peminjaman') }}" class="btn btn-dark btn-sm btn-block"><i class="far fa-eye"></i> Lihat</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
    
    </div>
@endsection