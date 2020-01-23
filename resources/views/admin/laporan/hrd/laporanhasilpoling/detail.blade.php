@extends('admin.master')

@section('title', '- Detail')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Hasil Poling</h2> -->
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href=" {{ route('laporan.hrd.hasilpoling') }} "><li class="breadcrumb-item" aria-current="page">Data Hasil Poling</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                <div class="card-header">
                    <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                    @foreach($hasilPoling as $hasil)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$hasil->karyawan->nama}}</td>
                        <td>{{$hasil->karyawan->dep}}</td>
                        <td>{{$hasil->skor}}</td>
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