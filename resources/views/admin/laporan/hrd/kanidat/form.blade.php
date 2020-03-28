@extends('admin.master')

@section('title', '- Hasil Poling')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Hasil Poling</h2> -->
            <div class="page-breadcrumb">
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Hasil Poling</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">    
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Data Hasil Poling</li>
                </ol>
            </nav>
        </div>

        <div class="card">
          <div class="card-header">
            <a href="{{ route('laporan.hrd.hasilpoling') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
          </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <form action="{{ route('pkk.kanidat.update') }}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id" value="{{ $kanidat->id }}">

                  <div class="form-group">
                    <label for="karyawanId">Nama Karyawan</label>
                    <select name="karyawanId" id="karyawanId" class="form-control" readonly>
                      <option value="{{ $kanidat->karyawanId }}">{{ $kanidat->karyawan->nama }}</option>
                    </select>
                    <small class="form-text text-muted">Data tidak dapat dirubah.</small>
                  </div>

                  <div class="form-group">
                    <label for="periodeId">Periode</label>
                    <select name="periodeId" id="periodeId" class="form-control" readonly>
                      <option value="{{ $kanidat->periodeId }}">{{ $kanidat->periode->namaPeriode }}</option>
                    </select>
                    <small class="form-text text-muted">Data tidak dapat dirubah.</small>
                  </div>

                  <div class="form-group">
                    <label for="poin">Skor</label>
                    <input type="number" name="poin" value="{{ $kanidat->poin }}" class="form-control" readonly>
                    <small class="form-text text-muted">Data tidak dapat dirubah.</small>
                  </div>

                  <div class="form-group">
                    <label for="t">Terlambat</label>
                    <input type="number" name="t" value="{{ $kanidat->t }}" class="form-control">

                    <!-- error -->
                    @if($errors->has('t'))
                        <small class="text-danger">
                            {{ $errors->first('t') }}
                        </small>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="ip">Ijin pulang / keluar</label>
                    <input type="number" name="ip" value="{{ $kanidat->ip }}" class="form-control">

                    <!-- error -->
                    @if($errors->has('ip'))
                        <small class="text-danger">
                            {{ $errors->first('ip') }}
                        </small>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="ik">Ijin tidak masuk kerja</label>
                    <input type="number" name="ik" value="{{ $kanidat->ik }}" class="form-control">

                    <!-- error -->
                    @if($errors->has('ik'))
                        <small class="text-danger">
                            {{ $errors->first('ik') }}
                        </small>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="p">Pelanggaran</label>
                    <input type="number" name="p" value="{{ $kanidat->p }}" class="form-control">

                    <!-- error -->
                    @if($errors->has('p'))
                        <small class="text-danger">
                            {{ $errors->first('p') }}
                        </small>
                    @endif
                  </div>

                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection