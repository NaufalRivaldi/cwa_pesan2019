@extends('admin.master')

@section('title', '- Kuesioner')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Kuesioner</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
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
              <a href="{{ route('pkk.kuisioner.form') }}" class="btn btn-primary btn-sm">
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
                      <th>Pertanyaan</th>
                      <th>Status</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  @foreach($kuisioner as $kuisioner)
                  <tbody>
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$kuisioner->pertanyaan}}</td>
                      <td>{!!Helper::statusPKK($kuisioner->status)!!}</td>
                      <td>{!!Helper::kategoriPKK($kuisioner->kategori)!!}</td>
                      <td>
                        <a href=""><li class="btn btn-sm btn-success fas fa-eye"></li></a>
                        <a href="{{ route('pkk.kuisioner.edit', ['id'=>$kuisioner->id]) }}"><li class="btn btn-sm btn-warning fas fa-edit"></li></a>
                        <button class="btn btn-sm btn-danger fas fa-trash"></button>
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