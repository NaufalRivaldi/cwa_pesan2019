@extends('admin.master')

@section('title', '- Master Prosedur')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Master Prosedur</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="container">
                        <div class="card-header row">
                            <a href="{{ route('master.prosedur.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Prosedur</th>
                                        <th>Departemen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prosedur as $p)
                                      <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->departemen->nama }}</td>
                                        <td>                                        
                                          <a href="{{ route('master.prosedur.view', ['id' => $p->id]) }}" class=""><i class="btn btn-sm btn-warning fas fa-eye"></i></a>

                                          <a href="{{ asset('file-prosedur/'.$p->file) }}" class="btn btn-success btn-sm fas fa-download" download="{{strtolower(str_replace(' ', '_', $p->nama))}}"></a>
                                        
                                          <a href="{{ route('master.prosedur.edit', ['id' => $p->id]) }}" class=""><i class="btn btn-sm btn-info fas fa-cog"></i></a>

                                          <button class="btn btn-sm btn-danger btn-delete far fa-trash-alt" data-id="{{ $p->id }}"><i class=""></i></button>
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
                        url: "{{ route('master.prosedur.destroy') }}",
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