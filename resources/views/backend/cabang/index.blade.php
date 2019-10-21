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
                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                            Tambah Data
                        </button> 
                        <hr>

                        <!-- collpase -->
                        <div class="collapse" id="collapseForm">
                            <div class="card card-body">
                                <form action="{{ url('/backend/cabang/save') }}" method="POST">
                                {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Inisial</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="inisial" class="form-control">
                                            <!-- error -->
                                            @if($errors->has('inisial'))
                                                <div class="text-danger">
                                                    {{ $errors->first('inisial') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Cabang</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_cabang" class="form-control">
                                            <!-- error -->
                                            @if($errors->has('nama_cabang'))
                                                <div class="text-danger">
                                                    {{ $errors->first('nama_cabang') }}
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
                                    <th>Inisial</th>
                                    <th>Nama Cabang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($data['cabang'] as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->inisial }}</td>
                                        <td>{{ $row->nama_cabang }}</td>
                                        <td>
                                            <a href="{{ url('backend/cabang/edit/'.$row->id) }}" class="btn btn-success btn-sm">Edit</a> 
                                            <a href="{{ url('backend/cabang/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Delete</a>
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