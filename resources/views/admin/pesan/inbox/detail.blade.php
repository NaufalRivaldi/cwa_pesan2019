@extends('admin.master')

@section('title', '- Detail Pesan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $pesan->subject }}</h2>
                        <table style="font-size: 0.9em">
                            <tr>
                                <td>Pengirim</td>
                                <td width="20px">:</td>
                                <td><b>{{ $pesan->user->nama }} < {{ $pesan->user->email }} ></b></td>
                            </tr>
                            <tr>
                                <td>Kepada Saya</td>
                                <td>:</td>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Diterima</td>
                                <td>:</td>
                                <td><span class="badge badge-success">{{ date('d F Y, H:i:s', strtotime($pesan->tgl)) }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $pesan->message !!}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    Lampiran :
                                </div>
                                <div class="col-md-10">
                                    @foreach($pesan->attach as $att)
                                        <a href="{{ asset('Upesan/'.$att->nama_file) }}" download="{{ $att->nama }}">
                                            <div class="lampiran">
                                                <div class="icon-lampiran">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                                <div class="text-lampiran">
                                                    {{ $att->nama }}
                                                </div>
                                            </div>
                                        </a> 
                                    @endforeach
                                </div>
                            </div>

                            <!-- collapse balas -->
                            <div class="collapse" id="collapseBalas" style="margin-top:2%">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Balas Pesan</h2>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ url('admin/pesan/store') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                            <input type="hidden" name="kepada[]" value="{{ $pesan->user->id }}">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Subject</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="subject" class="form-control" value="RE : {{ $pesan->subject }}" readonly>
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
                                                    <input type="file" name="file[]" data-fileuploader-fileMaxSize="5">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <input type="submit" value="Kirim Pesan" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- collapse balas -->

                            <div class="row" style="margin-top:2%">
                                <div class="col-md-12">
                                    <!-- <a href="{{ url('admin/pesan/balas/'.$pesan->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-reply"></i> Balas</a> -->
                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseBalas" aria-expanded="false" aria-controls="collapseBalas"><i class="fas fa-reply"></i> Balas</button>
                                    <a href="{{ url('admin/pesan/forward/'.$pesan->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-share"></i> Forward</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection