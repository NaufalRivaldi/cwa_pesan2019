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
                        <td width="20%">NIK</td>
                        <td width="2%">:</td>
                        <td>{{ $kabag->nik }}</td>
                    </tr>
                    <tr>
                        <td>Nama Kepala Bagian</td>
                        <td>:</td>
                        <td>{{ $kabag->nama }}</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>:</td>
                        <td>{{ $kabag->dep }}</td>
                    </tr>
                    <tr>
                        <td>Periode</td>
                        <td>:</td>
                        <td><span class="badge badge-primary">{{ $periode->namaPeriode }}</span></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><span class="badge badge-primary">{{ date('d F Y') }}</span></td>
                    </tr>
                </table>
            </div>
            
            <form action="{{ route('pkk.penilaian.kabag.store') }}" method="POST">
            @csrf
            <input type="hidden" name="karyawanId" value="{{ $karyawan->id }}">
            <input type="hidden" name="kabagId" value="{{ $kabag->id }}">
            <input type="hidden" name="periodeId" value="{{ $periode->id }}">
            <div class="card-body">
                <h2>Ketentuan Nilai</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Apabila performa kepala departemen sangat kurang dan kepala departemen tidak dapat menjalankan perannya sebagai kepala departemen</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Apabila performa kepala departemen kurang baik, dan diperlukan peningkatan segera</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Apabila indikator penilaian kepala departemen sudah terpenuhi, tetapi masih harus lebih konsisten</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Apabila performa kepala departemen melebihi ekspektasi dan selalu membantu departemen lain juga</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Apabila performa departemen melebihi ekspektasi, sudah konsisten  dan berkontribusi terhadap departemen lain</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="50%">Indikator Penilaian</th>
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
                <h2>Kuisioner</h2>
                <hr>
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