@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">                       
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Cuti</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.hrd.cuti.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a> 
                    <span id="insert-menu"></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="myTable custom-table table table-hover">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Cuti</th>
                                    <th>Sisa Cuti</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cuti as $c)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$c->karyawan->nama}}</td>
                                        <td>{{$c->cuti}}</td>
                                        <td>{{$c->sisaCuti}}</td>
                                        <td>{{$c->periode}}</td>
                                        <td>MASI KOSONGAN SABAR!</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection