@extends('admin.master')

@section('title', '- Detail Pesan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <a href="{{ url('admin/formhrd/') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                                <td>{!! Helper::setStatus($form->stat) !!}</td>
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
                                            <td>{!! Helper::setKategori($form->id) !!}</td>
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
                                    @if($form->stat == 1)
                                        {!! Helper::setUrlAcc($form->karyawanAll->stat, $form->karyawanAll->dep) !!}
                                        <a href="#" class="btn btn-danger btn-sm">Tolak</a>
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
<!-- Modal kepala bagian -->
<div class="modal fade" id="accKabagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Acc Form (Kepala Bagian)</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Masukkan nik dan password kepala bagian untuk acc form tersebut.</p>
                <form action="{{ url('admin/formhrd/acckabag/'.$form->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="dep" value="{{ auth()->user()->dep }}">
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
                <p class="text-danger">* Dengan mengacc form ini, maka kepala bagian menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal manager -->
<div class="modal fade" id="accManagerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Acc Form (Manager)</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Masukkan nik dan password manager untuk acc form tersebut.</p>
                <form action="{{ url('admin/formhrd/accmng/'.$form->id) }}" method="POST">
                    {{ csrf_field() }}
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
                <p class="text-danger">* Dengan mengacc form ini, maka manager menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
            </div>
        </div>
    </div>
</div>

<!-- tolak -->
<!-- Kepala bagian -->
<div class="modal fade" id="tolakKabagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Acc Form (Kepala Bagian)</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Masukkan nik dan password kepala bagian untuk acc form tersebut.</p>
                <form action="{{ url('admin/formhrd/acckabag/'.$form->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="dep" value="{{ auth()->user()->dep }}">
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
                <p class="text-danger">* Dengan mengacc form ini, maka kepala bagian menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
            </div>
        </div>
    </div>
</div>
@endsection