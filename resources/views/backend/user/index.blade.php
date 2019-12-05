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
                                <form action="{{ url('/backend/user/save') }}" method="POST">
                                {{ csrf_field() }}
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
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control">
                                            <!-- error -->
                                            @if($errors->has('email'))
                                                <div class="text-danger">
                                                    {{ $errors->first('email') }}
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
                                        <label class="col-sm-2 col-form-label">Level</label>
                                        <div class="col-sm-10">
                                            <select name="level" class="form-control">
                                                <option value="2">User</option>
                                                <option value="3">Area Manager</option>
                                                <option value="4">General Manager</option>
                                                <option value="5">Asst Direktur</option>
                                                <option value="6">Direktur</option>
                                            </select>
                                            <!-- error -->
                                            @if($errors->has('level'))
                                                <div class="text-danger">
                                                    {{ $errors->first('level') }}
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

                        <table id="myTable2" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Departemen</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($data['user'] as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->dep }}</td>
                                        <td>{!! Helper::statusUser($row->stat) !!}</td>
                                        <td>
                                            <a href="{{ url('backend/user/reset/'.$row->id) }}" class="btn btn-success btn-sm">Reset Password</a> 
                                            <a href="{{ url('backend/user/edit/'.$row->id) }}" class="btn btn-success btn-sm">Edit</a>

                                            @if($row->stat == 1)
                                                <a href="{{ url('backend/user/nonactive/'.$row->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Nonaktifkan User?')">Nonactive</a>
                                            @else
                                                <a href="{{ url('backend/user/active/'.$row->id) }}" class="btn btn-info btn-sm" onclick="return confirm('Aktifkan User?')">Active</a>
                                            @endif
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