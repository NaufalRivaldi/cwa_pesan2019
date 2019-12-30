@extends('admin.master')

@section('title', '- Product')

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
            <h2 class="pageheader-title">{{($id)?'Edit Data Produk':'Input Data Produk'}}</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('product')}}"><li class="breadcrumb-item" aria-current="page">Produk</a></li>
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
      <h3 class="card-header">Form Produk</h3>
      <div class="card">
        <div class="card-body">
          <div class="row justify-content-md-center">  
            <div class="col-md-6">          
              <form action="{{ ($id)?route('product.update') : route('product.add') }}" method="post">
              {{csrf_field()}}
              @if($id)
                <input type="hidden" value="{{ $product->id }}" name="id">
              @endif
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Mesin</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="merkId">
                    <option value=""></option>
                    @foreach($merks as $merk)
                      <option value="{{ $merk->id }}" {{( $id) ? ($product->merkId == $merk->id)? 'selected' : '' : ''}}>{{ $merk->name }}</option>
                    @endforeach
                    </select>
                        @if($errors->has('merkId'))
                          <div class="text-danger">
                              {{ $errors->first('merkId') }}
                          </div>
                        @endif
                </div>
                <div class="form-group">
                  <label for="inputTelepon" class="col-form-label">Nama Produk</label>
                  <input id="inputTelepon" type="text" class="form-control" name="name" value="{{ ($id)?$product->name:'' }}">
                        @if($errors->has('name'))
                          <div class="text-danger">
                              {{ $errors->first('name') }}
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