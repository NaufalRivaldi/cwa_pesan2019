@extends('admin.master')

@section('title', '- Base')

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
            <!-- {{ ($id) ? 'Edit Data Base Product' : 'Input Data Base Product' }} -->
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('mixing.product')}}"><li class="breadcrumb-item" aria-current="page">Product</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('mixing.product')}}">Base</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Base</li>
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
      <div class="card">  
        <div class="card-header">
            <a href="{{ route('mixing.product') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
        <div class="card-body">
          <div class="row justify-content-md-center">  
            <div class="col-md-6">          
              <form action="{{($id)?route('mixing.base.update'):route('mixing.base.add')}}" method="post">
              {{ csrf_field() }}
              @if($id)
                  <input type="hidden" value="{{ $base->id }}" name="id">
              @endif
                <input type="hidden" value="{{ (empty($id)) ? $product->id : $base->product->id }}" name="productId">
                <div class="form-group">
                  <label for="productId" class="col-form-label">Product</label>
                  <input id="productId" type="text" class="form-control" name="product" value="{{ (empty($id)) ? $product->name : $base->product->name }}" disabled>
                  @if($errors->has('productId'))
                    <div class="text-danger">
                        {{ $errors->first('productId') }}
                    </div>
                  @endif
                </div>
                
                <div id="form-plus">
                  <div class="form-group">
                    <label for="baseName" class="col-form-label">Nama Base</label>
                    <div class="input-group mb-3">
                      <input id="baseName" type="text" class="form-control" name="{{ (empty($id)) ? 'name[]' : 'name' }}" aria-describedby="plusAddon" value="{{ (empty($id)) ? '' : $base->name }}">
                      
                      @if(!$id)
                      <div class="input-group-append">
                        <a href="#" id="plus" class="btn btn-success">+</a>
                      </div>
                      @endif
                    </div>
                    
                    @if($errors->has('name'))
                      <div class="text-danger">
                          {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>
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

@section('js')
<script>
  // click plus
  var i = 1;
  $('#plus').click(function (e) {
      e.preventDefault();
      $('#form-plus').append('<div id="row'+i+'"><div class="input-group mb-3"><input id="baseName" type="text" class="form-control" name="name[]" aria-describedby="plusAddon"><div class="input-group-append"><a href="#" class="btn btn-danger remove" id="'+i+'">-</a></div></div></div>');

      i++;
  });

  $(document).on('click', '.remove', function(e){
      e.preventDefault();
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();

      cekBobot();
  });
</script>
@endsection