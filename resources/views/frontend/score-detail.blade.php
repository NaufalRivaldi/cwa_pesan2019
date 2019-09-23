@extends('frontend.master')

@section('title', '- Scoreboard')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">Scoreboard Penjualan</h1>
                <p class="lead">Update Terakhir : {{ date('d F Y, H:i:s', strtotime($setting->last_update_score)) }}</p>
                
                <!-- last update -->
                @if($diff > 0)
                    <p class="text text-danger">*Harap segera update scoreboard!</p>
                @endif
                <!-- last update -->
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection