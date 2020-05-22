@extends('admin.master')

@section('title', '- Master Departemen')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Master Departemen</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="container">
                        <div class="card-header row">
                          <a href="{{ route('master.departemen.index') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form action="{{ (empty($departemen->id))?route('master.departemen.store'):route('master.departemen.update') }}" method="POST">
                          {{ csrf_field() }}
                          @if(!empty($departemen->id))
                              @method('PUT')
                              <input type="hidden" name="id" value="{{ $departemen->id }}">
                          @endif

                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Departemen <span class="text-danger">*</span></label>
                              <div class="col-sm-10">
                                  <input type="text" name="nama" class="form-control" value="{{ $departemen->nama }}" required>

                                  <!-- error -->
                                  @if($errors->has('nama'))
                                      <div class="text-danger">
                                          {{ $errors->first('nama') }}
                                      </div>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" value="{{(empty($departemen->id)?'Tambah':'Simpan')}}" class="btn btn-primary">
                              </div>
                          </div>
                      </form>
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