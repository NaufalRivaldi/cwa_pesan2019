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
              <div class="row">
              <div class="col-sm-6">              
              <h2>Data Hasil Poling</h2>
              </div>
              <div class="col-sm-6">
                <a href="{{route('laporan.hrd.hasilpoling.detail')}}" class="btn btn-primary float-right mt-1">Detail Hasil Poling</a>
              </div>                
              </div>              
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
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