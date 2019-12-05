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
                        <h3><i class="fas fa-spinner"></i> Form Progress</h3>
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form_progress as $row)
                                        @if(auth()->user()->level > 2 && auth()->user()->level != 7)
                                            @if(auth()->user()->level == $row->karyawanAll->stat)
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
                                            @endif
                                        @elseif(auth()->user()->level <= 2 || auth()->user()->level == 7)
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
                                                    <a href="#" class="btn btn-danger btn-sm remove-form-hrd" data-id="{{ $row->id }}" data-toggle="modal" data-target="#remove-form-hrd"><i class="fas fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h3><i class="fas fa-check-circle"></i> Form Selesai</h3>
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form as $row)
                                        @if(auth()->user()->level > 2 && auth()->user()->level != 7)
                                            @if(auth()->user()->level == $row->karyawanAll->stat)
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
                                            </tr>
                                            @endif
                                        @elseif(auth()->user()->level <= 2 || auth()->user()->level == 7)
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
                                        </tr>
                                        @endif
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

@section('modal')
<!-- delete -->
<div class="modal fade" id="remove-form-hrd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Delete Form HRD</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('formhrd.delete') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="form_hrd_id" class="form-control form_hrd_id">

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
                <p class="text-danger">* Masukkan nik dan password kepala bagian untuk menghapus form. </p>
            </div>
        </div>
    </div>
</div>
@endsection