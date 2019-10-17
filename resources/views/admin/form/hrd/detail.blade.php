@extends('admin.master')

@section('title', '- Detail Pesan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                                            <td>{!! Helper::setKategori($form->kategori) !!}</td>
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
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accKabagModal">Acc Form</a> 
                                    <a href="#" class="btn btn-danger btn-sm">Tolak</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection