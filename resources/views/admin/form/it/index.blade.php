@extends('admin.master')

@section('title', '- Penanganan IT')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">                       
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Penanganan IT</li>
                        </ol>
                    </nav>
                </div>            
                <div class="card">
                    <div class="card-header">
                        @php
                            $tglA = '';
                            $tglB = '';
                            $stat = '';

                            if(auth()->user()->dep == 'IT'){
                                $dept = '';
                            }

                            if($_GET){
                                $tglA = $_GET['tglA'];
                                $tglB = $_GET['tglB'];
                                $stat = $_GET['stat'];

                                if(auth()->user()->dep == 'IT'){
                                    $dept = $_GET['dep'];
                                }
                            }
                        @endphp
                        <form method="GET" class="form">
                            <div class="row">
                                <div class="{{ (auth()->user()->dep == 'IT')?'col-md-2':'col-md-4' }}">
                                    <a href="{{ route('penanganan.it.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="tglA" class="form-control form-control-sm tglA" value="{{ $tglA }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="tglB" class="form-control form-control-sm tglB" value="{{ $tglB }}">
                                </div>
                                @if(auth()->user()->dep == 'IT')
                                <div class="col-md-2">
                                    <select name="dep" id="dep" class="form-control form-control-sm">
                                        <option value="">Pilih Departemen</option>
                                        @foreach(Helper::allDep() as $dep)
                                            <option value="{{ $dep }}" {{ ($dept == $dep)? 'selected' : '' }}>{{ $dep }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-md-2">
                                    <select name="stat" id="stat" class="form-control form-control-sm">
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ ($stat == 1)?'selected':'' }}>Pending</option>
                                        <option value="2" {{ ($stat == 2)?'selected':'' }}>Progress</option>
                                        <option value="3" {{ ($stat == 3)?'selected':'' }}>Selesai</option>
                                        <option value="4" {{ ($stat == 4)?'selected':'' }}>Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Tanggal</th>
                                        <th>Departement</th>
                                        <th>Permasalahan</th>
                                        <th>Penyelesaian</th>
                                        <th>Stat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($form as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->kode }}</td>
                                            <td>
                                                {{ Helper::setDate($row->tgl) }}
                                            </td>
                                            <td>
                                                {{ $row->user->dep }}
                                            </td>
                                            <td>
                                                {{ $row->masalah }}
                                            </td>
                                            <td>
                                                {{ $row->penyelesaian }}
                                            </td>
                                            <td>
                                                {!! statusFormPenangananIt($row->stat) !!}
                                            </td>
                                            <td>
                                                @if(auth()->user()->dep == 'IT')
                                                    @if($row->stat == 1)
                                                        <button class="btn btn-primary btn-sm modalVerifikasi" data-toggle="modal" data-target="#modalVerifikasi" data-id="{{ $row->id }}"><i class="fas fa-check"></i></button>
                                                    @else
                                                        <button class="btn btn-sm btn-info modalStatus" data-toggle="modal" data-target="#modalStatus" data-id="{{ $row->id }}">Status</button>
                                                    @endif 
                                                @endif
                                                <a href="{{ route('penanganan.it.view', ['id' => $row->id]) }}" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a>
                                                @if($row->stat < 3 || auth()->user()->dep == 'IT')
                                                    <a href="#" class="btn btn-danger btn-sm delete_form_it" data-id="{{ $row->id }}"><i class="far fa-trash-alt"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVerifikasiLabel">Verifikasi Penanganan IT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{ route('penanganan.it.verifikasi') }}" method="POST">
        @csrf
        <input type="hidden" name="id" class="formId">

        <div class="modal-body">
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" placeholder="xxxx.xxxx" onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" maxLength="9" required>
                
                @if($errors->has('nik'))
                    <small class="text-danger">{{ $errors->first('nik') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="tindakan">Tindakan</label>
                <select name="tindakan" id="tindakan" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="1">Acc</option>
                    <option value="2">Tolak</option>
                </select>
            </div>

            <div class="keterangan"></div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStatusLabel">Ubah Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('penanganan.it.status') }}" method="POST">
      @csrf
        <input type="hidden" name="id" class="formStatusId">
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" placeholder="xxxx.xxxx" onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" maxLength="9" required>
                
                @if($errors->has('nik'))
                    <small class="text-danger">{{ $errors->first('nik') }}</small>
                @endif
            </div>
            
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="2">Progress</option>
                    <option value="3">Selesai</option>
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#tindakan').on('change', function(){
            let tindakan = $(this).val();
            
            if(tindakan == 2){
                $('.keterangan').append(`
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
                </div>
                `);
            }else{
                $('.keterangan').empty();
            }
        });

        $('.modalVerifikasi').on('click', function(){
            let id = $(this).data('id');
            
            $('.formId').val(id);
        });

        $('.modalStatus').on('click', function(){
            let id = $(this).data('id');
            
            $('.formStatusId').val(id);
        });

        $('.form').on('change', function(){
            $('.form').submit();
        });

        $('.tglA').on('change', function(){
            let tglA = $(this).val();

            $('.tglB').val(tglA);
        });
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