@extends('admin.master')

@section('title', '- Pengumuman')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pengumuman</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/pengumuman/form') }}" class="btn btn-primary btn-sm">Buat Pengumuman</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Departemen</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($pengumuman))
                                    @foreach($pengumuman as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->tgl }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->user->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->subject }}</a>
                                            </td>
                                            <td>
                                                @if($row->stat == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Nonactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- stat -->
                                                @if($row->stat == 1 && auth()->user()->dep == 'IT')
                                                    <a href="{{ url('/admin/pengumuman/nonactive/'.$row->id) }}" class="btn btn-danger btn-sm">Nonactive</a>
                                                @elseif($row->stat == 2 || $row->stat == 3 && auth()->user()->dep == 'IT')
                                                    <a href="{{ url('/admin/pengumuman/active/'.$row->id) }}" class="btn btn-success btn-sm">Active</a>
                                                @endif

                                                <a href="{{ url('/admin/pengumuman/edit/'.$row->id) }}" class="btn btn-success btn-sm"><i class="fas fa-cog"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm remove-pengumuman" data-id="{{ $row->id }}"><i class="fas fa-trash-alt"></i></a>
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
    </div>
@endsection