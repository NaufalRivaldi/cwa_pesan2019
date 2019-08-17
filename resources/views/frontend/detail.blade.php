@extends('frontend.master')

@section('title', '- Pengumuman')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">Pengumuman <span class="badge badge-secondary">Internal CWJA</span></h1>
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $pengumuman->subject }}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td width="15%" align="right">Tanggal :</td>
                                <td>{{ $pengumuman->tgl }}</td>
                            </tr>
                            <tr>
                                <td width="15%" align="right">Subject :</td>
                                <td>{{ $pengumuman->subject }}</td>
                            </tr>
                            <tr>
                                <td width="15%" align="right">Pesan :</td>
                                <td>{!! $pengumuman->pesan !!}</td>
                            </tr>
                            <tr>
                                <td width="15%" align="right">Lampiran :</td>
                                <td>
                                    @foreach($file as $f)
                                        <a href="{{ url('/Upengumuman/'.$f->nama_file) }}" class="btn btn-info btn-sm">{{ $f->nama }}</a>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection