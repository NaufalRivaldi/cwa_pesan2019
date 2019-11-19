@extends('admin.master')

@section('title', '- Penanganan IT')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Penanganan IT</h2>
                    </div>
                    @if(auth()->user()->dep == 'IT')
                    <div class="card-header">
                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#formCollapse" role="button" aria-expanded="false" aria-controls="formCollapse"><i class="fas fa-envelope"></i> Buat Form</a> 
                        <div class="collapse mt-3" id="formCollapse">
                            <div class="card card-body">
                                <form action="{{ route('penanganan.it.store') }}" method="POST">

                                    {{ csrf_field() }}
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Divisi / Departemen</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="cabang" class="form-control col-6">
                                                <option value="">Pilih</option>
                                                @foreach(Helper::depOffice() as $row)
                                                <option value="{{ $row }}">{{ $row }}</option>
                                                @endforeach

                                                @foreach($cabang as $row)
                                                <option value="{{ $row->inisial }}">{{ $row->inisial.' - '.$row->nama_cabang }}</option>
                                                @endforeach
                                            </select>

                                            <!-- error -->
                                            @if($errors->has('cabang'))
                                                <div class="text-danger">
                                                    {{ $errors->first('cabang') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>PIC</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="karyawan_all_id" class="form-control col-6">
                                                <option value="">Pilih PIC</option>
                                                @foreach($karyawan as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                                @endforeach
                                            </select>

                                            <!-- error -->
                                            @if($errors->has('karyawan_all_id'))
                                                <div class="text-danger">
                                                    {{ $errors->first('karyawan_all_id') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Permasalahan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="masalah" rows="3" class="form-control"></textarea>

                                            <!-- error -->
                                            @if($errors->has('permasalahan'))
                                                <div class="text-danger">
                                                    {{ $errors->first('permasalahan') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Penyelesaian</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="penyelesaian" rows="5" class="form-control"></textarea>

                                            <!-- error -->
                                            @if($errors->has('penyelesaian'))
                                                <div class="text-danger">
                                                    {{ $errors->first('penyelesaian') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            &nbsp;
                                        </div>
                                        <div class="col-md-9">
                                            <input type="submit" name="btn" class="btn btn-primary btn-sm" value="Ajukan">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Departement</th>
                                        <th>PIC</th>
                                        <th>Permasalahan</th>
                                        <th>Penyelesaian</th>
                                        <th>Stat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                {{ $row->tgl }}
                                            </td>
                                            <td>
                                                {{ $row->user->dep }}
                                            </td>
                                            <td>
                                                {{ $row->karyawanAll->nama }}
                                            </td>
                                            <td>
                                                {{ $row->masalah }}
                                            </td>
                                            <td>
                                                {{ $row->penyelesaian }}
                                            </td>
                                            <td>
                                                @if($row->stat == 1)
                                                    <span class="badge badge-info">Menunggu Verifikasi</span>
                                                @else($row->stat == 2)
                                                    <span class="badge badge-success">Telah di Verivikasi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(auth()->user()->dep == 'IT' && $row->stat == 1)
                                                    <a href="#" class="btn btn-danger btn-sm delete_form_it" data-id="{{ $row->id }}"><i class="fas fa-trash"></i></a>
                                                @endif

                                                @if(auth()->user()->dep != 'IT' && $row->stat == 1)
                                                    <a href="{{ route('penanganan.it.verifikasi', ['id' => $row->id]) }}" class="btn btn-success btn-sm">Verifikasi</a>
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
    </div>
@endsection