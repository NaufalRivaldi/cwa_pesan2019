@extends('admin.master')

@section('title', '- Indikator')

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
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href=" {{ route('pkk.indikator') }} "><li class="breadcrumb-item" aria-current="page">Indikator</a></li>
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
          <a href="{{ route('pkk.kuisioner') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
      </div>
        <div class="card-body">   
                <form action="{{ ($id)?route('pkk.indikator.update'):route('pkk.indikator.add') }}" method="post">
                    <!-- read id -->
                    {{csrf_field()}}
                    @if($id)
                        <input type="hidden" value="{{$indikator->id}}" name="id">
                    @endif
                    <div class="form-group row">
                        <label for="inputPertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" id="inputPertanyaan" rows="3" name="pertanyaan">{{($id)?$indikator->pertanyaan:''}}</textarea>
                        @if($errors->has('pertanyaan'))
                          <div class="text-danger">
                              {{ $errors->first('pertanyaan') }}
                          </div>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-5">
                        <select id="kategori" class="form-control" name="kategori">
                            <option value="">Pilih...</option>
                            <option {{($id)? ($indikator->kategori == '1') ? 'selected': '' : ''}} value="1">Best Employee</option>
                            <option {{($id)? ($indikator->kategori == '2') ? 'selected': '' : ''}} value="2">Penilaian Kepala Departemen</option>
                            <option {{($id)? ($indikator->kategori == '3') ? 'selected': '' : ''}} value="3">Penilaian Kepala Toko</option>
                            <option {{($id)? ($indikator->kategori == '4') ? 'selected': '' : ''}} value="4">Survei Kepuasan Karyawan</option>
                        </select>
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