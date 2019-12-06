@extends('admin.master')

@section('title', '- Detail Outbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <a href="{{ url('admin/pesan/outbox') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <hr>
                <p>Report : <span class="badge badge-info">Total Penerima : {{ $pesan->penerima->count() }}</span> <span class="badge badge-success">Dibaca : {{ $dibaca }}</span> <span class="badge badge-warning">Belum dibaca : {{ $belumbaca }}</span></p>
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $pesan->subject }}</h2>
                        <hr>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-md-2">
                                Pengirim :
                            </div>
                            <div class="col-md-9">
                                <b>{{ $pesan->user->nama }} < {{ $pesan->user->email }} ></b>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-md-2">
                                Kepada :
                            </div>
                            <div class="col-md-9">
                                @foreach($pesan->penerima as $row)
                                    {{ $row->user->email.", " }}
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-md-2">
                                Dikirim :
                            </div>
                            <div class="col-md-9">
                                <span class="badge badge-success">{{ date('d F Y, H:i:s', strtotime($pesan->tgl)) }}</span>
                            </div>
                        </div>
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
                            <div class="row" style="margin-top:2%">
                                <div class="col-md-12">
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