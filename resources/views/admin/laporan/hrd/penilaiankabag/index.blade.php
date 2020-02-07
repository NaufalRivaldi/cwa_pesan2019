@extends('admin.master')

@section('title', '- Hasil Penilaian Kepala Bagian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Hasil Poling</h2> -->
            <div class="page-breadcrumb">
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Hasil Poling</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">   
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Laporan Hasil Penilaian Kepala Bagian</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Kepala Departemen</h2>
                    </div>
                    <div class="card-body text-center">
                    <h3 class="display-4">{{ Helper::progressKabagOffice(Helper::office()) }} %</h3>
                    <p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ Helper::progressKabagOffice(Helper::office()) }}%"></div>
                        </div>
                    </p>
                    <a href="{{ route('laporan.hrd.penilaian.kabag.departemen') }}" class="btn btn-sm btn-dark col"><i class="far fa-eye"></i> Lihat</a>
                    </div>            
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Kepala Toko</h2>
                    </div>
                    <div class="card-body text-center">
                    <h3 class="display-4">{{ Helper::progressKabagToko(Helper::office()) }} %</h3>
                    <p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ Helper::progressKabagToko(Helper::office()) }}%"></div>
                        </div>
                    </p>
                    <a href="{{ route('laporan.hrd.penilaian.kabag.toko') }}" class="btn btn-sm btn-dark col"><i class="far fa-eye"></i> Lihat</a>
                    </div>          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection