@extends('admin.master')

@section('title', '- Periode')

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
            <h2 class="pageheader-title">{{($id)?'Ubah Data Periode':'Tambah Data Periode'}}</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href=" {{ route('pkk.periode') }} "><li class="breadcrumb-item" aria-current="page">Periode</a></li>
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
      <h3 class="card-header">Form Periode</h3>
      <div class="card">
        <div class="card-body">   
                <form action="{{ ($id)? route('pkk.periode.update') : route('pkk.periode.add') }}" method="post">
                    <!-- read id -->
                    {{csrf_field()}}
                    @if($id)
                        <input type="hidden" value="{{$periode->id}}" name="id">
                    @endif
                    <input type="hidden" value="" class="idPeriode" name="customersId">
                    <div class="form-group row">
                        <label for="namaPeriode" class="col-sm-2 col-form-label">Nama Periode</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="namaPeriode" name="namaPeriode" value="{{ ($id) ? $periode->namaPeriode : '' }}" placeholder="">                        
                        @if($errors->has('namaPeriode'))
                          <div class="text-danger">
                              {{ $errors->first('namaPeriode') }}
                          </div>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglMulai" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-5">
                        <input type="date" class="form-control" id="tglMulai" placeholder="" name="tglMulai" value="{{($id) ? $periode->tglMulai : ''}}">    
                        @if($errors->has('tglMulai'))
                          <div class="text-danger">
                              {{ $errors->first('tglMulai') }}
                          </div>
                        @endif
                        </div>
                        <label for="tglSelesai" class="col-sm-1 col-form-label text-center">s/d</label>
                        <div class="col-sm-4">
                        <input type="date" class="form-control" id="tglSelesai" name="tglSelesai" placeholder="" value="{{($id) ? $periode->tglSelesai : ''}}">
                        @if($errors->has('tglSelesai'))
                        <div class="text-danger">
                              {{ $errors->first('tglSelesai') }}
                        </div>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-5">
                        <select id="kategori" class="form-control" name="kategori">
                            <option value="">Pilih...</option>
                            <option {{($id)? ($periode->kategori == '1') ? 'selected': '' : ''}} value="1">Best Employee</option>
                            <option {{($id)? ($periode->kategori == '2') ? 'selected': '' : ''}} value="2">Penilaian Kepala Bagian</option>
                            <option {{($id)? ($periode->kategori == '3') ? 'selected': '' : ''}} value="3">Survei Kepuasan Karyawan</option>
                        </select>
                        <div class="form-check mt-1">
                          <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="status">
                          <label class="form-check-label" for="defaultCheck1">
                            Aktifkan periode
                          </label>
                        </div>
                        @if($errors->has('kategori'))
                          <div class="text-danger">
                              {{ $errors->first('kategori') }}
                          </div>
                        @endif
                        </div>
                    </div>                    
                    <div class="form-group float-right">
                        <input type="reset" value="Reset" class="btn btn-danger">
                        <input type="submit" value="{{($id)?'Simpan':'Tambah'}}" class="btn btn-primary">
                    </div>
              </form>
            </div>  
            </div>            
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
@endsection