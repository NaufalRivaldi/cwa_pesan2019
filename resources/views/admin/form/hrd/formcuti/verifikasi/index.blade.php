@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Verifikasi Cuti</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th width="8%">No</th>
                                    <th width="20%">Tanggal Pengajuan</th>
                                    <th width="45%">Nama</th>
                                    <th>Bagian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(auth()->user()->level == 7)
                            @foreach($formCuti as $row)
                            <tr>
                                <td data-id="{{$row->id}}" class="dataView">{{$no++}}</td>
                                <td data-id="{{$row->id}}" class="dataView">{!!Helper::setDate($row->created_at)!!}</td>
                                <td data-id="{{$row->id}}" class="dataView">{{$row->karyawan->nama}}</td>
                                <td data-id="{{$row->id}}" class="dataView">{{$row->karyawan->dep}}</td>
                                <td data-id="{{$row->id}}" class="dataView">{!!Helper::statusFormCuti($row->status)!!}</td>
                            </tr>
                            @endforeach
                            @endif
                            
                            @if(auth()->user()->level == 5)
                            @foreach($formCutiOffice as $row)
                            <tr>
                                <td data-id="{{$row->id}}" class="dataView">{{$no++}}</td>
                                <td data-id="{{$row->id}}" class="dataView">{!!Helper::setDate($row->created_at)!!}</td>
                                <td data-id="{{$row->id}}" class="dataView">{{$row->karyawan->nama}}</td>
                                <td data-id="{{$row->id}}" class="dataView">{{$row->karyawan->dep}}</td>
                                <td data-id="{{$row->id}}" class="dataView">{!!Helper::statusFormCuti($row->status)!!}</td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
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
        <form action="{{ (auth()->user()->level == 7) ? route('form.hrd.cuti.verifikasiCuti.hrd') : route('form.hrd.cuti.verifikasiCuti.am') }}" method="post">
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
        <p class="text-danger">* Dengan mengacc form ini, maka {{auth()->user()->dep}} menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
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
            $('.status').append(data.status);
            $('.accForm').attr('data-id', data.id);
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
          $('.valText').append("Masukkan NIK dan Password {{auth()->user()->dep}} untuk acc form.");          
          break;
        case 2:
          $('.valTitle').empty();
          $('.valText').empty();
          $('.alasan').empty();

          $('.valTitle').append('Tolak Form Cuti');
          $('.valText').append("Masukkan NIK dan Password {{auth()->user()->dep}} untuk tolak form.");
          $('.alasan').append('<label>Alasan</label><textarea name="keterangan" id="" class="form-control" rows="5"></textarea>');
          break;
        default:
          break;
      }

      $('.idForm').val(id);
      $('.type').val(val);
    });
</script>
@endsection