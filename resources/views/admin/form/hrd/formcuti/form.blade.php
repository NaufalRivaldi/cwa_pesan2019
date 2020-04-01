@extends('admin.master')

@section('title', '- Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ url()->previous() }}"><li class="breadcrumb-item" aria-current="page">Cuti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.hrd.cuti.formcuti') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('form.hrd.cuti.formcuti.add') }}" method="POST">
                        @csrf                     
                        <div class="form-group row">
                            <label for="selectKaryawan" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <select class="form-control karyawan" id="selectKaryawan" name="karyawanId">
                                <option value="">Pilih Karyawan...</option>
                                @foreach($cuti as $c)
                                <option value="{{$c->karyawan->id}}">{{$c->karyawan->nama}}</option>
                                @endforeach
                                </select>                         
                                @if($errors->has('karyawanId'))
                                <div class="text-danger">
                                    {{ $errors->first('karyawanId') }}
                                </div>
                                @endif
                            </div>
                        </div>  
                                                                 
                        <div class="form-group row">
                            <label for="periodeCuti" class="col-sm-2 col-form-label">Periode</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="periodeCuti" name="">
                                </select>                         
                                @if($errors->has(''))
                                <div class="text-danger">
                                    {{ $errors->first('') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="kategoriCuti" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kategoriCuti" name="idCuti">
                                </select>                         
                                @if($errors->has('idCuti'))
                                <div class="text-danger">
                                    {{ $errors->first('idCuti') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="tglCuti" class="col-form-label col-sm-2">Sisa Cuti</label>
                            <div class="col-sm-10">                                        
                                <input id="sisaCuti" type="text" class="form-control" name="" value="" readonly>                                         
                                @if($errors->has('sisaCuti'))
                                <div class="text-danger">
                                    {{ $errors->first('sisaCuti') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div id="form-plus">
                            <div class="form-group row">
                                <label for="tglCuti" class="col-form-label col-sm-2">Tanggal Cuti</label>
                                <div class="col-sm-10"> 
                                    <div class="input-group">                                       
                                        <input id="tglCuti" type="date" class="form-control" name="tanggalCuti[]" aria-describedby="plusAddon" value="" disabled>
                                        <div class="input-group-append">
                                            <a href="#" id="plus" class="btn btn-success disabled">+</a>
                                        </div>  
                                    </div>                                                                                      
                                    @if($errors->has('tanggalCuti'))
                                    <div class="text-danger">
                                        {{ $errors->first('tanggalCuti') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan[]" id="" cols="30" rows="5" class="form-control keterangan" required disabled></textarea>                        
                                    @if($errors->has('keterangan'))
                                    <div class="text-danger">
                                        {{ $errors->first('keterangan') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>                     
                        <!-- <div id="form-keterangan"> -->
                        <!-- </div> -->

                        <input type="submit" value="Ajukan" class="btn btn-primary float-right">
                        <!-- <input type="reset" value="Reset" class="btn btn-danger float-right mr-2"> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    let maxCuti = 0;
    var i = 1;
    $('document').ready(function(){
        let idKaryawanAll = '0';
        $('.karyawan').on('change', function(){
        idKaryawanAll = $(this).val();
            $.ajax({
                url: '{{ route("form.hrd.cuti.formcuti.periode")}}',
                data: "id="+idKaryawanAll,
                type: 'GET',              
                success: function(data) {
                    $('#periodeCuti').empty();
                    $('#periodeCuti').append(data);
                }              
            });
        });

        $('#periodeCuti').on('change', function(){
        var periode = $(this).val();      
        console.log(periode);
            $.ajax({
                url: '{{ route("form.hrd.cuti.formcuti.kategori")}}',
                data: {
                    'id': periode,
                    'karyawanId': idKaryawanAll
                },
                type: 'GET',              
                success: function(data) {
                    console.log(data);
                    $('.cutiKeterangan').remove();
                    $('#kategoriCuti').empty();
                    $('#plus').addClass('disabled');
                    $('#tglCuti').attr('disabled', 'disabled');
                    $('.keterangan').attr('disabled', 'disabled');
                    $('#sisaCuti').val('');
                    $('#kategoriCuti').append(data);

                    i = 1;
                    console.log("i waktu pilih periode : "+i);
                }              
            });
        });

        $('#kategoriCuti').on('change', function(){
            var idCuti = $(this).val();
            $.ajax({
                url: '{{route("form.hrd.cuti.formcuti.maxCuti")}}',
                data: "id="+idCuti,
                type: 'GET',
                success: function(data){
                    console.log(data);
                    $('.cutiKeterangan').remove();
                    maxCuti = data.nilaiMax;
                    if (maxCuti == 1) {
                        $('#plus').addClass('disabled');    
                    } else {
                        $('#plus').removeClass('disabled');
                    }
                    $('#tglCuti').removeAttr('disabled');
                    $('.keterangan').removeAttr('disabled');
                    $('#sisaCuti').val(data.sisaCuti);
                    i = 1;
                    console.log("i waktu pilih kategori : "+i);
                }
            });
        });

    });

    function cekBatasCuti(maxCuti, i) {
        if (i == maxCuti) {
            $('#plus').addClass('disabled');
        } else {
            $('#plus').removeClass('disabled');
        }        
        console.log("i waktu pilih cek Batas Cuti : "+i);
    }


    // click plus
    $('#plus').click(function (e) {
        e.preventDefault();
        $('#form-plus').append('<div id="row'+i+'" class="cutiKeterangan"><div class="form-group row"><label for="tglCuti'+i+'" class="col-sm-2">Tanggal Cuti</label><div class="input-group col-sm-10"><input id="tglCuti" type="date" class="form-control" name="tanggalCuti[]" aria-describedby="plusAddon"><div class="input-group-append"><a href="#" class="btn btn-danger remove" id="'+i+'"> - </a></div></div></div><div class="form-group row"><label for="selectKaryawan" class="col-sm-2 col-form-label">Keterangan</label><div class="col-sm-10"><textarea name="keterangan[]" id="" cols="30" rows="5" class="form-control"></textarea></div></div></div>');
        i++;
        cekBatasCuti(maxCuti, i);
        console.log("i waktu tambah tanggal : "+i);
    });

    $(document).on('click', '.remove', function(e){
        e.preventDefault();
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        i--;
        cekBatasCuti(maxCuti, i);
        console.log("i waktu ngurangin tanggal : "+i);
    });
</script>
@endsection