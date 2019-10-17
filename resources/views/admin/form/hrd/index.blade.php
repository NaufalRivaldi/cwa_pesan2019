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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($form as $row)
                                <?php
                                    $url = '';
                                ?>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a href="{{ url($url) }}" class="a-block">
                                            {{ Helper::setDate($row->created_at) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url($url) }}" class="a-block">{!! Helper::setKategori($row->kategori) !!}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url($url) }}" class="a-block">{{ $row->karyawanAll->nama }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url($url) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url($url) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                    </td>
                                    
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm delete_form_hrd" data-id="{{ $row->id }}"><i class="fas fa-trash"></i></a>
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