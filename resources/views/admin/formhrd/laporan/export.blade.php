<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export All</title>
</head>
<body>
    <?php
        $tgl = date('d F Y', strtotime($month)).' s/d '.date('d F Y');
        $dep = "All Departement";
        if($_GET){
            $dep = $_GET['dep'];
            $tgl = date('d F Y', strtotime($_GET['tgl_a'])).' s/d '.date('d F Y', strtotime($_GET['tgl_b']));
        }
    ?>
    <h2>Laporan Form HRD</h2>
    <h3 class="dep">Departement : {{ $dep }}</h3>
    <p class="lead">Tanggal : {{ $tgl }}</p>
    <div class="">
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Bagian</th>
                    <th>Tanggal</th>
                    <th>Mulai</th>
                    <th>Berakhir</th>
                    <th>Durasi (Jam)</th>
                    <th>Keterangan</th>
                    <th>Upah Lembur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($form as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            {{ Helper::setKategoriLaporan($row->id) }}
                        </td>
                        <td>
                            {{ $row->karyawanAll->nama }}
                        </td>
                        <td>
                            {{ Helper::statusKaryawanLaporan($row->karyawanAll->stat) }}
                        </td>
                        <td>
                            {{ $row->karyawanAll->dep }}
                        </td>
                        <td>
                            {{ Helper::setDate($row->tgl_a) }}
                        </td>
                        <td>
                            {{ date('H:i', strtotime($row->tgl_a)) }}
                        </td>
                        <td>
                            {{ date('H:i', strtotime($row->tgl_b)) }}
                        </td>
                        <td>
                            {{ Helper::setDiff($row->tgl_a, $row->tgl_b, $row->lembur) }}
                        </td>
                        <td>
                            {!! $row->keterangan !!}
                        </td>
                        
                        <td>
                            {{ Helper::setUpahLembur($row->tgl_a, $row->tgl_b, $row->lembur) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>