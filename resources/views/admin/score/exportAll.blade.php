<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Data Scoreboard</title>

    <style>
    table { border-collapse: collapse !important; border: 1px solid black !important; }
    </style>
</head>
<body>
    <?php
        $no = 1;
        $total_skor = 0;
    ?>
    <h3>Semua Data Scoreboard</h3>
    <table style="border-collapse: collapse">
        <tr>
            <th>Tanggal : {{ $_GET['dari_tgl'].' sd '.$_GET['sampai_tgl'] }}</th>
        </tr>
        <tr>
            <th>NO</th>
            <th>KODE SALES</th>
            <th>NAMA KARYAWAN</th>
            <th>NAMA CABANG</th>
            <th>SKOR</th>
        </tr>
        <?php
            $tgl_a = $_GET['dari_tgl'];
            $tgl_b = $_GET['sampai_tgl'];
            
            $score_jual = DB::table('history_jual')->select('kd_sales', 'tgl', 'divisi', DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('kd_sales')->orderBy('total_skor', 'desc')->get();
        ?>
        @foreach($score_jual as $row)
        <?php
            $total_skor += $row->total_skor;
        ?>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->kd_sales }}</td>
            <td>{{ Helper::get_karyawan($row->kd_sales, $row->divisi) }}</td>
            <td>{{ Helper::get_divisi($row->divisi) }}</td>
            <td>{{ $row->total_skor }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" align="right"><b>Total</b></td>
            <td><b>{{ number_format($total_skor) }}</b></td>
        </tr>
    </table>
</body>
</html>