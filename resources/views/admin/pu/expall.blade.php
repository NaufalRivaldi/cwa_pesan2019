<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export All</title>
</head>
<body>
    @foreach($cabang as $c)
        <?php
            $no = 1;
            $total_jml = 0;
            $total_brt = 0;
        ?>
        <h3>{{ $c->nama_cabang }}</h3>
        Tanggal : {{ $_GET['dari_tgl'].' sd '.$_GET['sampai_tgl'] }}
        <table border='1'>
            <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>NAMA BARANG</th>
                <th>QTY</th>
                <th>BERAT (KG)</th>
            </tr>
            <?php
                $tgl_a = $_GET['dari_tgl'];
                $tgl_b = $_GET['sampai_tgl'];
                
                $score_jual = DB::table('history_jual')
                ->join('kode_barang', 'history_jual.kd_barang', '=', 'kode_barang.kdbr')
                ->select('history_jual.tgl', 'history_jual.kd_barang', DB::raw('SUM(history_jual.jml) AS total_jml'), DB::raw('SUM(history_jual.brt * history_jual.jml) AS total_brt'), 'kode_barang.mrbr')
                ->whereBetween('history_jual.tgl', [$tgl_a, $tgl_b])
                ->where('divisi', $c->inisial)
                ->groupBy('kode_barang.mrbr')
                ->orderBy('kode_barang.mrbr')
                ->get();
            ?>
            @foreach($score_jual as $row)
            <?php
                $total_jml += $row->total_jml;
                $total_brt = $total_brt + $row->total_brt;
            ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->mrbr }}</td>
                <td>{{ Helper::nama_kriteria($row->mrbr, $row->kd_barang) }}</td>
                <td>{{ $row->total_jml }}</td>
                <td>{{ str_replace('.', ',', $row->total_brt) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" align="right"><b>Total</b></td>
                <td><b>{{ number_format($total_jml) }}</b></td>
                <td><b>{{ $total_brt }}</b></td>
            </tr>
        </table>
        <hr>
    @endforeach
</body>
</html>