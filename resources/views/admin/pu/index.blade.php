@extends('admin.master')

@section('title', '- Penjualan PU')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="display-4">Penjualan PU</h1>
            <p class="lead">Update Terakhir : {{ date('d F Y, H:i:s', strtotime($setting->last_update_score)) }}</p>
            
            <!-- last update -->
            @if($diff > 0)
                <p class="text text-danger">*Harap segera update data penjualan!</p>
            @endif
            <!-- last update -->
            <hr class="hr-yellow">
            <div class="card">
                <div class="card-header bg-dark" style="color:white">
                    <form action="{{ url('admin/penjualanpu') }}" action="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="text-bold">Dari Tanggal</label>
                                    <input type="date" name="dari_tgl" class="form-control" value="{{ (isset($_GET['dari_tgl'])) ? $_GET['dari_tgl'] : $score->tgl }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="text-bold">Sampai Tanggal</label>
                                    <input type="date" name="sampai_tgl" class="form-control" value="{{ (isset($_GET['sampai_tgl'])) ? $_GET['sampai_tgl'] : $score->tgl }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="text-bold">Divisi</label>
                                    <select name="divisi" id="" class="form-control">
                                        <option value="">Semua Divisi</option>
                                        @foreach($divisi as $r)
                                        <option value="{{ $r->divisi }}" <?= (!empty($_GET['divisi'])) ? ($_GET['divisi'] == $r->divisi) ? 'selected' : '' : '' ?>>{{ $r->divisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="Proses" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if($_GET)
                        <a href="{{ url('admin/penjualanpu/expall?dari_tgl='.$_GET['dari_tgl'].'&sampai_tgl='.$_GET['sampai_tgl']) }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel</a>
                        <hr>
                        <div class="table-responsive">
                            <table id="<?= (isset($_GET['group'])) ? '' : 'myTable' ?>" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA CABANG</th>
                                    <th>TOTAL BERAT (KG)</th>
                                </tr>
                            </thead>
                            <?php
                                $total = 0;
                                $first_skor = 0;
                            ?>
                            <tbody class="link-table">
                                @foreach($score_jual as $row)
                                <?php
                                    $total += $row->total_brt;
                                    $url = 'admin/penjualanpu/detail?dari_tgl='.$_GET['dari_tgl'].'&sampai_tgl='.$_GET['sampai_tgl'].'&divisi='.$row->divisi;

                                    // first score
                                    if($first_skor == 0){
                                        $first_skor = $row->total_brt;
                                    }
                                ?>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a href="{{ url($url) }}">{{ Helper::get_divisi($row->divisi) }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url($url) }}">
                                            {{ number_format($row->total_brt) }}<br>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ helper::get_color(Helper::get_val($row->total_brt, $first_skor)) }}" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ Helper::get_val($row->total_brt, $first_skor) }}%"></div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" align="right">
                                        <b>Total Score : </b>
                                    </td>
                                    <td>
                                        <b>{{ number_format($total) }}</b>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection