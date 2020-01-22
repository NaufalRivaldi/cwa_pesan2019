@extends('admin.master')

@section('title', '- Update Master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Update Master</h3>
                </div>
                <div class="card-body">
                    @if($diff->days > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Harap update data master hari ini.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($dep == 'IT' || $dep == 'Gudang' || $dep == 'SCM')
                        <form action="{{ url('/admin/master/save') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">File Master</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="form-control">
                                    <p class="text-warning">File Format : rar</p>
                                    <!-- error -->
                                    @if($errors->has('file'))
                                        <div class="text-danger">
                                            {{ $errors->first('file') }}
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
                        <hr>
                    @endif

                    <!-- table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama File</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data))
                                <tr>
                                    <td>{{ $data['file_name'] }}</td>
                                    <td>{{ $data['tgl'] }}</td>
                                    <td>
                                        <a href="{{ asset('file-master/'.$data['file_name']) }}" class="btn btn-success btn-sm">Unduh <i class="fas fa-download"></i></a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection