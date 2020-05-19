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
    ?>
    <div class="">
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Kategori</th>
                    <th>No. Form</th>
                    <th>No. Revisi</th>
                    <th>Tgl Terbit</th>
                    <th>Form/Dokumen</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($form as $row)
                    @foreach($row->detail as $df)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $df->form->kode }}</td>
                        <td>{!! Helper::setDateForm($df->form->created_at) !!}</td>
                        <td>{{ $df->form->karyawan->nama }}</td>
                        <td>{{ $df->form->karyawan->dep }}</td>
                        <td>{!! Helper::kategoriFormQa($df->form->kategori) !!}</td>
                        <td>{{ $df->file->no_form }}</td>
                        <td>{{ $df->file->no_revisi }}</td>
                        <td>{{ $df->file->tgl_terbit }}</td>
                        <td>{{ $df->file->nama }}</td>
                        <td>{{ $df->qty }}</td>
                        <td>{{ $df->form->keterangan }}</td>
                        <td>{!! Helper::statusFormQa($df->form->status) !!}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>