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
                          <a href="{{ route('master.prosedur.index') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form action="" method="POST">
                          {{ csrf_field() }}
                          @if(!empty($prosedur->id))
                              @method('PUT')
                              <input type="hidden" name="id" value="{{ $prosedur->id }}">
                          @endif
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Prosedur <span class="text-danger">*</span></label>
                              <div class="col-sm-10">
                                  <input type="text" name="nama" class="form-control" value="{{ $prosedur->nama }}" required>

                                  <!-- error -->
                                  @if($errors->has('nama'))
                                      <div class="text-danger">
                                          {{ $errors->first('nama') }}
                                      </div>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Departemen <span class="text-danger">*</span></label>
                              <div class="col-sm-10">
                                  <select name="departemenId" id="departemenId" class="form-control">
                                    <option value="">Pilih Departemen...</option>
                                    @foreach($departemen as $d)
                                      <option value="{{$d->id}}">{{$d->nama}}</option>
                                    @endforeach
                                  </select>
                                  <!-- error -->
                                  @if($errors->has('nama'))
                                      <div class="text-danger">
                                          {{ $errors->first('nama') }}
                                      </div>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">File <span class="text-danger">*</span></label>
                              <div class="col-sm-10">
                                  <input type="file" name="file" class="form-control" value="{{ $prosedur->file }}" required>
                                  <!-- error -->
                                  @if($errors->has('file'))
                                      <div class="text-danger">
                                          {{ $errors->first('file') }}
                                      </div>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" value="{{(empty($prosedur->id)?'Tambah':'Simpan')}}" class="btn btn-primary">
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