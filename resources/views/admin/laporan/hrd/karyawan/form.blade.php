@extends('admin.master')

@section('title', '- Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('laporan.hrd.karyawan')}}"><li class="breadcrumb-item" aria-current="page">Data Karyawan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('laporan.hrd.karyawan') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ (empty($id))? route('laporan.hrd.karyawan.store') : route('laporan.hrd.karyawan.update') }}" method="POST">
                        {{ csrf_field() }}
                        @if(!empty($id))
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $id }}">
                        @endif

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="nik" class="form-control col-md-6" value="{{ (!empty($id)? $karyawan->nik : '') }}" required>

                                <!-- error -->
                                @if($errors->has('nik'))
                                    <div class="text-danger">
                                        {{ $errors->first('nik') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" value="{{ (!empty($id)? $karyawan->nama : '') }}" required>

                                <!-- error -->
                                @if($errors->has('nama'))
                                    <div class="text-danger">
                                        {{ $errors->first('nama') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Departemen</label>
                            <div class="col-sm-10">
                                <select name="dep" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach($departemen as $dep)
                                        <option value="{{ $dep }}" {{ (!empty($id))? ($dep == $karyawan->dep)? 'selected' : '' : '' }}>{{ $dep }}</option>
                                    @endforeach
                                </select>
                                <!-- error -->
                                @if($errors->has('dep'))
                                    <div class="text-danger">
                                        {{ $errors->first('dep') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select name="stat" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="1" {{ (!empty($id))? ($karyawan->stat == 1)? 'selected' : '' : '' }}>Staff</option>
                                    <option value="2" {{ (!empty($id))? ($karyawan->stat == 2)? 'selected' : '' : '' }}>Kepala Bagian</option>
                                    <option value="3" {{ (!empty($id))? ($karyawan->stat == 3)? 'selected' : '' : '' }}>Area Manager</option>
                                    <option value="4" {{ (!empty($id))? ($karyawan->stat == 4)? 'selected' : '' : '' }}>General Manager</option>
                                    <option value="5" {{ (!empty($id))? ($karyawan->stat == 5)? 'selected' : '' : '' }}>Asst Direktur</option>
                                    <option value="6" {{ (!empty($id))? ($karyawan->stat == 6)? 'selected' : '' : '' }}>Direktur</option>
                                </select>
                                <!-- error -->
                                @if($errors->has('stat'))
                                    <div class="text-danger">
                                        {{ $errors->first('stat') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Simpan" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('document').ready(function(){
        
    });
</script>
@endsection