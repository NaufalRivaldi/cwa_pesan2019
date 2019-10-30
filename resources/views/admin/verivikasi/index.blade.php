@extends('admin.master')

@section('title', '- Ubah Password Verifikasi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Ubah Password Verifikasi</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('kode.verifikasi.change') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="name" name="nik" class="form-control col-7">
                                <!-- error -->
                                @if($errors->has('nik'))
                                    <div class="text-danger">
                                        {{ $errors->first('nik') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password Lama</label>
                            <div class="col-sm-10">
                                <input type="password" name="oldpassword" class="form-control col-7">
                                <!-- error -->
                                @if($errors->has('oldpassword'))
                                    <div class="text-danger">
                                        {{ $errors->first('oldpassword') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password Baru</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control col-7">
                                <!-- error -->
                                @if($errors->has('password'))
                                    <div class="text-danger">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password2" class="form-control col-7">
                                <!-- error -->
                                @if($errors->has('password2'))
                                    <div class="text-danger">
                                        {{ $errors->first('password2') }}
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
@endsection