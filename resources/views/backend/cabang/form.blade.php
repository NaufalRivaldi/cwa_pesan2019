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
                        <form action="{{ url('/backend/cabang/update') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $cabang->id }}">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Inisial</label>
                                <div class="col-sm-10">
                                    <input type="text" name="inisial" class="form-control" value="{{ $cabang->inisial }}">
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
                                    <input type="text" name="nama_cabang" class="form-control" value="{{ $cabang->nama_cabang }}">
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
            </div>
        </div>
    </div>
@endsection