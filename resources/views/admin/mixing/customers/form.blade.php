@extends('admin.master')

@section('title', '- Customers')

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
            <!-- {{ ($id) ? 'Edit Data Pelanggan' : 'Input Data Pelanggan' }} -->
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('mixing.customers')}}"><li class="breadcrumb-item" aria-current="page">Pelanggan</a></li>
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
      <div class="card">     
      <div class="card-header">
          <a href="{{ route('mixing.customers') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
      </div>
        <div class="card-body">
          <!-- <div class="display-4 mb-3">
            Form Pelanggan
          </div> -->
          <div class="row justify-content-md-center">  
            <div class="col-md-6">          
              <form action="{{($id)?route('mixing.customers.update'):route('mixing.customers.add')}}" method="post">
              {{ csrf_field() }}
              @if($id)
                  <input type="hidden" value="{{ $customer->id }}" name="id">
              @endif
                <div class="form-group">
                  <label for="inputMemberId" class="col-form-label">Member ID</label>
                  <input id="inputMemberId" type="text" class="form-control" onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" name="memberId" maxlength="8" value="{{ ($id) ? $customer->memberId : '' }}" placeholder="xxx-xxxx">
                  <p class="text-mini text-danger">Kosongkan jika tidak memiliki id member</p>
                  @if($errors->has('memberId'))
                    <div class="text-danger">
                        {{ $errors->first('memberId') }}
                    </div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-form-label">Nama</label>
                  <input id="inputNama" type="text" class="form-control" name="name" value="{{ ($id) ? $customer->name : '' }}" {{(auth()->user()->dep == 'IT')?'':'readonly'}}>
                  @if($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="inputTelepon" class="col-form-label">Telepon</label>
                  <input id="inputTelepon" type="text" class="form-control" name="phone" maxlength="14" value="{{ ($id) ? $customer->phone : '' }}" {{(auth()->user()->dep == 'IT')?'':'readonly'}}>
                  <p class="text-mini text-danger">Kosongkan jika tidak memiliki no telp</p>
                  @if($errors->has('phone'))
                    <div class="text-danger">
                        {{ $errors->first('phone') }}
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

@section('js')
<script>
  function convertToMin(objek) {
      separator = "-";
      a = objek.value;
      b = a.replace(/[^\d]/g, "");
      c = "";
      panjang = b.length;
      j = 0;
      for (i = panjang; i > 0; i--) {
          j = j + 1;
          if (((j % 4) == 1) && (j != 1)) {
              c = b.substr(i - 1, 1) + separator + c;
          } else {
              c = b.substr(i - 1, 1) + c;
          }
      }
      objek.value = c;
  }

  function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
  }
</script>
@endsection