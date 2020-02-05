@extends('admin.master')

@section('title', '- Finance')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    <hr>
                    <h3>{{ $divisi }}</h3>
                    <table class="table">
                        <tr>
                            <td width="15%">Tanggal Score</td>
                            <td width="10px">:</td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $_GET['dari_tgl'].' sd '.$_GET['sampai_tgl'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">Kode Sales</td>
                            <td width="10px">:</td>
                            <td>{{ $karyawan->kd_sales }}</td>
                        </tr>
                        <tr>
                            <td width="15%">Nama</td>
                            <td width="10px">:</td>
                            <td>{{ $karyawan->nama }}</td>
                        </tr>
                        <tr>
                            <td width="15%">Status</td>
                            <td width="10px">:</td>
                            <td>
                                {!! ($karyawan->stat == 1) ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-danger">Non Aktif</span>' !!}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>tgl</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1; 
                                    $total_skor = 0;
                                    $total_jml = 0;
                                ?>
                                @foreach($score_jual as $row)
                                <?php
                                    $total_skor += $row->total_skor;
                                    $total_jml += $row->total_jml;
                                ?>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ date('d F Y', strtotime($row->tgl)) }}</td>
                                    <td>{{ $row->kd_barang }}</td>
                                    <td>{{ Helper::nama_barang($row->kd_barang) }}</td>
                                    <td>{{ $row->total_jml }}</td>
                                    <td>{{ $row->total_skor }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right"><b>Total : </b></td>
                                    <td><b>{{ $total_jml }}</b></td>
                                    <td><b>{{ number_format($total_skor) }}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection