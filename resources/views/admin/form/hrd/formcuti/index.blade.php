@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">                     
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Form HRD</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.hrd.cuti.formcuti.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a> 
                    <span id="insert-menu"></span>
                </div>
                <div class="card-body">
                    <h3><i class="fas fa-spinner"></i> Form Progress</h3>
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
                                @foreach($formProgress as $fp)
                                    <tr>
                                        <td data-id="{{$fp->id}}" class="dataView">{{$no++}}</td>
                                        <td data-id="{{$fp->id}}" class="dataView">{!!Helper::setDate($fp->created_at)!!}</td>
                                        <td data-id="{{$fp->id}}" class="dataView">{{$fp->karyawan->nama}}</td>
                                        <td data-id="{{$fp->id}}" class="dataView">{{$fp->karyawan->dep}}</td>
                                        <td data-id="{{$fp->id}}" class="dataView">{!!Helper::getKategoriCuti($fp->id)!!}</td>
                                        <td data-id="{{$fp->id}}" class="dataView">{!!Helper::statusFormCuti($fp->status)!!}</td>
                                        <td>               
                                        @if($fp->status == 1)
                                        <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{$fp->id}}"></button>
                                        @endif</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <h3><i class="fas fa-check-circle"></i> Form Selesai</h3>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($formDone as $fd)
                                  <tr data-id="{{$fd->id}}" class="dataView">
                                    <td>{{$indexDone++}}</td>
                                    <td>{!!Helper::setDate($fd->created_at)!!}</td>
                                    <td>{{$fd->karyawan->nama}}</td>
                                    <td>{{$fd->karyawan->dep}}</td>
                                    <td>{!!Helper::getKategoriCuti($fd->id)!!}</td>
                                    <td>{!!Helper::statusFormCuti($fd->status)!!}</td>
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
    //delete

    $(document).on('click','.delete',function() {
        var id = $(this).data('id');
        swal({
          title: 'Perhatian!',
          text: "Apakah anda yakin menghapus data ini?",
          icon: 'warning',
          buttons: true,
          dangerMode: true,
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
                location.reload()
              }
            })
          }
        })
      });

    //view
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
</script>
@endsection