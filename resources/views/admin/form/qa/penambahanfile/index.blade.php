@extends('admin.master')

@section('title', '- Penambahan File')

@section('content')
    <div class="row">
        <div class="col-12">                     
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Form Usulan Copy Dokumen </li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.qa.penambahanfile.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a> 
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
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $noProgress = 1 @endphp
                            @foreach($formProgress as $row)
                              <tr>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $noProgress++ }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::setDateForm($row->created_at) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->nama }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->dep }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::statusFormQa($row->status) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->keterangan }}</td>
                                <td>
                                @if($row->status == 1)
                                  <a href="#" class="btn-delete" data-id="{{ $row->id }}"><i class="btn btn-danger btn-sm far fa-trash-alt"></i></a>
                                @else                                  
                                  <a href="{{ route('form.qa.penambahanfile.selesai', ['id'=>$row->id]) }}" class="btn-done btn btn-sm btn-success fas fa-check" data-id="{{ $row->id }}"></a>
                                @endif
                                </td>
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
                                <th>Keterangan</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php $noSelesai = 1 @endphp
                              @foreach($formSelesai as $row)
                              <tr>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $noSelesai++ }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::setDate($row->created_at) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->nama }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->dep }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::statusFormQa($row->status) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->keterangan }}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Detail Penambahan Copy Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td width="20%">Tanggal</td>
            <td width="1%">:</td>
            <td class="tanggal"></td>
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
            <td>Kategori</td>
            <td>:</td>
            <td class="kategori"></td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:</td>
            <td class="status"></td>
          </tr>
          <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td class="keterangan"></td>
          </tr>
        </table>
        <div class="form-group">
            <label for="keterangan">Dokumen/Form :</label>
            <div id="tabelPenambahan"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success accForm" data-val="1">Acc</button>
        <button type="button" class="btn btn-danger accForm" data-val="2">Tolak</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.viewModal', function(){
      var id = $(this).data('id');
      $.ajax({
        url : '{{ route("form.qa.penambahanfile.view") }}',
        data: "id="+id,
        type: 'GET',
        success: function(data){
          $('.tanggal').empty();
          $('.namaKaryawan').empty();
          $('.departemen').empty();
          $('.kategori').empty();
          $('.status').empty();
          $('.keterangan').empty();

          $('.tanggal').append(data.tanggal);
          $('.namaKaryawan').append(data.karyawanId);
          $('.departemen').append(data.dep);
          $('.kategori').append(data.kategori);
          $('.status').append(data.status);
          $('.keterangan').append(data.keterangan);
          $('.accForm').attr('data-id', data.id);
          if (data.status1 != 1) {
            $('.modal-footer').attr('hidden', true);
          } else {
            $('.modal-footer').removeAttr('hidden');
          }
        }
      })

      $.ajax({
        type: 'GET',
        url: '{{ route("form.qa.penambahanfile.table") }}',
        data: {
            'id' : id
        },
        success: function(data){
            $('#tabelPenambahan').empty();
            $('#tabelPenambahan').append(data);
        }
      })
      $('#viewModal').modal('show');
    });

    //delete
    $(document).on('click','.btn-delete', function() {
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
              url: "",
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

    $(document).on('click', '.accForm', function(){     
      var id = $(this).data('id');
      var val = $(this).data('val');
      console.log(id)
      if (val == 1) {   
        swal({
          title: 'Perhatian!',
          text: "Apakah anda yakin menyetujui form ini?",
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        }).then((result) => {
          if (result) {
            $.ajax({
              type: "POST",
              url: '{{ route("form.qa.penambahanfile.acc") }}',
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(data){
                console.log(data);
                location.reload();
              }
            })
          }
        })
      } else {
        swal({
          title: 'Perhatian!',
          text: "Apakah anda yakin menolak form ini?",
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: "POST",
              url: '{{ route("form.qa.penambahanfile.tolak") }}',
              data: {
                id: id,
                _token: '{{ csrf_token() }}'
              },
              success: function(data){
                console.log(data);
                location.reload();
              }
            })
          }
        })
      }
      console.log(val);
    });
</script>
@endsection