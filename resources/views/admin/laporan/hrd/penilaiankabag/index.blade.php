@extends('admin.master')

@section('title', '- Hasil Penilaian Kepala Bagian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Hasil Poling</h2> -->
            <div class="page-breadcrumb">
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Hasil Poling</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Data Hasil Penilaian Kepala Bagian</h2>                 
            </div>
            <form action="" method="get">
                <div class="card-header">
                    <div class="container">
                        <div class="row">            
                        <select class="form-control col-sm-9" id="periodeId" name="periodeId">
                            @foreach($searchPeriode as $p)
                                <option value="{{ $p->id }}" {{ ($_GET)?($_GET['periodeId'] == $p->id)?'selected':'':'' }}>{{$p->namaPeriode}}</option>
                            @endforeach
                        </select>
                        <?php
                            $url = '';
                            if ($_GET) {
                            $url = '?'.$_SERVER['QUERY_STRING'];
                            }
                        ?>
                        <button type="submit" class="btn ml-2 btn-success">Cari</button>
                        <a href="{{ route('laporan.hrd.hasilpoling.detail').$url }}" class="btn ml-2 btn-primary float-right">Excel</a>
                        </div>
                    </div>              
                </div>
            </form>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kabag</th>
                      <th>Dep</th>
                      <th>Skor</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($penilaian as $penilaian)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $penilaian->karyawan->nama }}</td>
                            <td>{{ $penilaian->karyawan->dep }}</td>
                            <td>{{ Helper::skorPenilaianKabag($penilaian->karyawan->id, $periode->id) }}</td>
                            <td><a href="{{ route('laporan.hrd.penilaian.kabag.detail', ['karyawanId' => $penilaian->karyawan->id, 'periodeId' => $periode->id]) }}" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a></td>
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