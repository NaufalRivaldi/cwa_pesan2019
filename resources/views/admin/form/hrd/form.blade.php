@extends('admin.master')

@section('title', '- Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Form HRD</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/formhrd') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/formhrd/store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                @foreach($kategori as $r)
                                    <input type="checkbox" name="kategori[]" value="{{ $r->id }}"> {{ $r->nama_kategori }}<br>
                                @endforeach
                                <!-- error -->
                                @if($errors->has('kategori'))
                                    <div class="text-danger">
                                        {{ $errors->first('kategori') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="karyawanall_id" class="form-control">
                                    <option value="">Pilih Nama Karyawan</option>
                                    @foreach($karyawan as $row)
                                        <option value="{{ $row->id }}">{{ $row->nik." - ".$row->nama }}</option>
                                    @endforeach
                                </select>
                                <!-- error -->
                                @if($errors->has('karyawanall_id'))
                                    <div class="text-danger">
                                        {{ $errors->first('karyawanall_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal & Waktu <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="date" name="tgl_a" class="form-control tgl_a" required>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <input type="time" name="time_a" class="form-control" required>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        s/d
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="tgl_b" class="form-control tgl_b">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <input type="time" name="time_b" class="form-control">
                                    </div>
                                </div>
                                <p class="text-danger">
                                    *tanggal pertama wajib diisi
                                </p>
                                <!-- error -->
                                @if($errors->has('tgl_a'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_a') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" id="mytextarea"></textarea>
                                <!-- error -->
                                @if($errors->has('keterangan'))
                                    <div class="text-danger">
                                        {{ $errors->first('keterangan') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Ajukan Form" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection