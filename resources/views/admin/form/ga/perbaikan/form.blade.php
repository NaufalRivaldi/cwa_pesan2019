@extends('admin.master')

@section('title', '- Perbaikan Sarana & Prasarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <h2>Form Perbaikan Sarana & Prasarana</h2>
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('form.ga.perbaikan') }}" class="btn btn-sm btn-success">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('form.ga.perbaikan.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" name="tglPengajuan" value="{{ $dateNow }}" class="form-control col-md-6" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Permintaan <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="permintaan" id="permintaan" rows="5" class="form-control"></textarea>
                                    <!-- error -->
                                    @if($errors->has('permintaan'))
                                        <div class="text-danger">
                                            {{ $errors->first('permintaan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alasan <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="alasan" id="alasan" rows="5" class="form-control"></textarea>
                                    <!-- error -->
                                    @if($errors->has('alasan'))
                                        <div class="text-danger">
                                            {{ $errors->first('alasan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm">Ajukan</button>
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
</script>
@endsection