@extends('admin.master')

@section('title', '- Hasil Poling')

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
              <h2>Data Hasil Poling</h2>
            </div>
          <form action="" method="get">
            <div class="card-header">
              <div class="container">
                <div class="row">            
                  <select class="form-control col-sm-8" id="periodeId" name="periodeId">
                      @foreach($searchPeriode as $p)
                        <option value="{{ $p->id }}" {{($_GET)?($_GET['periodeId']==$p->id)?'selected':'':''}}>{{$p->namaPeriode}}</option>
                      @endforeach
                  </select>
                  <?php
                    $url = '';
                    if ($_GET) {
                      $url = '?'.$_SERVER['QUERY_STRING'];
                    }
                  ?>
                  <button type="submit" class="btn ml-2 btn-success">Cari</button>
                  <a href="{{ route('laporan.hrd.hasilpoling.detail').$url }}" class="btn ml-2 btn-primary float-right">Detail Hasil Poling</a>
                  <a href="{{ route('laporan.hrd.hasilpoling.export').$url }}" class="btn ml-2 btn-primary float-right">Excel</a>
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
                      <th>Nama</th>
                      <th>Periode</th>
                      <th>Departemen</th>
                      <th>Skor</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($dep as $dep)
                        <?php
                          $skor = 0;
                        ?>                        
                    @foreach(Helper::laporanHasilPoling($dep) as $hasil)
                      @if($dep == $hasil->karyawan->dep)                       
                        @if($skor <= $hasil->skor)
                          <?php 
                            $skor = $hasil->skor;
                          ?>
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$hasil->karyawan->nama}}</td>
                            <td>{{$hasil->poling->periode->namaPeriode}}</td>
                            <td>{{$hasil->karyawan->dep}}</td>
                            <td>{{$hasil->skor}}</td>
                         </tr>
                        @endif                      
                      @endif
                    @endforeach
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection