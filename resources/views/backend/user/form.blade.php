@extends('backend.master')

@section('title', '- Backends')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">{{ $title }}</h1>
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Data {{ $title }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/backend/user/update') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="{{ $user->nama }}">
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
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
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
                                        @foreach($dep as $c)
                                            @if($user->dep == $c)
                                                <option value="{{ $c }}" selected>{{ $c }}</option>
                                            @else
                                                <option value="{{ $c }}">{{ $c }}</option>
                                            @endif
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
                                        <option value="2" {{ ($user->level == 2) ? 'selected' : '' }}>User</option>
                                        <option value="3" {{ ($user->level == 3) ? 'selected' : '' }}>Area Manager</option>
                                        <option value="4" {{ ($user->level == 4) ? 'selected' : '' }}>General Manager</option>
                                        <option value="5" {{ ($user->level == 5) ? 'selected' : '' }}>Asst Direktur</option>
                                    </select>
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