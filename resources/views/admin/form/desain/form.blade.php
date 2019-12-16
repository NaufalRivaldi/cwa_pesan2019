@extends('admin.master')

@section('title', '- Pengajuan Desain')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Form Pengajuan Desain & Iklan</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('desainIklan.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="jenisDesain">Jenis Desain</label>
                                <div class="form-check">
                                    @foreach($jenis_desain as $row)
                                        <input type="radio" value="{{ $row->id }}" name="jenis_desain_id" class="jenisDesain">{{ $row->nama }} <span class="mr-3"></span>
                                    @endforeach

                                    <div class="lainnya showForm">
                                        <br>
                                        <label for="keterangan_lain">Keterangan Lainnya</label>
                                        <input type="text" class="form-control" id="keterangan_lain" name="keterangan_lain">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_perlu">Tanggal Diperlukan</label>
                                        <input type="date" class="form-control" id="tgl_perlu" name="tgl_perlu">
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Qty / Jumlah</label>
                                        <input type="number" class="form-control" id="qty" name="qty">
                                    </div>
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran Cetak</label>
                                        <input type="text" class="form-control" id="ukuran" name="ukuran">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="8" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Ajukan</button>
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