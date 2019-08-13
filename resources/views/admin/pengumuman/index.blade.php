@extends('admin.master')

@section('title', '- Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pengumuman</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/pengumuman/form') }}" class="btn btn-primary">Buat Pengumuman</a>
                </div>
                <div class="card-body">
                    <table id="myTable" class="custom-table table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tgl</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($pengumuman))
                                @foreach($pengumuman as $row)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="id_delete" value="{{ $row->id }}">
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->tgl }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->subject }}</a>
                                        </td>
                                        <td>
                                            @if($row->stat == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/pengumuman/edit/'.$row->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ url('/admin/pengumuman/delete/'.$row->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection