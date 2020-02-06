@extends('admin.master')

@section('title', '- Hasil Penilaian Kepala Bagian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('laporan.hrd.penilaian.kabag')}}"><li class="breadcrumb-item" aria-current="page">Data Hasil Penilaian Kepala Bagian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Departemen</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">  
        <div class="card">
            <!-- <div class="card-header">
                <h2>Data Hasil Penilaian Kepala Bagian</h2>                 
            </div> -->
            <form action="" method="get">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-5">           
                            <select class="form-control" id="periodeId" name="periodeId">
                                @foreach($searchPeriode as $p)
                                    <option value="{{ $p->id }}" {{ ($_GET)?($_GET['periodeId'] == $p->id)?'selected':'':'' }}>{{$p->namaPeriode}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-sm-5">           
                            <select class="form-control" id="dep" name="dep">
                            <option value="">Pilih Departemen...</option>
                                @foreach(Helper::office() as $p)
                                    <option value="{{ $p }}" {{ ($_GET)?($_GET['dep'] == $p)?'selected':'':'' }}>{{$p}}</option>
                                @endforeach
                            </select>
                        </div>
                        <?php
                            $url = '';
                            if ($_GET) {
                            $url = '?'.$_SERVER['QUERY_STRING'];
                            }
                        ?>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success col">Cari</button>
                        </div>             
                    </div>         
                </div>
            </form>            
            <div class="card-header">
                <a href="{{ route('laporan.hrd.penilaiankabag.export').$url }}" class="btn btn-sm btn-success">Export <i class="far fa-file-excel"></i></a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kabag</th>
                      <th>Dep</th>
                      <th>Skor</th>
                      <th>Progress</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($penilaian as $penilaian)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $penilaian->karyawan->nama }}</td>
                            <td>{{ $penilaian->karyawan->dep }}</td>
                            <td>{{ Helper::skorPenilaianKabag($penilaian->karyawan->id, $periode->id) }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection