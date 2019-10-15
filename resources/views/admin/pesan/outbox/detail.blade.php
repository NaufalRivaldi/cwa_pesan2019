@extends('admin.master')

@section('title', '- Buat Pesan')

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
                                <td>Kepada</td>
                                <td>:</td>
                                <td>
                                    @foreach($pesan->penerima as $row)
                                        {{ $row->user->email.", " }}
                                    @endforeach
                                </td>
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
                                        <a href="{{ asset('Upesan/'.$att->nama_file) }}">
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