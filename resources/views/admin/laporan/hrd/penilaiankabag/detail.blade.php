@extends('admin.master')

@section('title', '- Hasil Penilaian Kepala Bagian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Hasil Poling</h2> -->
            
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href=" {{ route('laporan.hrd.penilaian.kabag') }} "><li class="breadcrumb-item" aria-current="page">Data Hasil Penilaian Kepala Bagian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header">
                <h2>Data Hasil Penilaian Kepala Bagian</h2>                 
            </div> -->
            <div class="card-header">
                <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <table class="table custom-table">
                    <tr>
                        <td width="10%">NIK</td>
                        <td width="2%">:</td>
                        <td>{{ $karyawan->nik }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>:</td>
                        <td>{{ $karyawan->dep }}</td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td>{{ $periode->namaPeriode }}</td>
                    </tr>
                    <tr>
                        <td>Menilai</td>
                        <td>:</td>
                        <td>{{ $tlhMenilai->count() }} karyawan telah menilai dari {{ $penilai->count() }} Karyawan</td>
                    </tr>
                </table>
                <h3>Data Penilaian</h3>
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="myTable2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="70%">Nama Indikator</th>
                                <th>Jumlah Nilai</th>
                                <th>Rata - Rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalJml = 0;
                                $totalMean = 0;
                            ?>
                            @foreach($penilaianFirst as $indikator)
                                <?php 
                                    $jml = Helper::jmlNilaiKabag($karyawan->id, $periode->id, $indikator->indikator->id);
                                    $mean = $jml / $tlhMenilai->count();
                                    $totalJml += $jml;
                                    $totalMean += $mean;
                                ?>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $indikator->indikator->pertanyaan }}</td>
                                    <td>{{ $jml }}</td>
                                    <td>{{ $mean }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-center">Total</th>
                                <th>{{ $totalJml }}</th>
                                <th>{{ $totalMean }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr>
                <h3>Data Kuisioner</h3>
                <div class="accordion" id="accordionExample">
                    @foreach($detailKuisioner as $kuisioner)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn text-left font-weight-bold" type="button" data-toggle="collapse" data-target="#collapse{{ $kuisioner->kuisioner->id }}" aria-expanded="true" aria-controls="collapse{{ $kuisioner->kuisioner->id }}">
                                    {{ $kuisioner->kuisioner->pertanyaan }}
                                    </button>
                                </h2>
                                </div>

                                <div id="collapse{{ $kuisioner->kuisioner->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    @foreach(Helper::jawabanKuisioner($karyawan->id, $periode->id, $kuisioner->kuisioner->id) as $detailKuisioner)
                                        <p>
                                            {{ $detailKuisioner->jawaban }}
                                        </p>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection