@extends('admin.master')

@section('title', '- Master File')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Master File</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="container">
                        <div class="card-header row">
                            <a href="{{ route('master.masterfile.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Form</th>
                                        <th>No. Revisi</th>
                                        <th>Terbit</th>
                                        <th>Nama File</th>
                                        <th>Departemen</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach($masterfile as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->no_form}}</td>
                                        <td>{{$row->no_revisi}}</td>
                                        <td>{!! Helper::setDate($row->tgl_terbit) !!}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->dep}}</td>
                                        <td>{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                        <td>                                            
                                            <a href="{{ route('master.masterfile.edit', ['id' => $row->id]) }}" class=""><i class="btn btn-sm btn-info fas fa-cog"></i></a>

                                            @if(auth()->user()->dep == 'IT' || auth()->user()->dep == 'QA')
                                            <button class="btn btn-sm btn-danger btn-delete far fa-trash-alt" data-id="{{ $row->id }}"><i class=""></i></button>
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
            console.log(id);
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
                        url: "{{ route('master.masterfile.destroy') }}",
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