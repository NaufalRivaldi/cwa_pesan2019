@extends('admin.master')

@section('title', '- Pengumuman')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pengumuman : {{ $pengumuman->subject }}</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/pengumuman') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a> 
                    <!-- stat -->
                    @if($pengumuman->stat == 1)
                        <a href="{{ url('/admin/pengumuman/nonactive/'.$pengumuman->id) }}" class="btn btn-success btn-sm">Nonactive</a>
                    @else
                        <a href="{{ url('/admin/pengumuman/active/'.$pengumuman->id) }}" class="btn btn-success btn-sm">Active</a>
                    @endif

                    <a href="{{ url('/admin/pengumuman/edit/'.$pengumuman->id) }}" class="btn btn-success btn-sm"><i class="fas fa-cog"></i></a>
                    <a href="#" class="btn btn-danger btn-sm remove-pengumuman" data-id="{{ $pengumuman->id }}"><i class="fas fa-trash-alt"></i></a>
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