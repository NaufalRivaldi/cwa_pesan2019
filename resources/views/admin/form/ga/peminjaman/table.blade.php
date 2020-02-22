<div class="table-responsive">
  <table class="custom-table table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Tgl Peminjaman</th>
        <th>Mulai</th>
        <th>Sampai</th>
        <th>Sarana</th>
        <th>Keterangan</th>
        @if($formPeminjaman->status == 1 && auth()->user()->dep == 'GA' || auth()->user()->dep == 'IT')
        <th>Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($peminjaman as $row)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ Helper::setDate($row->tgl) }}</td>
        <td>{{ $row->pukulA }}</td>
        <td>{{ $row->pukulB }}</td>
        <td>{{ $row->sarana->namaSarana }}</td>
        <td>{{ $row->keterangan }}</td>
        @if($formPeminjaman->status == 1 && auth()->user()->dep == 'GA' || auth()->user()->dep == 'IT')
        <td>
          <button class="btn btn-warning btn-sm fas fa-pencil-alt editSarana" data-id="{{ $row->id }}"></button>
          <button class="btn btn-danger btn-sm far fa-trash-alt hapusSarana" data-id="{{ $row->id }}"></button>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>