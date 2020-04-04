@extends('admin.master')

@section('title', '- Pengajuan Desain')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('desainIklan')}}"><li class="breadcrumb-item" aria-current="page">Form Pengajuan Desain</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
                <div class="card">
                    <div class="card-body">
                    <div class="display-4 mb-3">
                    Form Pengajuan
                    </div>
                        <form method="POST" action="{{ route('desainIklan.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Kode<span class="text-danger">*</span></label>
                                <p>{{ $kode }}</p>
                                <input type="hidden" name="kode" value="{{ $kode }}">
                            </div>
                            <div class="form-group">
                                <label>Pembuat <span class="text-danger">*</span></label>
                                <select name="karyawan_all_id" class="form-control">
                                    <option value="">Pilih Pembuat</option>
                                        @foreach($karyawan as $r)
                                            <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                        @endforeach
                                </select>

                                <!-- error -->
                                @if($errors->has('karyawan_all_id'))
                                    <div class="text-danger">
                                        {{ $errors->first('karyawan_all_id') }}
                                    </div>
                                @endif
                            </div>
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

                                        <!-- error -->
                                    @if($errors->has('jenis_desain_id'))
                                        <div class="text-danger">
                                            {{ $errors->first('jenis_desain_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_perlu">Tanggal Diperlukan</label>
                                        <input type="date" class="form-control" id="tgl_perlu" name="tgl_perlu" min="{{ $tglPengerjaan }}">
                                        <small class="text-info">*Waktu pengerjaan desain minimal 3 hari.</small>

                                        <!-- error -->
                                        @if($errors->has('tgl_perlu'))
                                            <div class="text-danger">
                                                {{ $errors->first('tgl_perlu') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Qty / Jumlah</label>
                                        <input type="number" class="form-control" id="qty" name="qty">

                                        <!-- error -->
                                        @if($errors->has('qty'))
                                            <div class="text-danger">
                                                {{ $errors->first('qty') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran Cetak</label>
                                        <input type="text" class="form-control" id="ukuran" name="ukuran">

                                        <!-- error -->
                                        @if($errors->has('ukuran'))
                                            <div class="text-danger">
                                                {{ $errors->first('ukuran') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="9" class="form-control"></textarea>
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