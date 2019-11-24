@extends('admin.master')

@section('title', '- Detail Pengumuman')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pengumuman : {{ $pengumuman->subject }}</h2>
            <hr>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                            <td width="15%" align="right">Status :</td>
                            <td>
                                @if($pengumuman->stat == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Nonactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" align="right">Attc :</td>
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
@endsection