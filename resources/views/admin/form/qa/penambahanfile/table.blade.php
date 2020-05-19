<div class="table-responsive">
  <table class="custom-table table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>No. Form</th>
        <th>No. Revisi</th>
        <th>Terbit</th>
        <th>Nama</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      @foreach($detailFormQa as $row)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $row->file->no_form }}</td>
        <td>{{ $row->file->no_revisi }}</td>
        <td>{!! Helper::setDateForm($row->file->tgl_terbit) !!}</td>
        <td>{{ $row->file->nama }}</td>
        <td>{{ $row->qty }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>