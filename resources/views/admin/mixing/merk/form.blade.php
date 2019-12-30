@extends('admin.master')

@section('title', '- Merk')

@section('content')
<!-- Page Header -->
<?php
  $id = '';
  if ($_GET) {
    $id = $_GET['id'];
  }
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">
            {{ ($id) ? 'Edit Data Mesin' : 'Tambah Data Mesin'}}
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('merk')}}"><li class="breadcrumb-item" aria-current="page">Mesin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<!-- <div class="container"> -->
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <h3 class="card-header">Form Mesin</h3>
      <div class="card">
        <div class="card-body">
          <div class="row justify-content-md-center">  
            <div class="col-md-6">          
              <form action="{{ ($id) ? route('merk.update') : route('merk.add')}}" method="post">
              {{csrf_field()}}              
              @if($id)
                  <input type="hidden" value="{{ $merk->id }}" name="id">
              @endif
                <div class="form-group">
                  <label for="inputNama" class="col-form-label">Nama</label>
                  <input id="inputNama" type="text" class="form-control" name="name" value="{{ ($id) ? $merk->name : '' }}">
                  @if($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>
                <input type="submit" value="{{ ($id) ? 'Simpan' : 'Tambah' }}" class="btn btn-primary">
                @if($id)

                @else
                <input type="reset" value="Reset" class="btn btn-danger">
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
@endsection