@extends('admin.master')

@section('title', '- Formula')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Formula</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Formula</li>
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
        <a href="{{route('formula.form')}}" class="btn btn-success">Tambah Formula</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Mesin</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($formula as $formula)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $formula->merk->name }}</td>
                    <td>
                        <a href="{{ route('formula.detail', ['id' => $formula->merkId]) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    </td>
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