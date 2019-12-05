@extends('admin.master')

@section('title', '- Pengumuman')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Edit Pengumuman</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/pengumuman') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/pengumuman/update') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $pengumuman->id }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" name="subject" class="form-control col-7" value="{{ $pengumuman->subject }}">
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
                                <textarea name="pesan" id="mytextarea">{{ $pengumuman->pesan }}</textarea>
                                <!-- error -->
                                @if($errors->has('pesan'))
                                    <div class="text-danger">
                                        {{ $errors->first('pesan') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Berlaku Sampai</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_akhir" class="form-control col-md-6" min="{{ $date_now }}" value="{{ $pengumuman->tgl_akhir }}">
                                @if($errors->has('tgl_akhir'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_akhir') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-10">
                                <p>
                                    @foreach($file as $f)
                                    <a href="{{ url('/admin/pengumuman/delattc/'.$f->id) }}" class="btn btn-danger btn-sm">Hapus</a> <span class="badge badge-info">{{ $f->nama }}</span><br>
                                    @endforeach
                                </p>
                                <input type="file" name="file[]" data-fileuploader-fileMaxSize="5">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Simpan Pengumuman" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection