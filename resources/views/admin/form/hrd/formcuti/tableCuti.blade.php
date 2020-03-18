







<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Cuti</th>
            <th>Kategori</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailCuti as $detail)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{!!Helper::setDate($detail->tanggalCuti)!!}</td>
                <td>{{ $detail->cuti->kategoriCuti->kategori }}</td>
                <td>{{ $detail->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>