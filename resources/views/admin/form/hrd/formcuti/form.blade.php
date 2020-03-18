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
                        <div id="form-plus">
                            <div class="form-group row">
                                <label for="tglCuti" class="col-form-label col-sm-2">Tanggal Cuti</label>
                                <div class="input-group col-sm-10">
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

                        <input type="submit" value="Tambah" class="btn btn-primary float-right">
                        <input type="reset" value="Reset" class="btn btn-danger float-right mr-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    let maxCuti = 0;
    $('document').ready(function(){
        $('.karyawan').on('change', function(){
        var idKaryawanAll = $(this).val();
            $.ajax({
                url: '{{ route("form.hrd.cuti.formcuti.kategori")}}',
                data: "id="+idKaryawanAll,
                type: 'GET',              
                success: function(data) {
                    $('#kategoriCuti').empty();
                    $('#kategoriCuti').append(data);
                }              
            });
        });

        $('#kategoriCuti').on('change', function(){
            var idCuti = $(this).val();
            console.log(idCuti);
            $.ajax({
                url: '{{route("form.hrd.cuti.formcuti.maxCuti")}}',
                data: "id="+idCuti,
                type: 'GET',
                success: function(data){
                    maxCuti = data;
                    console.log(maxCuti);
                    if (maxCuti == 1) {
                        $('#plus').addClass('disabled');    
                    } else {
                        $('#plus').removeClass('disabled');
                    }
                    $('#tglCuti').removeAttr('disabled');
                    $('.keterangan').removeAttr('disabled');
                    console.log(maxCuti);
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
    }


    // click plus
    var i = 1;
    $('#plus').click(function (e) {
        e.preventDefault();
        $('#form-plus').append('<div id="row'+i+'"><div class="form-group row"><label for="tglCuti'+i+'" class="col-sm-2">Tanggal Cuti</label><div class="input-group col-sm-10"><input id="tglCuti" type="date" class="form-control" name="tanggalCuti[]" aria-describedby="plusAddon"><div class="input-group-append"><a href="#" class="btn btn-danger remove" id="'+i+'"> - </a></div></div></div><div class="form-group row"><label for="selectKaryawan" class="col-sm-2 col-form-label">Keterangan</label><div class="col-sm-10"><textarea name="keterangan[]" id="" cols="30" rows="5" class="form-control"></textarea></div></div></div>');
        i++;
        cekBatasCuti(maxCuti, i);
    });

    $(document).on('click', '.remove', function(e){
        e.preventDefault();
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        i--;
        cekBatasCuti(maxCuti, i);
    });
</script>
@endsection