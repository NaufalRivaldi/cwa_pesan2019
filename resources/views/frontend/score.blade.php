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
                    <div class="card-header cardhead">
                        <form action="{{ url('scoreboard') }}" action="GET">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Dari Tanggal</label>
                                        <input type="date" name="dari_tgl" class="form-control" value="{{ (isset($_GET['dari_tgl'])) ? $_GET['dari_tgl'] : $score->tgl }}">
                                        <input type="checkbox" name="group" value="1" checked> Gabungkan Skor Per Divisi.
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Sampai Tanggal</label>
                                        <input type="date" name="sampai_tgl" class="form-control" value="{{ (isset($_GET['sampai_tgl'])) ? $_GET['sampai_tgl'] : $score->tgl }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Divisi</label>
                                        <select name="divisi" id="" class="form-control">
                                            <option value="">Semua Divisi</option>
                                            @foreach($divisi as $r => $i)
                                            <option value="{{ $r }}" <?= (!empty($_GET['divisi'])) ? ($_GET['divisi'] == $r) ? 'selected' : '' : '' ?>>{{ $i }}</option>
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
                            <table id="<?= (isset($_GET['group'])) ? '' : 'myTable' ?>" class="custom-table table table-hover">
                            @if(isset($_GET['group']))
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA CABANG</th>
                                        <th>SKOR</th>
                                    </tr>
                                </thead>
                            @else
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA KARYAWAN</th>
                                        <th>NAMA CABANG</th>
                                        <th>SKOR</th>
                                    </tr>
                                </thead>
                            @endif

                            @if(isset($_GET['group']))
                                <?php
                                    $total = 0;
                                ?>
                                <tbody class="link-table">
                                    @foreach($score_jual as $row)
                                    <?php
                                        $total += $row->total_skor;
                                        $url = 'scoreboard?dari_tgl='.$_GET['dari_tgl'].'&sampai_tgl='.$_GET['sampai_tgl'].'&divisi='.$row->divisi;
                                    ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a href="{{ url($url) }}">{{ Helper::get_divisi($row->divisi) }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}">
                                                {{ number_format($row->total_skor) }}<br>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated {{ helper::get_color(Helper::get_val($row->total_skor)) }}" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ Helper::get_val($row->total_skor) }}%"></div>
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
                            @else
                                <tbody class="link-table">
                                    <?php
                                        $total = 0;
                                    ?>
                                    @foreach($score_jual as $row)
                                    <?php
                                        $total += $row->total_skor;
                                        $url = 'scoreboarddetail?dari_tgl='.$_GET['dari_tgl'].'&sampai_tgl='.$_GET['sampai_tgl'].'&divisi='.$row->divisi.'&kd_sales='.$row->kd_sales;
                                    ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a href="{{ url($url) }}">
                                                {{ Helper::get_karyawan($row->kd_sales) }} 
                                                <span class="badge badge-primary">{{ $row->kd_sales }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}">
                                                {{ Helper::get_divisi($row->divisi) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}">
                                                {{ number_format($row->total_skor) }}<br>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated {{ helper::get_color(Helper::get_val2($row->total_skor)) }}" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ Helper::get_val2($row->total_skor) }}%"></div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" align="right">
                                            <b>Total Score : </b>
                                        </td>
                                        <td>
                                            <b>{{ number_format($total) }}</b>
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection