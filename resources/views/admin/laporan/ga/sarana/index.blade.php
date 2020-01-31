@extends('admin.master')

@section('title', '- List Sarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>List Sarana & Prasarana</h3>
                    </div>
                    <div class="card-header">
                        <a href="{{ route('laporan.ga.sarana.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a> 
                        <span id="insert-menu"></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="custom-table table table-striped myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sarana as $sarana)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $sarana->namaSarana }}</td>
                                            <td>
                                                <a href="{{ route('laporan.ga.sarana.edit', ['id'=>$row->id]) }}" class=""><i class="btn btn-info btn-sm fas fa-cog"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm remove-form-hrd far fa-trash-alt" data-id="{{ $row->id }}" data-toggle="modal" data-target="#remove-form-hrd"><i class=""></i></a>
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