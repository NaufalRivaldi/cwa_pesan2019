@extends('backend.master')

@section('title', '- Backends')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">{{ $data['title'] }}</h1>
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Data {{ $data{'title'} }}</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->has('file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                        @endif
                        
                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                            Tambah Data
                        </button> 
                        <hr>

                        <!-- collpase -->
                        <div class="collapse" id="collapseForm">
                            <!-- import -->
                            <div class="card card-body mb-3">
                                <p class="text-danger">Akan menghapus semua data karyawan dan menggantikan yang baru. Data form mungkin akan bermasalah.</p>
                                <form class="form-inline" action="{{ route('karyawan.all.import') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group mb-2">
                                        <label>Import Excel</label>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="file-import" class="sr-only">Password</label>
                                        <input type="file" name="file" class="form-control" id="file-import">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Import</button>
                                </form>
                            </div>

                            <!-- masukkan satu satu -->
                            <div class="card card-body">
                                <form action="{{ url('/backend/karyawan/save') }}" method="POST">
                                {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nik" class="form-control">
                                            <!-- error -->
                                            @if($errors->has('nik'))
                                                <div class="text-danger">
                                                    {{ $errors->first('nik') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama" class="form-control">
                                            <!-- error -->
                                            @if($errors->has('nama'))
                                                <div class="text-danger">
                                                    {{ $errors->first('nama') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Departemen</label>
                                        <div class="col-sm-10">
                                            <select name="dep" class="form-control">
                                                @foreach($data['dep'] as $c)
                                                    <option value="{{ $c }}">{{ $c }}</option>
                                                @endforeach
                                            </select>
                                            <!-- error -->
                                            @if($errors->has('dep'))
                                                <div class="text-danger">
                                                    {{ $errors->first('dep') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jabatan</label>
                                        <div class="col-sm-10">
                                            <select name="stat" class="form-control">
                                                <option value="1">Staff</option>
                                                <option value="2">Kepala Bagian</option>
                                                <option value="3">Area Manager</option>
                                                <option value="4">General Manager</option>
                                                <option value="5">Asst Direktur</option>
                                                <option value="6">Direktur</option>
                                            </select>
                                            <!-- error -->
                                            @if($errors->has('dep'))
                                                <div class="text-danger">
                                                    {{ $errors->first('dep') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                                        <div class="col-sm-10">
                                            <input type="submit" name="btn" value="Simpan" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- collapse -->

                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($data['karyawan'] as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nik }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->dep }}</td>
                                        <td>{!! Helper::statusKaryawan($row->stat) !!}</td>
                                        <td>
                                            <a href="{{ url('backend/karyawan/edit/'.$row->id) }}" class="btn btn-success btn-sm">Edit</a> 
                                            <a href="{{ url('backend/karyawan/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Delete</a>
                                        </td>
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