@extends('admin.master')

@section('title', '- Penilaian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Pilih Kandidat Best Employee</h2>
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
        <table class="table">
    @foreach($dep as $dep)
            <?php
                $no = 1;
            ?>
            <thead class="thead-dark">
                <tr>
                    <th>{{$dep}}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach(Helper::polingByDepartemen($dep) as $karyawan)
                <tr>
                    <th>{{$no++}}</th>
                    <td>{{$karyawan->nama}}</td>
                    <td><input type="checkbox" aria-label="Checkbox for following text input"></td>
                </tr>
            @endforeach
            </tbody>
    @endforeach
        </table>
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