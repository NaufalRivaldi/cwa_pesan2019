@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Data Karyawan</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="container">
                        <div class="card-header row">
                            <a href="{{ route('laporan.hrd.karyawan.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                            @if(auth()->user()->dep == 'IT')              
                            <button type="button" class="btn btn-success btn-sm ml-2 modalGen"><i class="fas fa-plus-circle"></i> Generate Masa Kerja</button>
                            @endif
                            <form action="{{route('laporan.hrd.karyawan')}}" method="get" class="ml-auto" id="submitFilter">
                                <select class="form-control-sm filter" name="dep" id="exampleFormControlSelect1">
                                <option value="">Pilih Departemen...</option>
                                @foreach(Helper::allDep() as $dep)
                                <option value="{{$dep}}" {{ ($_GET)?($_GET['dep']) == $dep ?'selected':'':'' }}>{{$dep}}</option>
                                @endforeach
                                </select>
                            </form>
                        </div>
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
                                        <th>Tanggal Bekerja</th>
                                        <th>Status</th>
                                        <th>Status Poling</th>
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
                                            <td>{{ Helper::setDate($karyawan->masaKerja) }}</td>
                                            <td>{!! Helper::statusUser($karyawan->ket) !!}</td>
                                            <td>{!! Helper::statusBool($karyawan->statusPoling) !!}</td>
                                            <td>
                                                @if($karyawan->ket == 1)
                                                    <a href="{{ route('laporan.hrd.karyawan.nonaktif', ['id' => $karyawan->id]) }}" class="btn btn-danger btn-sm fa fa-times-circle"></a>
                                                @else
                                                    <a href="{{ route('laporan.hrd.karyawan.aktif', ['id' => $karyawan->id]) }}" class="btn btn-success fa fa-check-circle btn-sm"></a>
                                                @endif

                                                <a href="{{ route('laporan.hrd.karyawan.edit', ['id' => $karyawan->id]) }}" class=""><i class="btn btn-sm btn-info fas fa-cog"></i></a>

                                                @if(auth()->user()->dep == 'IT')
                                                <button class="btn btn-sm btn-danger btn-delete far fa-trash-alt" data-id="{{ $karyawan->id }}"><i class=""></i></button>
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

@section('modal')
<div class="modal fade" id="viewModalGen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('laporan.hrd.karyawan.generate')}}" method="post" id="formGenerate" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlFile1">Generate Masa Kerja Karyawan Bosqu</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submitForm">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.btn-delete', function(){
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
    $('.modalGen').on('click', function(){
      $('#viewModalGen').modal('show');
    })

    $('.submitForm').on('click', function(){
      $('#formGenerate').submit();
    })
</script>
@endsection