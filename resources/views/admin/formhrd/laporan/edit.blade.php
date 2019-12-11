@extends('admin.master')

@section('title', '- Edit Form HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Edit Form HRD</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('laporan') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.update') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $form->id }}">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                @foreach($kategori as $r)
                                    <input type="checkbox" name="kategori[]" value="{{ $r->id }}" data-value="{{ $r->nama_kategori }}" class="kategoriEdit{{ ($r->nama_kategori == 'Lembur') ? 'Lembur' : '' }}" {{ (in_array($r->id, Helper::setKategoriEdit($form->id))) ? 'checked' : '' }}> {{ $r->nama_kategori }}<br>
                                @endforeach
                                
                                <div class="show-lembur"></div>

                                <!-- error -->
                                @if($errors->has('kategori'))
                                    <div class="text-danger">
                                        {{ $errors->first('kategori') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="karyawanall_id" class="form-control" readonly>
                                    <option value="{{ $form->karyawan_all_id }}">{{ $form->karyawanAll->nama }}</option>
                                </select>
                                <!-- error -->
                                @if($errors->has('karyawanall_id'))
                                    <div class="text-danger">
                                        {{ $errors->first('karyawanall_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal & Waktu <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="date" name="tgl_a" class="form-control tgl_a" value="{{ date('Y-m-d', strtotime($form->tgl_a)) }}" required>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <input type="time" name="time_a" class="form-control" value="{{ date('H:i:s', strtotime($form->tgl_a)) }}" required>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        s/d
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="tgl_b" class="form-control tgl_b" value="{{ date('Y-m-d', strtotime($form->tgl_b)) }}">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <input type="time" name="time_b" class="form-control" value="{{ date('H:i:s', strtotime($form->tgl_b)) }}">
                                    </div>
                                </div>
                                <p class="text-danger">
                                    *tanggal pertama wajib diisi
                                </p>
                                <!-- error -->
                                @if($errors->has('tgl_a'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_a') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" id="mytextarea">{{ $form->keterangan }}</textarea>
                                <!-- error -->
                                @if($errors->has('keterangan'))
                                    <div class="text-danger">
                                        {{ $errors->first('keterangan') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Simpan Form" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            // tampil select lembur
            $('.kategoriEditLembur').click(function () {
                if (!$(this).is(':checked') && $(this).data('value') == 'Lembur') {
                    $('.show-lembur').empty();
                }else{
                    $('.show-lembur').append('<select name="lembur" class="form-control"><option value="1" {{ ($form->lembur == 1) ? "selected" : "" }}>Berbayar</option><option value="2" {{ ($form->lembur == 2) ? "selected" : "" }}>Tidak Berbayar</option></select>');
                }
            });

            if ($('.kategoriEditLembur').is(':checked') && $('.kategoriEditLembur').data('value') == 'Lembur') {
                $('.show-lembur').append('<select name="lembur" class="form-control"><option value="1" {{ ($form->lembur == 1) ? "selected" : "" }}>Berbayar</option><option value="2" {{ ($form->lembur == 2) ? "selected" : "" }}>Tidak Berbayar</option></select>');
            }
        });
    </script>
@endsection