@extends('admin.master')

@section('title', '- Indikator')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Indikator</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Indikator</li>
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
              <a href="{{ route('pkk.indikator.form') }}" class="btn btn-primary btn-sm">
                <li class="fa fa-plus-circle">
                </li>
                Tambah
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Indikator</th>
                      <th>Status</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  @foreach($indikator as $indikator)
                  <tbody>
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$indikator->pertanyaan}}</td>
                      <td>{!!Helper::statusPKK($indikator->status)!!}</td>
                      <td>{!!Helper::kategoriPKK($indikator->kategori)!!}</td>
                      <td>
                        <a href=""><li class="btn btn-sm btn-success fas fa-eye"></li></a>
                        <a href="{{route('pkk.indikator.edit', ['id'=>$indikator->id])}}"><li class="btn btn-sm btn-warning fas fa-edit"></li></a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection