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
                    <a href="{{ route('form.hrd.cuti') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{route('form.hrd.cuti.add')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="">
                        
                        <div class="form-group row">
                            <label for="selectKaryawan" class="col-sm-2 col-form-label">Karyawan</label>
                            <div class="col-sm-10">
                                <select class="form-control karyawan" id="selectKaryawan" name="idKaryawanAll">
                                <option value="">Pilih Karyawan...</option>
                                @foreach($karyawan as $k)
                                <option value="{{$k->id}}">{{$k->nama}}</option>
                                @endforeach
                                </select>                  
                                @if($errors->has('idKaryawanAll'))
                                <div class="text-danger">
                                    {{ $errors->first('idKaryawanAll') }}
                                </div>
                                @endif
                                <div class="valid-feedback">
                                    Karyawan sudah memiliki cuti.
                                </div>
                                <div class="invalid-feedback">
                                    Karyawan belum memiliki cuti.
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="selectKategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-control kategori" id="selectKategori" name="idKategori" readonly>
                                <option value="">Pilih Kategori...</option>
                                @foreach($kategori as $k)
                                <option value="{{$k->id}}">{{$k->kategori}}</option>
                                @endforeach
                                </select>                         
                                @if($errors->has('idKategori'))
                                <div class="text-danger">
                                    {{ $errors->first('idKategori') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCuti" class="col-sm-2 col-form-label">Cuti</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control cuti" id="inputCuti" name="cuti" value="" readonly>                           
                            @if($errors->has('cuti'))
                            <div class="text-danger">
                                {{ $errors->first('cuti') }}
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSisaCuti" class="col-sm-2 col-form-label">Sisa Cuti</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control sisaCuti" id="inputSisaCuti" name="sisaCuti" value="" readonly>                           
                            @if($errors->has('sisaCuti'))
                            <div class="text-danger">
                                {{ $errors->first('sisaCuti') }}
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPeriode" class="col-sm-2 col-form-label">Periode</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control periode" id="inputPeriode" name="periode" value="" readonly>                           
                            @if($errors->has('periode'))
                            <div class="text-danger">
                                {{ $errors->first('periode') }}
                            </div>
                            @endif
                            </div>
                        </div>
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
    $('document').ready(function(){

        $('.karyawan').on('change', function(){
        var karyawanId = $(this).val();
            $.ajax({
                url: '{{ route("form.hrd.cuti.cekKaryawan")}}',
                data: "id="+karyawanId,
                type: 'GET',              
                success: function(data) {
                    console.log(data);
                    if (data.y >= 1) {
                        $('.kategori').attr('readonly', false);
                        $('.kategori').val('');
                        $('.cuti').val('');
                        $('.sisaCuti').val('');
                        $('.periode').val('');
                        $('.karyawan').addClass('is-valid');            
                        $('.karyawan').removeClass('is-invalid');
                    } else {
                        $('.kategori').attr('readonly', true);
                        $('.kategori').val('');
                        $('.cuti').val('');
                        $('.sisaCuti').val('');
                        $('.periode').val('');
                        $('.karyawan').removeClass('is-valid');
                        $('.karyawan').addClass('is-invalid');
                    }
                }              
            });
        });
        
        $('.kategori').on('change', function(){
          var kategoriId = $(this).val();
          var dt = new Date();
          console.log(kategoriId);
          $.ajax({
              url: '{{ route("form.hrd.cuti.fillCuti")}}',
              data: "id="+kategoriId,
              type: 'GET',              
              success: function(data) {
                $('.cuti').val(data.jumlahCuti);
                $('.sisaCuti').val(data.jumlahCuti)
                $('.periode').val(dt.getFullYear());
            }              
          });
        });

        // $('.kategori').on('change', function(){
        // var kategoriId = $(this).val('.karyawanId');
        // var dt = new Date();
        // console.log(kategoriId);
        //     $.ajax({
        //         url: '{{ route("form.hrd.cuti.cekBulan")}}',
        //         data: "id="+kategoriId,
        //         type: 'GET',              
        //         success: function(data) {
        //             console.log(data);
        //         }              
        //     });
        // });

    });
</script>
@endsection