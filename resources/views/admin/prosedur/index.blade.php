@extends('admin.master')

@section('title', '- Prosedur Global')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Prosedur Global</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="container">
                        <div class="card-header row">
                            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                            @if(empty(session('nik')))
                            <a href="#" class="btn btn-info btn-sm ml-2 btn-all"><i class="fas fa-eye"></i> Lihat Semua Prosedur</a>
                            @endif
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
                                        <a href="{{ route('prosedur.view', ['id' => $p->id]) }}" class=""><i class="btn btn-sm btn-info fas fa-eye"></i></a>
                                        @if(auth()->user()->dep =='QA')
                                          <a href="{{ asset('file-prosedur/'.$p->file) }}" class="btn btn-success btn-sm fas fa-download" download="{{strtolower(str_replace(' ', '_', $p->nama))}}"></a>
                                        
                                          <a href="{{ route('master.prosedur.edit', ['id' => $p->id]) }}" class=""><i class="btn btn-sm btn-info fas fa-cog"></i></a>

                                          <button class="btn btn-sm btn-danger btn-delete far fa-trash-alt" data-id="{{ $p->id }}"><i class=""></i></button>
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
<div class="modal fade" id="modal-semua-prosedur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Verifikasi</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('prosedur.login') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="form_qa_id" class="form-control form_qa_id">
                    <input type="hidden" name="form_qa_type" class="form-control form_qa_type">
                    <div class="form-group">
                        <label>NIK</label>
                        <input onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" name="nik" class="form-control" maxlength="9" placeholder="xxxx.xxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-danger">* Masukkan nik dan password kepala bagian untuk melihat semua prosedur. </p>
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

    $(document).on('click', '.btn-all', function(){
        $('#modal-semua-prosedur').modal('show');
    });

    function convertToMin(objek) {
        separator = ".";
        a = objek.value;
        b = a.replace(/[^\d]/g, "");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 4) == 1) && (j != 1)) {
                c = b.substr(i - 1, 1) + separator + c;
            } else {
                c = b.substr(i - 1, 1) + c;
            }
        }
        objek.value = c;
    }

    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endsection