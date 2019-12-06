@extends('admin.master')

@section('title', '- Detail Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <a href="{{ url('admin/formhrd/') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h2>Form HRD</h2>
                        <hr>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-md-2">
                                Diajukan Oleh :
                            </div>
                            <div class="col-md-9">
                                {{ $form->karyawanAll->nama }}
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-md-2">
                                Status :
                            </div>
                            <div class="col-md-9">
                                {!! Helper::setStatus($form->stat).' , '.Helper::setAlasan($form->id) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            Kategori :
                                        </div>
                                        <div class="col-md-10">
                                            {{ $form->karyawanAll->nama }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Nama :
                                        </div>
                                        <div class="col-md-10">
                                            {!! Helper::setKategori($form->id) !!}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Bagian / Jabatan :
                                        </div>
                                        <div class="col-md-10">
                                            {{ $form->karyawanAll->dep.' / '.Helper::setJabatan($form->karyawanAll->stat) }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Tanggal, Jam :
                                        </div>
                                        <div class="col-md-10">
                                            {{ Helper::setDateTime($form->tgl_a) }} s/d 
                                            {{ Helper::setDateTime($form->tgl_b) }}
                                        </div>
                                    </div>
                                    <hr>
                                   
                                    <!-- keterangan lembur -->
                                    @if($form->lembur == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            Lembur :
                                        </div>
                                        <div class="col-md-10">
                                            Berbayar
                                        </div>
                                    </div>
                                    <hr>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-2">
                                            Keterangan :
                                        </div>
                                        <div class="col-md-10">
                                            {!! $form->keterangan !!}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($form->stat == 1 && auth()->user()->level > $form->karyawanAll->stat && auth()->user()->level != 7)
                                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accModal">Acc Form</a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakModal">Tolak</a>
                                            @endif
                                            @if($form->stat == 1 && auth()->user()->level == 7 && $form->karyawanAll->stat == 1)
                                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accModal">Acc Form</a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakModal">Tolak</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
<!-- acc -->
<div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Acc Form ( {{ $data['set_modal']['title'] }} )</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Masukkan nik dan password {{ strtolower($data['set_modal']['title']) }} untuk acc form tersebut.</p>
                <form action="{{ url('admin/formhrd/acc/'.$form->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="karyawanStat" value="{{ $data['set_modal']['stat'] }}">
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
                <p class="text-danger">* Dengan mengacc form ini, maka {{ strtolower($data['set_modal']['title']) }} menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
            </div>
        </div>
    </div>
</div>

<!-- tolak -->
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Tolak Form ( {{ $data['set_modal']['title'] }} )</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Masukkan nik dan password {{ strtolower($data['set_modal']['title']) }} untuk tolak form tersebut.</p>
                <form action="{{ url('admin/formhrd/tolak/'.$form->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="karyawanStat" value="{{ $data['set_modal']['stat'] }}">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label>
                        <textarea name="keterangan" id="" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-danger">* Dengan menolak form ini, maka {{ strtolower($data['set_modal']['title']) }} menyetujui atau bertanggung jawab penuh atas penolakan dan alasan ditolaknya form tersebut. </p>
            </div>
        </div>
    </div>
</div>
@endsection