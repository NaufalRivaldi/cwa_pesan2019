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
                                    <th>Tanggal Post</th>
                                    <th>Berlaku Sampai</th>
                                    <th>Nama - Departemen</th>
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
                                                <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->tgl_akhir }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/pengumuman/detail/'.    $row->id) }}" class="a-block">{{ $row->user->nama.' - '.$row->user->dep }}</a>
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
                                                @if($row->stat == 1)
                                                    <a href="{{ url('/admin/pengumuman/nonactive/'.$row->id) }}" class="btn btn-danger btn-sm clickPengumuman" data-toggle="modal" data-target="#nonactiveModal" data-id="{{ $row->id }}">Nonactive</a>
                                                @elseif($row->stat == 2 || $row->stat == 3)
                                                    <a href="#" class="btn btn-success btn-sm clickPengumuman" data-toggle="modal" data-target="#activeModal" data-id="{{ $row->id }}">Active</a>
                                                @endif

                                                @if($row->stat == 2 || $row->stat == 3)
                                                    <a href="{{ url('/admin/pengumuman/edit/'.$row->id) }}" class="btn btn-success btn-sm"><i class="fas fa-cog"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm remove-pengumuman" data-id="{{ $row->id }}"><i class="fas fa-trash-alt"></i></a>
                                                @endif
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

@section('modal')
<!-- aktif -->
<div class="modal fade" id="activeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Aktifkan Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengumuman.active') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="pengumuman_id" class="form-control pengumuman_id">

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-danger">* Masukkan nik dan password kepala bagian untuk mengaktifkan pengumuman. </p>
            </div>
        </div>
    </div>
</div>

<!-- nonaktif -->
<div class="modal fade" id="nonactiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Nonactive Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengumuman.nonactive') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="pengumuman_id" class="form-control pengumuman_id">

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-danger">* Masukkan nik dan password kepala bagian untuk mengnonaktifkan pengumuman. </p>
            </div>
        </div>
    </div>
</div>
@endsection