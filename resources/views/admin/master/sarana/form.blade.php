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
                          <a href="{{ route('master.sarana.index') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form action="{{ (empty($sarana->id))? route('master.sarana.store') : route('master.sarana.update') }}" method="POST">
                          {{ csrf_field() }}
                          @if(!empty($sarana->id))
                              @method('PUT')
                              <input type="hidden" name="id" value="{{ $sarana->id }}">
                          @endif

                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Sarana <span class="text-danger">*</span></label>
                              <div class="col-sm-10">
                                  <input type="text" name="namaSarana" class="form-control" value="{{ $sarana->namaSarana }}" required>

                                  <!-- error -->
                                  @if($errors->has('namaSarana'))
                                      <div class="text-danger">
                                          {{ $errors->first('namaSarana') }}
                                      </div>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" value="Simpan" class="btn btn-primary">
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