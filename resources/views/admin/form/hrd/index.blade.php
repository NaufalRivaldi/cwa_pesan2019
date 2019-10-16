@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Form HRD</h2>
                    </div>
                    <div class="card-header">
                        <a href="{{ url('admin/formhrd/form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a> 
                        <span id="insert-menu"></span>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Bagian/Jabatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($form as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->kategori }}</td>
                                        <td>{{ $row->karyawan->nama }}</td>
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