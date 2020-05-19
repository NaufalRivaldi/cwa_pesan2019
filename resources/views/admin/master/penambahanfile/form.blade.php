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
                          <a href="{{ route('master.masterfile.index') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form action="{{ (empty($masterfile->id))?route('master.masterfile.store'):route('master.masterfile.update') }}" method="POST">
                          {{ csrf_field() }}
                          @if(!empty($masterfile->id))
                              @method('PUT')
                              <input type="hidden" name="id" value="{{ $masterfile->id }}">
                          @endif
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Form <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                              <input type="text" name="no_form" id="" class="form-control" value="{{$masterfile->no_form}}">
                              <!-- error -->
                              @if($errors->has('no_form'))
                                  <div class="text-danger">
                                      {{ $errors->first('no_form') }}
                                  </div>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Revisi <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                              <input type="text" name="no_revisi" id="" class="form-control" value="{{$masterfile->no_revisi}}">
                              <!-- error -->
                              @if($errors->has('no_revisi'))
                                  <div class="text-danger">
                                      {{ $errors->first('no_revisi') }}
                                  </div>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Terbit <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                              <input type="date" name="tgl_terbit" id="" class="form-control" value="{{$masterfile->tgl_terbit}}">
                              <!-- error -->
                              @if($errors->has('tgl_terbit'))
                                  <div class="text-danger">
                                      {{ $errors->first('tgl_terbit') }}
                                  </div>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama File <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                              <input type="text" name="nama" id="" class="form-control" value="{{$masterfile->nama}}">
                              <!-- error -->
                              @if($errors->has('nama'))
                                  <div class="text-danger">
                                      {{ $errors->first('nama') }}
                                  </div>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Departemen <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                              <select name="dep" id="" class="form-control">
                                <option value="">Pilih departemen...</option>
                                @foreach(Helper::allDep() as $row)
                                  <option value="{{ $row }}" {{($masterfile->id)?($masterfile->dep == $row)?'selected':'':''}} >{{ $row }}</option>
                                @endforeach
                              </select>
                              <!-- error -->
                              @if($errors->has('dep'))
                                  <div class="text-danger">
                                      {{ $errors->first('dep') }}
                                  </div>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kategori <span class="text-danger"></span></label>
                            <div class="col-sm-10">
                              <select name="kategori" id="" class="form-control">
                                <option value="">Pilih kategori...</option>
                                <option value="1" {{($masterfile->id)?($masterfile->kategori == 1)?'selected':'':''}} >Dokumen</option>
                                <option value="2" {{($masterfile->id)?($masterfile->kategori == 2)?'selected':'':''}}>Form</option>
                              </select>
                              <!-- error -->
                              @if($errors->has('kategori'))
                                  <div class="text-danger">
                                      {{ $errors->first('kategori') }}
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
                        url: "",
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