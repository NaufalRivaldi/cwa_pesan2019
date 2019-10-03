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
                            <td width="15%">Tanggal</td>
                            <td width="10px">:</td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $_GET['dari_tgl'].' sd '.$_GET['sampai_tgl'] }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel</a>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Berat (Kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                $total_brt = 0;
                                $total_jml = 0;
                            ?>
                            @foreach($score_jual as $row)
                            <?php
                                $total_brt += $row->total_brt;
                                $total_jml += $row->total_jml;
                            ?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->mrbr }}</td>
                                <td>{{ Helper::nama_kriteria($row->mrbr, $row->kd_barang) }}</td>
                                <td>{{ $row->total_jml }}</td>
                                <td>{{ $row->total_brt }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" align="right"><b>Total : </b></td>
                                <td><b>{{ $total_jml }}</b></td>
                                <td><b>{{ number_format($total_brt) }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection