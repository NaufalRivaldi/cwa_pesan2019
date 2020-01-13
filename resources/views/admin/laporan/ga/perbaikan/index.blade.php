@extends('admin.master')

@section('title', '- Laporan HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>Laporan Perbaikan Sarana & Prasarana</h3>
                    </div>
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-cog"></i> Pengaturan
                        </button>
                        <?php
                            $url = '';
                            $tgl = Helper::setDate($dateFirst).' - '.Helper::setDate($dateNow);
                            if($_GET){
                                $url = $_SERVER['QUERY_STRING'];
                                $tgl = Helper::setDate($_GET['tgl_a']).' - '.Helper::setDate($_GET['tgl_b']);
                            }
                        ?>

                        @if($_GET)
                            <a href="{{ route('laporan.ga.perbaikan.export').'?'.$url }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel</a>
                        @endif

                        <div class="collapse mt-2" id="collapseExample">
                            <div class="card card-body">
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><b>Tanggal Awal</b></label><br>
                                            <input type="date" name="tgl_a" class="form-control" value="{{ ($_GET) ? $_GET['tgl_a'] : $dateFirst }}" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label><b>Tanggal Akhir</b></label><br>
                                            <input type="date" name="tgl_b" class="form-control" value="{{ ($_GET) ? $_GET['tgl_b'] : $dateNow }}" required>
                                        </div>  
                                        <div class="col-md-4">
                                            <label><b>Departemen</b></label>
                                            <select name="dep" class="form-control dep-select">
                                                <option value="">Pilih</option>
                                                @foreach(Helper::allDep() as $dep)
                                                    <option value="{{ $dep }}" {{ ($_GET) ? ($dep == $_GET['dep'])? 'selected' : '' : '' }}>{{ $dep }}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><b>Status</b></label>
                                            <select name="status" class="form-control dep-select">
                                                <option value="">Pilih</option>
                                                <option value="2" {{ ($_GET) ? ('2' == $_GET['status'])? 'selected' : '' : '' }}>Acc GA/ Progress</option>
                                                <option value="3" {{ ($_GET) ? ('3' == $_GET['status'])? 'selected' : '' : '' }}>Dalam Pengajuan</option>
                                                <option value="4" {{ ($_GET) ? ('4' == $_GET['status'])? 'selected' : '' : '' }}>Selesai</option>
                                            </select>
                                        </div>  
                                        <div class="col-md-4">
                                            <label>&nbsp;</label><br>
                                            <input type="submit" value="Cari Data" class="btn btn-primary">
                                        </div>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h3 class="dep"></h3>
                        <p class="lead">Tanggal : {{ $tgl }}</p>
                        <div class="table-responsive">
                            <table class="custom-table table table-striped myTableExport">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Tgl Selesai</th>
                                        <th>Dept</th>
                                        <th>Permintaan</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form as $form)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ Helper::setDate($form->tglPengajuan) }}</td>
                                            <td>{{ Helper::setDate($form->tglSelesai) }}</td>
                                            <td>{{ $form->user->dep }}</td>
                                            <td>{{ $form->permintaan }}</td>
                                            <td>{{ $form->alasan }}</td>
                                            <td>{{ Helper::statusPerbaikanLaporan($form->status) }}</td>
                                            <td>{{ $form->keterangan }}</td>
                                        </tr>
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