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
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>PIC</th>
                                <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $noProgress = 1 @endphp
                            @foreach($formProgress as $row)
                              <tr>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $noProgress++ }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->kode }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::setDateForm($row->created_at) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->nama }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->dep }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::statusFormQa($row->status) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->keterangan }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ (empty($row->pic))?'':$row->pic->nama }}</td>
                                <td>
                                @if($row->status == 1)
                                  <a href="#" class="btn-delete" data-id="{{ $row->id }}"><i class="btn btn-danger btn-sm far fa-trash-alt"></i></a>
                                @elseif(auth()->user()->dep == 'QA')                                  
                                  <a href="#" class="btn-done btn btn-sm btn-success fas fa-check" data-id="{{ $row->id }}" data-val="3"></a>
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
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>PIC</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php $noSelesai = 1 @endphp
                              @foreach($formSelesai as $row)
                              <tr>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $noSelesai++ }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->kode }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::setDateForm($row->created_at) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->nama }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->karyawan->dep }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{!! Helper::statusFormQa($row->status) !!}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->keterangan }}</td>
                                <td class="viewModal" data-id="{{$row->id}}">{{ $row->pic->nama }}</td>
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
          <tr>
            <td>PIC</td>
            <td>:</td>
            <td class="pic"></td>
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

<div class="modal fade" id="acc-form-qa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Form QA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('form.qa.penambahanfile.selesai') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="form_qa_id" class="form-control form_qa_id">
                    <input type="hidden" name="form_qa_type" class="form-control form_qa_type">
                    <div class="form-group">
                        <label>NIK</label>
                        <input onkeyup="convertToMin(this);" onkeypress="return hanyaAngka(event)" type="text" name="nik" class="form-control" maxlength="9" placeholder="xxxx.xxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-danger">* Masukkan nik dan password kepala bagian untuk menyelesaikan form. </p>
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
          $('.pic').empty();

          $('.tanggal').append(data.tanggal);
          $('.namaKaryawan').append(data.karyawanId);
          $('.departemen').append(data.dep);
          $('.kategori').append(data.kategori);
          $('.status').append(data.status);
          $('.keterangan').append(data.keterangan);
          $('.pic').append(data.pic);
          $('.accForm').attr('data-id', data.id);
          if (data.status1 != 1 || data.user != 'QA') {
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
        console.log(id);
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
              url: '{{ route("form.qa.penambahanfile.destroy") }}',
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

    $(document).on('click', '.btn-done', function(){
      var id = $(this).data('id');
      var val = $(this).data('val')
      $('#acc-form-qa').modal('show');
      $('.form_qa_id').val(id);
      $('.form_qa_type').val(val);
    });

    $(document).on('click', '.accForm', function(){
      var id = $(this).data('id');
      var val = $(this).data('val')
      $('#acc-form-qa').modal('show');
      $('.form_qa_id').val(id);
      $('.form_qa_type').val(val);
    });
</script>
@endsection