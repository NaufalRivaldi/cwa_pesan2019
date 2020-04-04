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
  <div class="col-md-12">
    <div class="alert alert-warning" role="alert">
      <h4 class="alert-heading">Note</h4>
      <p>Setiap kepala bagian diharuskan memberikan penilaian kepada kandidat best employee dari departemen lain dengan skala nilai 1-10.</p>
    </div>
  </div>
</div>

<form action="{{ route('pkk.bestemp.store') }}" method="POST">
@csrf
<div class="row">
  @foreach($kanidat as $data)
  <input type="hidden" name="karyawanId[]" value="{{ $data->karyawanId }}">
  <input type="hidden" name="periodeId[]" value="{{ $data->periodeId }}">

  <div class="col-md-6">
    <div class="card mb-2">
      <div class="card-header font-weight-bold"><i class="fas fa-user-tie text-success"></i> {{ $data->karyawan->dep }}</div>
      <div class="card-header">
        <h6>Nama</h6>
        <p>{{ $data->karyawan->nama }}</p>
        <h6>Periode</h6>
        <p><span class="badge badge-success">{{ $data->periode->namaPeriode }}</span></p>
        
        <!-- form -->
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>Uraian Penilaian</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach($indikator as $ind)
            <tr>
              <td>{{ $ind->pertanyaan }}</td>
              <td><input type="number" name="ind[{{ $data->karyawanId }}][{{ $ind->id }}]" class="form-control form-control-sm" min="1" max="10" required></td>
            </tr>
            @endforeach
            <tr>
              <td>t <small class="text-info">(Nilai = -4)</small></td>
              <td><input type="number" name="t[{{ $data->karyawanId }}]" class="form-control form-control-sm" value="{{ $data->t }}" readonly></td>
            </tr>
            <tr>
              <td>ip <small class="text-info">(Nilai = -0)</small></td>
              <td><input type="number" name="ip[{{ $data->karyawanId }}]" class="form-control form-control-sm" value="{{ $data->ip }}" readonly></td>
            </tr>
            <tr>
              <td>ik <small class="text-info">(Nilai = -0)</small></td>
              <td><input type="number" name="ik[{{ $data->karyawanId }}]" class="form-control form-control-sm" value="{{ $data->ik }}" readonly></td>
            </tr>
            <tr>
              <td>p <small class="text-info">(Nilai = -5)</small></td>
              <td><input type="number" name="p[{{ $data->karyawanId }}]" class="form-control form-control-sm" value="{{ $data->p }}" readonly></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endforeach
</div>
<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
</form>

@endsection

@section('modal')

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