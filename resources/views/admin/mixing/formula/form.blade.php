@extends('admin.master')

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
            <!-- {{ ($id) ? 'Edit Data Formula' : 'Input Data Formula' }} -->
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('mixing.formula')}}"><li class="breadcrumb-item" aria-current="page">Formula</a></li>
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
      <!-- <h3 class="card-header">Form Formula</h3> -->
      <div class="card"> 
        <div class="card-header">
            <a href="{{ route('mixing.formula') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
        <div class="card-body">
          <div class="row justify-content-md-center">  
            <div class="col-md-6">          
              <form action="{{($id)?route('mixing.formula.update'):route('mixing.formula.add')}}" method="post">
              @csrf
              @if($id)
                    @method('PUT')
                    <input type="hidden" value="{{ $formula->id }}" name="id">
              @endif
                <div class="form-group">
                  <label for="inputMerk" class="col-form-label">Mesin</label>
                  <select name="merkId" id="inputMerk" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($merk as $merk)
                        <option value="{{ $merk->id }}" {{ ($id)? ($merk->id == $formula->merkId)? 'selected' : '' : '' }}>{{ $merk->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('merkId'))
                    <div class="text-danger">
                        {{ $errors->first('merkId') }}
                    </div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="inputColor" class="col-form-label">Nama Warna</label>
                  <input id="inputColor" type="text" class="form-control" name="color" value="{{ ($id) ? $formula->color : '' }}">
                  @if($errors->has('color'))
                    <div class="text-danger">
                        {{ $errors->first('color') }}
                    </div>
                  @endif
                </div>
                <input type="submit" value="{{($id)?'Simpan':'Tambah'}}" class="btn btn-primary">
                @if(!$id)
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