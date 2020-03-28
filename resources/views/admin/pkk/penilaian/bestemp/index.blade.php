@extends('admin.master')

@section('title', '- Penilaian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Penilaian</li>
                        <li class="breadcrumb-item active" aria-current="page">Kandidat Best Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- content -->

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-user text-primary"></i> Verifikasi Kepala Bagian
      </div>
      <div class="card-body">
        <form action="{{ route('pkk.bestemp.validasi') }}" method="POST">
          @csrf
          <input type="hidden" name="periodeId" value="{{ $periode->id }}">
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" aria-describedby="nikText" placeholder="xxxx.xxxx" onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" maxlength="9" autofocus required>
            <small id="nikText" class="form-text text-muted">Masukkan nik anda.</small>

            @if($errors->has('nik'))
                <small class="text-danger text-muted">
                    {{ $errors->first('nik') }}
                </small>
            @endif
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="*******" required>

            @if($errors->has('password'))
                <small class="text-danger text-muted">
                    {{ $errors->first('password') }}
                </small>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Verifikasi</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="bestEmployee" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Poling Kandidat Best Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('pkk.penilaian.poling')}}" method="post">
        @csrf      
        <div class="form-group row justify-content-md-center">
          <label for="polingBestEmployee" class="col-sm-1 col-form-label">NIK</label>
          <div class="col-sm-10">
              <input onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" class="form-control" id="polingBestEmployee" name="nik" value="" placeholder=""  maxlength="9" autofocus>                        
              @if($errors->has('karyawanId'))
                  <div class="text-danger">
                      {{ $errors->first('karyawanId') }}
                  </div>
              @endif
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Poling</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="kepalaBagian" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Penilaian Kepala Bagian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('pkk.penilaian.kabag') }}" method="GET">
        <div class="form-group row justify-content-md-center">
          <label for="kepalaBagian" class="col-sm-1 col-form-label">NIK</label>
          <div class="col-sm-10">
              <input onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" class="form-control" id="kepalaBagian" name="nik" value="" placeholder="" maxlength="9" autofocus>                        
              @if($errors->has('karyawanId'))
                  <div class="text-danger">
                      {{ $errors->first('karyawanId') }}
                  </div>
              @endif
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Nilai</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="suveiKepuasan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row justify-content-md-center">
        <label for="namaPeriode" class="col-sm-1 col-form-label">NIK</label>
        <div class="col-sm-10">
            <input  onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" class="form-control" id="namaPeriode" name="namaPeriode" value="" placeholder="" maxlength="9" autofocus>                        
            @if($errors->has('namaPeriode'))
                <div class="text-danger">
                    {{ $errors->first('namaPeriode') }}
                </div>
            @endif
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Nilai</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  });
  function convertToMin(objek) {
      separator = ".";
      a = objek.value;
      b = a.replace(/[^\d]/g, "");
      c = "";
      panjang = b.length;
      j = 0;
      for (i = panjang; i > 0; i--) {
          j = j + 1;
          if (((j % 4) == 1) && (j != 1)) {
              c = b.substr(i - 1, 1) + separator + c;
          } else {
              c = b.substr(i - 1, 1) + c;
          }
      }
      objek.value = c;
  }

  function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
	}
</script>

@endsection