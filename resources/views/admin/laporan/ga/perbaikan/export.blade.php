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
        libxml_use_internal_errors(true);
        $tgl = date('d F Y', strtotime($dateFirst)).' s/d '.date('d F Y');
        $dep = "All Departement";
        if($_GET){
            $dep = $_GET['dep'];
            $tgl = date('d F Y', strtotime($_GET['tgl_a'])).' s/d '.date('d F Y', strtotime($_GET['tgl_b']));
        }
    ?>
    <h2>Laporan Form Perbaikan Sarana & Prasarana</h2>
    <p class="lead">Tanggal : {{ $tgl }}</p>
    <div class="">
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl Pengajuan</th>
                    <th>Tgl Selesai</th>
                    <th>Dept</th>
                    <th>Permintaan</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($form as $form)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $form->tglPengajuan }}</td>
                        <td>{{ $form->tglSelesai }}</td>
                        <td>{{ $form->user->dep }}</td>
                        <td>{{ $form->permintaan }}</td>
                        <td>{{ $form->alasan }}</td>
                        <td>{{ Helper::statusPerbaikanLaporan($form->status) }}</td>
                        <td>{{ $form->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>