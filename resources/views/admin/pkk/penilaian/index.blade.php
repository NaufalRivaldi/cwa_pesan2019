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

<div class="row">
    <div class="col-md-12">
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm">
                <div class="card-border text-center" style="width: 18rem;">
                <img src="{{asset('/img/user1.png')}}" class="card-img-top w-50" alt="...">
                    <div class="card-body">
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#bestEmployee">Best Employee</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card-border text-center" style="width: 18rem;">
                <img src="{{asset('/img/user1.png')}}" class="card-img-top w-50" alt="...">
                    <div class="card-body">
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#kepalaBagian">Kepala Bagian</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card-border text-center" style="width: 18rem;">
                <img src="{{asset('/img/user1.png')}}" class="card-img-top w-50 " alt="...">
                    <div class="card-body">
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#suveiKepuasan">Survei Kepuasan Karyawan</a>
                    </div>
                </div>
            </div>
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
      <div class="form-group row justify-content-md-center">
        <label for="polingBestEmployee" class="col-sm-1 col-form-label">NIK</label>
        <div class="col-sm-10">
            <input onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" class="form-control" id="polingBestEmployee" name="karyawanId" value="" placeholder=""  maxlength="9" autofocus>                        
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
        <button type="button" class="btn btn-primary">Poling</button>
      </div>
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
      <div class="form-group row justify-content-md-center">
        <label for="kepalaBagian" class="col-sm-1 col-form-label">NIK</label>
        <div class="col-sm-10">
            <input onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" class="form-control" id="kepalaBagian" name="karyawanId" value="" placeholder="" maxlength="9" autofocus>                        
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
        <button type="button" class="btn btn-primary">Nilai</button>
      </div>
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