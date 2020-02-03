@extends('admin.master')

@section('title', '- Penilaian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Pilih Penilaian</h2>
            <div class="page-breadcrumb">
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</div>

<!-- content -->

<div class="row justify-content-md-center">
    <div class="col-md-4 text-center">
        <div class="card text-center">
            <div class="card-header justify-content-center">
              <img src="{{asset('/img/user1.png')}}" class="card-img-top w-50" alt="...">
            </div>
            <div class="card-body">
                <p><b>Periode : </b><br>
                @if(!empty($periodeBestEmployee))
                  {{ $periodeBestEmployee->namaPeriode }}</p>
                  <p><span class="badge badge-success">{{ Helper::setDate($periodeBestEmployee->tglMulai).' - '.Helper::setDate($periodeBestEmployee->tglSelesai) }}</span></p>
                @else
                  <p><span class="badge badge-danger">Tidak ada periode!</span></p>
                @endif
                <a href="#" class="btn btn-primary btn-block btn-sm {{ (empty($periodeBestEmployee)) ? 'disabled' : '' }}" data-toggle="modal" data-target="#bestEmployee">Best Employee</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header justify-content-center">
              <img src="{{asset('/img/user1.png')}}" class="card-img-top w-50" alt="...">
            </div>
            <div class="card-body">
                <p><b>Periode Kepala Bagian Toko: </b><br>
                @if(!empty($periodeKabagToko))
                  {{ $periodeKabagToko->namaPeriode }}</p>
                  <p><span class="badge badge-success">{{ Helper::setDate($periodeKabagToko->tglMulai).' - '.Helper::setDate($periodeKabagToko->tglSelesai) }}</span></p>
                @else
                  <p><span class="badge badge-danger">Tidak ada periode!</span></p>
                @endif
                <hr>
                <p><b>Periode Kepala Bagian Office: </b><br>
                @if(!empty($periodeKabagOffice))
                  {{ $periodeKabagOffice->namaPeriode }}</p>
                  <p><span class="badge badge-success">{{ Helper::setDate($periodeKabagOffice->tglMulai).' - '.Helper::setDate($periodeKabagOffice->tglSelesai) }}</span></p>
                @else
                  <p><span class="badge badge-danger">Tidak ada periode!</span></p>
                @endif
                <a href="#" class="btn btn-primary btn-block btn-sm {{ (empty($periodeKabagToko) && empty($periodeKabagOffice)) ? 'disabled' : '' }}" data-toggle="modal" data-target="#kepalaBagian">Kepala Bagian</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header justify-content-center">
              <img src="{{asset('/img/user1.png')}}" class="card-img-top w-50" alt="...">
            </div>
            <div class="card-body">
                <p><b>Periode : </b><br>
                @if(!empty($periodeKepuasan))
                  {{ $periodeKepuasan->namaPeriode }}</p>
                  <p><span class="badge badge-success">{{ Helper::setDate($periodeKepuasan->tglMulai).' - '.Helper::setDate($periodeKepuasan->tglSelesai) }}</span></p>
                @else
                  <p><span class="badge badge-danger">Tidak ada periode!</span></p>
                @endif
                <a href="#" class="btn btn-primary btn-block btn-sm {{ (empty($periodeKepuasan)) ? 'disabled' : '' }}" data-toggle="modal" data-target="#suveiKepuasan">Survei Kepuasan Karyawan</a>
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