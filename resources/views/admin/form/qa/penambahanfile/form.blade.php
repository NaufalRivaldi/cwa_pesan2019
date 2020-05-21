@extends('admin.master')

@section('title', '- Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ url()->previous() }}"><li class="breadcrumb-item" aria-current="page">Usulan Copy Dokumen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.qa.penambahanfile.index') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                  <h2 class="text-center">FORM USULAN COPY DOKUMEN - FORMULIR</h2>
                  <hr>
                  <form action="{{ route('form.qa.penambahanfile.store') }}" method="POST">
                    @csrf          
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Kode Form<span class="text-danger"></span></label>
                      <label class="col-sm-3 col-form-label">{{$kodeForm}}</label>
                      <div class="col-sm-8">
                          <input type="hidden" name="kode" value="{{$kodeForm}}" class="form-control col-md-6" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="selectPembuat">Pembuat <span class="text-danger">*</span></label>
                      <select name="karyawanId" id="selectPembuat" class="form-control" required>
                        <option value="">Pilih Pembuat...</option>
                        @foreach($pembuat as $row)
                        <option value="{{$row->id}}">{{$row->nama}}</option>
                        @endforeach
                      </select>                      
                      @if($errors->has('karyawanId'))
                          <div class="text-danger">
                              {{ $errors->first('karyawanId') }}
                          </div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori</label>
                      <div class="form-check">                      
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="inlineRadio1" value="1" required>
                          <label class="form-check-label" for="inlineRadio1">Dokumen</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="kategori" id="inlineRadio2" value="2" required>
                          <label class="form-check-label" for="inlineRadio2">Form</label>
                        </div>                                              
                      @if($errors->has('kategori'))
                        <div class="text-danger">
                            {{ $errors->first('kategori') }}
                        </div>
                      @endif
                      </div>
                    </div>
                    <div id="form-plus">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="selectDocumentId">Pilih <span class="text-danger">*</span></label>
                          <select name="dokumenId[]" id="selectDocumentId" class="form-control" required>
                            <option value="">Pilih Form/Dokumen</option>
                          </select>                                              
                          @if($errors->has('dokumenId'))
                            <div class="text-danger">
                                {{ $errors->first('dokumenId') }}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label for="selectPembuat">Jumlah</label>
                          <input type="number" name="qty[]" id="" class="form-control" required>
                          @if($errors->has('qty'))
                            <div class="text-danger">
                                {{ $errors->first('qty') }}
                            </div>
                          @endif
                        </div>
                      </div>                      
                      <div class="col-sm-1">
                        <label for="" style="color:white">asd</label>
                        <button class="btn btn-success" id="plus">
                          <li class="fa fa-plus-circle"></li>
                        </button>
                      </div>
                    </div>
                    </div>                    
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="selectPembuat">Keterangan</label>
                          <textarea name="keterangan" id="" cols="30" rows="5" class="form-control"></textarea>
                          @if($errors->has('keterangan'))
                            <div class="text-danger">
                                {{ $errors->first('keterangan') }}
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Ajukan</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    var i = 1;
    $('document').ready(function(){
        $('.form-check-input').on('click', function(){
            var id = $(this).val();
            console.log(id);
            $.ajax({
                url: '{{ route("form.qa.penambahanfile.formDoc") }}',
                data: "id="+id,
                type: 'GET',
                success: function(data){           
                  $('.detailForm').remove();       
                  $('#selectDocumentId').empty();
                  $('#selectDocumentId').append(data);
                }
            });
        });

    });


    // click plus
    $('#plus').click(function (e) {
        e.preventDefault();
        $('#form-plus').append('<div id="row'+i+'" class="detailForm"><div class="row"><div class="col-sm-6"><div class="form-group"><label for="selectDocumentId">Pilih <span class="text-danger">*</span></label><select name="dokumenId[]" id="selectDocumentId'+i+'" class="form-control"><option value="">Pilih Form/Dokumen</option></select></div></div><div class="col-sm-5"><div class="form-group"><label for="selectPembuat">Jumlah</label><input type="number" name="qty[]" id="" class="form-control"></div></div><div class="col-sm-1"><label for="" style="color:white">asd</label><button class="btn btn-danger remove" id="'+i+'"><li class="fa fa-minus-circle"></li></button></div></div></div></div>');
        var id = $('input[name="kategori"]:checked').val();
        console.log(id)
        $.ajax({
            url: '{{ route("form.qa.penambahanfile.formDoc") }}',
            data: "id="+id,
            type: 'GET',
            success: function(data){                        
              $('#selectDocumentId'+i).empty();
              $('#selectDocumentId'+i).append(data);
              i++;
            }
        });
    });

    $(document).on('click', '.remove', function(e){
        e.preventDefault();
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        i--;

    });
</script>
@endsection