@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Data Karyawan</h2>
                    </div>
                    <div class="card-header">
                        <a href="{{ route('laporan.hrd.karyawan.form') }}" class="btn btn-primary btn-sm">+ Tambah Karyawan</a> 
                        <span id="insert-menu"></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawan as $karyawan)
                                        <tr class="{{ ($karyawan->ket == 2)? 'active-record' : '' }}">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $karyawan->nik }}</td>
                                            <td>{{ $karyawan->nama }}</td>
                                            <td>{{ $karyawan->dep }}</td>
                                            <td>{!! Helper::statusKaryawan($karyawan->stat) !!}</td>
                                            <td>{!! Helper::statusUser($karyawan->ket) !!}</td>
                                            <td>
                                                @if($karyawan->ket == 1)
                                                    <a href="{{ route('laporan.hrd.karyawan.nonaktif', ['id' => $karyawan->id]) }}" class="btn btn-sm btn-danger">Nonaktif</a>
                                                @else
                                                    <a href="{{ route('laporan.hrd.karyawan.aktif', ['id' => $karyawan->id]) }}" class="btn btn-sm btn-success">Aktif</a>
                                                @endif

                                                <a href="{{ route('laporan.hrd.karyawan.edit', ['id' => $karyawan->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-cog"></i></a>

                                                @if(auth()->user()->dep == 'IT')
                                                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $karyawan->id }}"><i class="far fa-trash-alt"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('.btn-delete').on('click', function(){
            var id = $(this).data('id');
            swal({
                title: "Hapus Data?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': id
                        },
                        url: "{{ route('laporan.hrd.karyawan.destroy') }}",
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
@endsection