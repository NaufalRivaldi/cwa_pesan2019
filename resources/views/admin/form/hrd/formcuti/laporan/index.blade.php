@extends('admin.master')

@section('title', '- Laporan HRD')

@section('content')
    <div class="row">
      <div class="col-12">
      
      <div class="card">
          <div class="card-header">
              <h3>Kartu Cuti</h3>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="custom-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Sisa Cuti</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuti as $cuti)
                    <tr>
                        <td data-id="{{$cuti->karyawan->id}}" class="viewCuti">{{$no++}}</td>
                        <td data-id="{{$cuti->karyawan->id}}" class="viewCuti">{{$cuti->karyawan->nama}}</td>
                        <td data-id="{{$cuti->karyawan->id}}" class="viewCuti">{{$cuti->karyawan->dep}}</td>
                        <td data-id="{{$cuti->karyawan->id}}" class="viewCuti">{{$cuti->sisa}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <div class="card-header">
            <h3>Laporan Form Cuti</h3>
          </div>
          
          <div class="card-header">
            @php
              $tglA = '';
              $tglB = '';
              $kategoriId = '';
              $dep = '';
              $status = '';

              if($_GET){
                $tglA = $_GET['tglA'];
                $tglB = $_GET['tglB'];
                $kategoriId = $_GET['kategoriId'];
                $dep = $_GET['dep'];
                $status = $_GET['status'];
              }
            @endphp
            <form action="" method="GET">
              <div class="form-row">
                <div class="col-md-2">
                  <input type="date" name="tglA" class="form-control form-control-sm tglA" data-toggle="tooltip" data-placement="top" title="Tanggal awal" value="{{ $tglA }}">
                </div>
                <div class="col-md-2">
                  <input type="date" name="tglB" class="form-control form-control-sm tglB" data-toggle="tooltip" data-placement="top" title="Tanggal akhir" value="{{ $tglB }}">
                </div>
                <div class="col-md-2">
                  <select name="dep" id="dep" class="form-control form-control-sm">
                    <option value="">Pilih Departemen</option>
                    @foreach(Helper::allDep() as $cb)
                      <option value="{{ $cb }}" {{ ($cb == $dep)?'selected':'' }}>{{ $cb }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <select name="kategoriId" id="ketegoriId" class="form-control form-control-sm">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $kt)
                      <option value="{{ $kt->id }}" {{ ($kt->id == $kategoriId)?'selected':'' }}>{{ $kt->kategori }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <select name="status" id="status" class="form-control form-control-sm">
                    <option value="">Pilih Status</option>
                    <option value="4" {{ ($status == '4')?'selected':'' }}>Acc</option>
                    <option value="5" {{ ($status == '5')?'selected':'' }}>Ditolak</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" name="btn" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                  <a href="{{ route('laporan.hrd.formcuti') }}" class="btn btn-warning btn-sm"><i class="fas fa-redo"></i></a>
                </div>
              </div>
            </form>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">
              <table class="myTable custom-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no1 = 1; @endphp
                    @foreach($formCuti as $form)
                    <tr>
                        <td data-id="{{$form->id}}" class="dataView">{{$no1++}}</td>
                        <td data-id="{{$form->id}}" class="dataView">{!!Helper::setDate($form->created_at)!!}</td>
                        <td data-id="{{$form->id}}" class="dataView">{{$form->karyawan->nama}}</td>
                        <td data-id="{{$form->id}}" class="dataView">{{$form->karyawan->dep}}</td>
                        <td data-id="{{$form->id}}" class="dataView">{!!Helper::getKategoriCuti($form->id)!!}</td>
                        <td data-id="{{$form->id}}" class="dataView">{!!Helper::statusFormCuti($form->status)!!}</td>
                        <td>
                          <button class="btn btn-sm btn-danger delete" data-id="{{$form->id}}"><i class="far fa-trash-alt"></i></button>
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
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="viewModalCuti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Form Cuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td width="20%">Nama</td>
            <td width="5%">:</td>
            <td class="namaKaryawanCuti"></td>
          </tr>
          <tr>
            <td>Departemen</td>
            <td>:</td>
            <td class="departemenCuti"></td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>:</td>
            <td class="kategoriCuti"></td>
          </tr>
          <tr>
            <td>Periode</td>
            <td>:</td>
            <td class="periodeCuti"></td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:</td>
            <td class="statusCuti"></td>
          </tr>
          <tr>
            <td>Sisa Cuti</td>
            <td>:</td>
            <td class="sisaCuti"></td>
          </tr>
        </table>
        <div class="tableCuti">

        </div>
        <div class="alasan"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success accForm" data-val="1">Acc</button>
        <button type="button" class="btn btn-danger accForm" data-val="2">Tolak</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Form Cuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td width="20%">Tgl Pengajuan</td>
            <td width="1%">:</td>
            <td class="tglPengajuan"></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td class="namaKaryawan"></td>
          </tr>
          <tr>
            <td>Departemen</td>
            <td>:</td>
            <td class="departemen"></td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:</td>
            <td class="status"></td>
          </tr>
        </table>
        <div class="tableCuti">

        </div>
        <div class="alasan"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success accForm" data-val="1">Acc</button>
        <button type="button" class="btn btn-danger accForm" data-val="2">Tolak</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title valTitle" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="valText">Masukkan nik dan password  untuk acc form.</p>
        <form action="{{ route('form.hrd.cuti.formcuti.verifikasi') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="" class="idForm">
          <input type="hidden" name="type" value="" class="type">
          <div class="form-group">
              <label>NIK</label>
              <input type="text" name="nik" class="form-control" required>
          </div>
          <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group alasan">
              
          </div>
          <div class="form-group">
              <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary float-right">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <p class="text-danger">* Dengan mengacc form ini, maka kepala bagian / leader {{auth()->user()->dep}} menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.viewCuti', function() {
      var id = $(this).data('id');
      window.location.href = '{{ url("/admin/laporan/hrd/formcuti/detail") }}'+"/"+id;
    });

    $(document).on('click', '.dataView', function() {
        var id = $(this).data('id');
        $.ajax({
          url: '{{route("form.hrd.cuti.formcuti.detail")}}',
          data: "id="+id,
          type: 'GET',
          success: function(data){
            console.log(data);
            $('#viewModal').modal('show');
            $('.tglPengajuan').empty();
            $('.namaKaryawan').empty();
            $('.departemen').empty();
            $('.status').empty();

            $('.tglPengajuan').append(data.tglPengajuan);
            $('.namaKaryawan').append(data.namaKaryawan);
            $('.departemen').append(data.departemen);
            $('.status').append(data.stat);
            $('.accForm').attr('data-id', data.id);
            if (data.status > 1 && data.status < 5) {
              $('.modal-footer').attr('hidden', 'true');
              $('.alasan').empty();
            } else {                 
              $('.alasan').empty();
              $('.modal-footer').removeAttr('hidden');
              if (data.keterangan != '-'){
                $('.modal-footer').attr('hidden','true');
                $('.alasan').empty();
                $('.alasan').append('<label>Alasan</label><textarea name="keterangan" id="" class="form-control" rows="5" disabled>'+ data.keterangan +'</textarea>');
              }
            }
          }
        });

      $.ajax({
        url: '{{route("form.hrd.cuti.formcuti.detailCuti")}}',
        data: "id="+id,
        type: 'GET',
        success: function(data) {
          console.log(data);
          $('.tableCuti').empty();
          $('.tableCuti').html(data);
        }
      })
    });

    $(document).on('click', '.accForm', function(){
      var id = $(this).data('id');
      var val = $(this).data('val');
      console.log(id);
      $('#accModal').modal('show');
      $('#viewModal').modal('hide');

      switch (val) {
        case 1:
          $('.valTitle').empty();
          $('.valText').empty();
          $('.alasan').empty();

          $('.valTitle').append('Acc Form Cuti');
          $('.valText').append("Masukkan NIK dan Password kepala bagian / leader {{auth()->user()->dep}} untuk acc form.");          
          break;
        case 2:
          $('.valTitle').empty();
          $('.valText').empty();
          $('.alasan').empty();

          $('.valTitle').append('Tolak Form Cuti');
          $('.valText').append("Masukkan NIK dan Password kepala bagian / leader {{auth()->user()->dep}} untuk tolak form.");
          $('.alasan').append('<label>Alasan</label><textarea name="keterangan" id="" class="form-control" rows="5"></textarea>');
          break;
        default:
          break;
      }

      $('.idForm').val(id);
      $('.type').val(val);
    });

    $(document).on('click','.delete', function() {    
        var id = $(this).data('id');
        swal({
        title: 'Perhatian!',
        text: "Apakah anda yakin menghapus data ini?",
        icon: 'warning',
        buttons: true,
        dangerMode: true
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: "POST",
              url: "{{ route('form.hrd.cuti.formcuti.delete') }}",
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(data){
                location.reload();
              }
            })
          }
        })
    });

    $(document).ready(function(){
      $('.tglA').on('change', function(){
        let $tglA = $(this).val();
        $('.tglB').val($tglA);
        $('.tglB').attr('min', $tglA);
      });
    });
</script>
@endsection