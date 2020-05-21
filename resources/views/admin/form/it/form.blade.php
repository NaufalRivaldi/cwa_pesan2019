@extends('admin.master')

@section('title', '- Penanganan IT')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">                       
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Form Penanganan IT</li>
                        </ol>
                    </nav>
                </div>            
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-success"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penanganan.it.store') }}" method="POST">
                          {{ csrf_field() }}
                          <div class="row form-group">
                              <div class="col-md-3">
                                  <label>Kode<span class="text-danger">*</span></label>
                              </div>
                              <div class="col-md-9">
                                  <p>{{ $kode }}</p>
                                  <input type="hidden" name="kode" value="{{ $kode }}">
                              </div>
                          </div>

                          @if(auth()->user()->dep == 'IT')
                          <div class="row form-group">
                              <div class="col-md-3">
                                  <label>Divisi / Departemen</label>
                              </div>
                              <div class="col-md-9">
                                  <select name="cabang" class="form-control col-6">
                                      <option value="">Pilih</option>
                                      @foreach(Helper::depOffice() as $row)
                                      <option value="{{ $row }}">{{ $row }}</option>
                                      @endforeach

                                      @foreach($cabang as $row)
                                      <option value="{{ $row->inisial }}">{{ $row->inisial.' - '.$row->nama_cabang }}</option>
                                      @endforeach
                                  </select>

                                  <!-- error -->
                                  @if($errors->has('cabang'))
                                      <div class="text-danger">
                                          {{ $errors->first('cabang') }}
                                      </div>
                                  @endif
                              </div>
                          </div>
                          @else
                          <input type="hidden" name="cabang" value="{{ auth()->user()->dep }}">
                          @endif

                          <div class="row form-group">
                              <div class="col-md-3">
                                  <label>Permasalahan</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea name="masalah" rows="5" class="form-control"></textarea>

                                  <!-- error -->
                                  @if($errors->has('permasalahan'))
                                      <div class="text-danger">
                                          {{ $errors->first('permasalahan') }}
                                      </div>
                                  @endif
                              </div>
                          </div>

                          <div class="row form-group">
                              <div class="col-md-3">
                                  &nbsp;
                              </div>
                              <div class="col-md-9">
                                  <input type="submit" name="btn" class="btn btn-primary btn-sm" value="Ajukan">
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection