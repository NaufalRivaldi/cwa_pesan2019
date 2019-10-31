@extends('backend.master')

@section('title', '- Backends')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">{{ $data['title'] }}</h1>
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Data {{ $data{'title'} }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/backend/karyawan/update') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $karyawan->id }}">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nik" class="form-control" value="{{ $karyawan->nik }}">
                                    <!-- error -->
                                    @if($errors->has('nik'))
                                        <div class="text-danger">
                                            {{ $errors->first('nik') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}">
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
                                        @foreach($data['cabang'] as $c)
                                            @if($karyawan->dep == $c->inisial)
                                                <option value="{{ $c->inisial }}" selected>{{ $c->nama_cabang }}</option>
                                            @else
                                                <option value="{{ $c->inisial }}" selected>{{ $c->nama_cabang }}</option>
                                            @endif
                                        @endforeach
                                        @foreach($data['dep'] as $c)
                                            @if($karyawan->dep == $c)
                                                <option value="{{ $c }}" selected>{{ $c }}</option>
                                            @else
                                                <option value="{{ $c }}">{{ $c }}</option>
                                            @endif
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
                                        <option value="1" {{ ($karyawan->stat == 1) ? 'selected' : '' }}>Staff</option>
                                        <option value="2" {{ ($karyawan->stat == 2) ? 'selected' : '' }}>Kepala Bagian</option>
                                        <option value="3" {{ ($karyawan->stat == 3) ? 'selected' : '' }}>Area Manager</option>
                                        <option value="4" {{ ($karyawan->stat == 4) ? 'selected' : '' }}>General Manager</option>
                                        <option value="5" {{ ($karyawan->stat == 5) ? 'selected' : '' }}>Asst Direktur</option>
                                        <option value="6" {{ ($karyawan->stat == 6) ? 'selected' : '' }}>Direktur</option>
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
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="btn" value="Simpan" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection