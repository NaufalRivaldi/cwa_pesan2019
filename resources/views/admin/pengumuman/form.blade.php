@extends('admin.master')

@section('title', '- Pengumuman')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Form Pengumuman</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/pengumuman') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/pengumuman/store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" name="subject" class="form-control col-7">
                                <!-- error -->
                                @if($errors->has('subject'))
                                    <div class="text-danger">
                                        {{ $errors->first('subject') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Isi Pengumuman</label>
                            <div class="col-sm-10">
                                <textarea name="pesan" id="mytextarea"></textarea>
                                <!-- error -->
                                @if($errors->has('pesan'))
                                    <div class="text-danger">
                                        {{ $errors->first('pesan') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-10">
                                <input type="file" name="file[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Post Pengumuman" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection