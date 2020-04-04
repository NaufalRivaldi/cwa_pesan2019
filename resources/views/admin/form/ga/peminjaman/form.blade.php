@extends('admin.master')

@section('title', '- Perbaikan Sarana & Prasarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">            
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a href="{{route('form.ga.peminjaman')}}"><li class="breadcrumb-item" aria-current="page">Form Peminajamn Sarana & Prasarana</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('form.ga.peminjaman') }}" class="btn btn-sm btn-success"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                    <div class="display-4 mb-3" style="font-size: 3em">
                        Form Peminjaman
                    </div>
                        <form method="POST" action="{{ route('form.ga.peminjaman.store') }}">
                            @csrf                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode<span class="text-danger">*</span></label>
                                <label class="col-sm-5 col-form-label">{{$kodeForm}}</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="kode" value="{{$kodeForm}}" class="form-control col-md-6" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Pengajuan<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="date" name="tglPengajuan" value="{{ $dateNow }}" class="form-control col-md-6" readonly>
                                </div>
                            </div>
                            <hr>
                            <div id="formPlus">
                            <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="">Tanggal Pinjam:</label>
                                        <input type="date" name="tglPengajuan[]" value="" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Dari:</label>
                                        <input type="time" name="pukulA[]" value="" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Sampai:</label>
                                        <input type="time" name="pukulB[]" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Sarana:</label>
                                        <select name="saranaId[]" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach($sarana as $row)
                                                <option value="{{ $row->id }}">{{ $row->namaSarana }}</option>
                                            @endforeach
                                        </select>
                                        <!-- error -->
                                        @if($errors->has('saranaId'))
                                            <div class="text-danger">
                                                {{ $errors->first('saranaId') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-1">
                                        <label for="" style="color:white">asd</label>
                                        <button class="btn btn-success" id="plus">
                                            <li class="fa fa-plus-circle"></li>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="keterangan[]" id="keterangan" rows="5" class="form-control"></textarea>
                                        <!-- error -->
                                        @if($errors->has('keterangan'))
                                            <div class="text-danger">
                                                {{ $errors->first('keterangan') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary">
                                        Ajukan
                                    </button>
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
        $('.jenisDesain').on('click', function(){
            var val = $(this).val();

            if(val == '4'){
                $('.lainnya').removeClass('showForm');
            }else{
                $('.lainnya').addClass('showForm');
            }
        });
    });

    // click plus
    var i = 1;
    $('#plus').click(function (e) {
        e.preventDefault();
        $('#formPlus').append('<div id="row'+i+'"><div class="form-group row"><div class="col-md-3"><label for="">Tanggal Pinjam:</label><input type="date" name="tglPengajuan[]" value="" class="form-control"></div><div class="col-md-2"><label for="">Dari:</label><input type="time" name="pukulA[]" value="" class="form-control"></div><div class="col-md-2"><label for="">Sampai:</label><input type="time" name="pukulB[]" value="" class="form-control"></div><div class="col-md-4"><label for="">Sarana:</label><select name="saranaId[]" class="form-control"><option value="">Pilih</option>@foreach($sarana as $row)<option value="{{ $row->id }}">{{ $row->namaSarana }}</option>@endforeach</select>@if($errors->has("saranaId"))<div class="text-danger">{{ $errors->first("saranaId") }}</div>@endif</div><div class="col-md-1"><label for="" style="color:white">asd</label><a href="#" class="btn btn-danger remove" id="'+i+'"><i class="fas fa-minus-circle"></i></a></div></div><div class="row"><div class="col-md-12"><textarea name="keterangan[]" id="keterangan" rows="5" class="form-control"></textarea><!-- error -->@if($errors->has("keterangan"))<div class="text-danger">{{ $errors->first("keterangan") }}</div>@endif</div></div></div>');

        i++;
    });

    $(document).on('click', '.remove', function(e){
        e.preventDefault();
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();

        cekBobot();
    });
</script>
@endsection