@extends('admin.master')

@section('title', '- Buat Pesan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a href="{{route('inbox')}}"><li class="breadcrumb-item" aria-current="page">Pesan Masuk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-header">
                    <a href="{{ url('admin/pesan/inbox') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                    
                    <div class="display-4 mb-3">Pesan Baru</div>
                        <form action="{{ url('admin/pesan/store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-10">
                                <select class="js-example-responsive" multiple="multiple" name="kepada[]" class="form-control" style="width: 100%" id="selectAll">
                                    @foreach($user as $row)
                                        @if($row->email != auth()->user()->email)
                                            <option value="{{ $row->id }}">{{ $row->email }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="checkbox" name="chckAll" id="chckAll"> Bagikan ke semua?
                                    <!-- error -->
                                    @if($errors->has('kepada'))
                                        <div class="text-danger">
                                            {{ $errors->first('kepada') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" name="subject" class="form-control">
                                    <!-- error -->
                                    @if($errors->has('subject'))
                                        <div class="text-danger">
                                            {{ $errors->first('subject') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Isi</label>
                                <div class="col-sm-10">
                                    <textarea name="message" id="mytextarea" rows="15"></textarea>
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
                                    <input type="file" name="file[]" data-fileuploader-fileMaxSize="5" data-fileuploader-theme="default">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input type="submit" value="Kirim" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection