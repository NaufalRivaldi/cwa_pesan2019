@extends('admin.master')

@section('title', '- Formula')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Formula</h2> -->
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
        <a href="{{route('mixing.formula.form')}}" class="btn btn-primary btn-sm">
          <li class="fa fa-plus-circle">
          </li>
          Tambah
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="table custom-table" id="myTable2">
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
                        <a href="{{ route('mixing.formula.detail', ['id' => $formula->merkId]) }}" class=""><i class="btn btn-info btn-sm fas fa-eye"></i></a>
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