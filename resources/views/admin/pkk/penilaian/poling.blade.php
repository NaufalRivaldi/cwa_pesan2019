@extends('admin.master')

@section('title', '- Penilaian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <h2>Halo, {{$karyawan->nama}}</h2>
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
      <form action="">
        
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
                <tr data-id="{{$karyawan->id}}">
                    <th width="1%">{{$no++}}</th>
                    <td>{{$karyawan->nama}}</td>
                    <td><input type="checkbox" aria-label="" value="{{$karyawan->id}}" name="karyawanId[{{$dep}}][]"></td>
                </tr>
            @endforeach
            </tbody>
    @endforeach
        </table>
          <input type="submit" value="Submit" class="btn btn-sm btn-primary float-right">
      </form>
@endsection

@section('js')
<script>
  $('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  });

  $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
    if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
    }
    else {
        $box.prop("checked", false);
    }
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