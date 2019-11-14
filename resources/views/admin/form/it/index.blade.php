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
                                                <option value="">Pilih Cabang</option>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form as $row)
                                        <?php
                                            $url = 'admin/formhrd/detail/'.$row->id;
                                        ?>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">
                                                    {{ Helper::setDate($row->created_at) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{{ Helper::setAlasan($row->id) }}</a>
                                            </td>
                                            
                                            <td>
                                                @if($row->stat == 1)
                                                    <a href="#" class="btn btn-danger btn-sm delete_form_hrd" data-id="{{ $row->id }}"><i class="fas fa-trash"></i></a>
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