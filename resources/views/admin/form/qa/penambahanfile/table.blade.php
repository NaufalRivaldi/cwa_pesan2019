<div class="table-responsive">
  <table class="custom-table table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      @foreach($detailFormQa as $row)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $row->file->nama }}</td>
        <td>{{ $row->qty }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>