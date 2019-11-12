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
                    <div class="card-header">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a> 
                        <span id="insert-menu"></span>
                    </div>
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