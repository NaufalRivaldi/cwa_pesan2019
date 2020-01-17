@extends('admin.master')

@section('title', '- Penilaian')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <h2>Halo, {{$karyawan->nama}}</h2>
        <div class="page-header">
            <h2 class="pageheader-title">Nilai Kepala Bagian Anda</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pkk.penilaian') }}" class="btn btn-sm btn-success"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            <div class="card-header">
                <table class="table">
                    <tr>
                        <td width="10%">NIK</td>
                        <td width="2%">:</td>
                        <td>{{ $kabag->nik }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kabag->nama }}</td>
                    </tr>
                    <tr>
                        <td>Dep</td>
                        <td>:</td>
                        <td>{{ $kabag->dep }}</td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td>{{ $periode->namaPeriode }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><span class="badge badge-primary">{{ Helper::setDate($periode->tglMulai).' - '.Helper::setDate($periode->tglSelesai) }}</span></td>
                    </tr>
                </table>
            </div>
            
            <form action="{{ route('pkk.penilaian.kabag.store') }}" method="POST">
            @csrf
            <input type="hidden" name="karyawanId" value="{{ $karyawan->id }}">
            <input type="hidden" name="kabagId" value="{{ $kabag->id }}">
            <input type="hidden" name="periodeId" value="{{ $periode->id }}">
            <div class="card-body">
                <h5>Indikator</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="50%">Penilaian</th>
                            <th colspan="5">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; $idx = 0; ?>
                        @foreach($indikator as $indikator)
                            <input type="hidden" name="indikatorId[]" value="{{ $indikator->id }}">
                            <tr>
                                <td width="5%">{{ $no++ }}</td>
                                <td>{{ $indikator->pertanyaan }}</td>
                                <td><input type="radio" name="indikatorValue[{{ $idx }}]" value="1">1</td>
                                <td><input type="radio" name="indikatorValue[{{ $idx }}]" value="2">2</td>
                                <td><input type="radio" name="indikatorValue[{{ $idx }}]" value="3">3</td>
                                <td><input type="radio" name="indikatorValue[{{ $idx }}]" value="4">4</td>
                                <td><input type="radio" name="indikatorValue[{{ $idx++ }}]" value="5">5</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($errors->has('indikatorValue'))
                  <div class="text-danger">
                      {{ $errors->first('indikatorValue') }}
                  </div>
                @endif

                <hr>
                <h5>Kuisioner</h5>
                <table class="table table-bordered">
                    <?php $idx = 0; ?>
                    @foreach($kuisioner as $kuisioner)
                        <input type="hidden" name="kuisionerId[]" value="{{ $kuisioner->id }}">
                        <tr>
                            <td>{{ $kuisioner->pertanyaan }}</td>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="jawaban[{{ $idx++ }}]" rows="5" class="form-control" required></textarea>

                                @if($errors->has('jawaban'))
                                    <div class="text-danger">
                                        {{ $errors->first('jawaban') }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
            </form>

        </div>
    </div>
</div>
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