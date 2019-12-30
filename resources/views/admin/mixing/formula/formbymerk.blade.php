@extends('admin.master')

@section('title', '- Formula')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">
                Input Data Formula
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
      <h3 class="card-header">Tambah Formula {{$merk->name}}</h3>
      <div class="card">
        <div class="card-body">
          <div class="row justify-content-md-center">  
            <div class="col-md-6">          
              <form action="{{route('mixing.formula.add')}}" method="post">
              @csrf
                <input type="hidden" name="merkId" value="{{$merk->id}}">
                <div class="form-group">
                  <label for="inputColor" class="col-form-label">Nama Warna</label>
                  <input id="inputColor" type="text" class="form-control" name="color">
                  @if($errors->has('color'))
                    <div class="text-danger">
                        {{ $errors->first('color') }}
                    </div>
                  @endif
                </div>
                <input type="submit" value="Tambah" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-danger">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
@endsection