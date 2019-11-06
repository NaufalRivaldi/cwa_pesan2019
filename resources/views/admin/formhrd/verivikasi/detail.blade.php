@extends('admin.master')

@section('title', '- Detail Pesan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <a href="{{ route('verifikasi') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h2>Form HRD</h2>
                        <table style="font-size: 0.9em">
                            <tr>
                                <td>Diajukan Oleh</td>
                                <td width="20px">:</td>
                                <td>{{ $form->karyawanAll->nama }} ({{ $form->karyawanAll->nik }})</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{!! Helper::setStatus($form->stat).' , '.Helper::setAlasan($form->id) !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <table style="font-size: 0.9em" class="table">
                                        <tr>
                                            <td width="15%">Kategori</td>
                                            <td width="20px">:</td>
                                            <td>{!! Helper::setKategori($form->id) !!} {{ ($form->lembur == 1) ? 'Berbayar' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $form->karyawanAll->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bagian / Jabatan</td>
                                            <td>:</td>
                                            <td>{{ $form->karyawanAll->dep.' / '.Helper::setJabatan($form->karyawanAll->stat) }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td>{{ $form->karyawanAll->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal, Jam</td>
                                            <td>:</td>
                                            <td>
                                                {{ Helper::setDateTime($form->tgl_a) }} s/d 
                                                {{ Helper::setDateTime($form->tgl_b) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>:</td>
                                            <td>{!! $form->keterangan !!}</td>
                                        </tr>
                                    </table>
                                    <hr>
                                    @if(auth()->user()->level > $form->karyawanAll->stat && $form->stat < 3)
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
                <?php 
                    $link = '';
                    if(auth()->user()->level == 7){
                        $link = 'HRD';
                    }
                ?>
                <form action="{{ url('admin/formhrd/acc'.$link.'/'.$form->id) }}" method="POST">
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
                <form action="{{ url('admin/formhrd/tolak'.$link.'/'.$form->id) }}" method="POST">
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