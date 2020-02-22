@extends('admin.master')

@section('title', '- Master Sarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Master Sarana</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="container">
                        <div class="card-header row">
                            <a href="{{ route('master.sarana.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sarana</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sarana as $sarana)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $sarana->namaSarana }}</td>
                                            <td>
                                              <a href="{{ route('master.sarana.edit', ['id' => $sarana->id]) }}" class=""><i class="btn btn-sm btn-info fas fa-cog"></i></a>

                                              @if(auth()->user()->dep == 'IT' || auth()->user()->dep == 'GA')
                                              <button class="btn btn-sm btn-danger btn-delete far fa-trash-alt" data-id="{{ $sarana->id }}"><i class=""></i></button>
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
                        url: "{{ route('master.sarana.destroy') }}",
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