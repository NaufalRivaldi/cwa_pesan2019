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
                            Import Data
                        </button> 
                        <hr>

                        <!-- collpase -->
                        <div class="collapse" id="collapseForm">
                            <div class="card card-body">
                                <form action="{{ url('/backend/kodebarang/save') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Import File</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" class="form-control">
                                            <p class="text-warning">Format .xlsx</p>
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
                            </div>
                        </div>
                        <!-- collapse -->

                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>mrbr</th>
                                    <th>glbr</th>
                                    <th>kmbr</th>
                                    <th>jnbr</th>
                                    <th>kdbr</th>
                                    <th>nmbr</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($data['kodebarang'] as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->mrbr }}</td>
                                        <td>{{ $row->glbr }}</td>
                                        <td>{{ $row->kmbr }}</td>
                                        <td>{{ $row->jnbr }}</td>
                                        <td>{{ $row->kdbr }}</td>
                                        <td>{{ $row->nmbr }}</td>
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