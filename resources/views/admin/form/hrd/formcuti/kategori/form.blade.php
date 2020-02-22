@extends('admin.master')

@section('title', '- Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ url()->previous() }}"><li class="breadcrumb-item" aria-current="page">Kategori Cuti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.hrd.cuti.kategori') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{($kategoriCuti->id)?route('form.hrd.cuti.kategori.update'):route('form.hrd.cuti.kategori.add')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$kategoriCuti->id}}">
                        <div class="form-group row">
                            <label for="kategoriCuti" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategoriCuti" name="kategori" value="{{$kategoriCuti->kategori}}">                            
                            @if($errors->has('kategori'))
                            <div class="text-danger">
                                {{ $errors->first('kategori') }}
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputJumlahCuti" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputJumlahCuti" name="jumlahCuti" value="{{$kategoriCuti->jumlahCuti}}">                           
                            @if($errors->has('jumlahCuti'))
                            <div class="text-danger">
                                {{ $errors->first('jumlahCuti') }}
                            </div>
                            @endif
                            </div>
                        </div>
                        <input type="submit" value="{{($kategoriCuti->id)?'Simpan':'Tambah'}}" class="btn btn-primary float-right">
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
        
    });
</script>
@endsection