@extends('admin.master')

@section('title', '- Penanganan IT')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">                       
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Penanganan IT</li>
                        </ol>
                    </nav>
                </div>            
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('penanganan.it.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Tanggal</th>
                                        <th>Departement</th>
                                        <th>Permasalahan</th>
                                        <th>Penyelesaian</th>
                                        <th>Stat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->kode }}</td>
                                            <td>
                                                {{ Helper::setDate($row->tgl) }}
                                            </td>
                                            <td>
                                                {{ $row->user->dep }}
                                            </td>
                                            <td>
                                                {{ $row->masalah }}
                                            </td>
                                            <td>
                                                {{ $row->penyelesaian }}
                                            </td>
                                            <td>
                                                {!! statusFormPenangananIt($row->stat) !!}
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm fas fa-check"></button>
                                                <a href="{{ route('penanganan.it.view', ['id' => $row->id]) }}" class="btn btn-success btn-sm far fa-eye"></a>
                                                @if($row->stat == 1)
                                                    <a href="#" class="delete_form_it" data-id="{{ $row->id }}"><i class="btn btn-danger btn-sm far fa-trash-alt"></i></a>
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