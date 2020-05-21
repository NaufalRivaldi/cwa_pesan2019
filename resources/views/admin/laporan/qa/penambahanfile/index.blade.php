@extends('admin.master')

@section('title', '- Laporan QA')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Laporan Penambahan Copy Dokumen - Formulir</h3>
                    </div>
                    <div class="card-header">
                    @php
                      $tglA = '';
                      $tglB = '';
                      $kategoriId = '';
                      $dep = '';
                      $status = '';
                      $url = '';
                      $picId = '';

                      if($_GET){
                        $tglA = $_GET['tglA'];
                        $tglB = $_GET['tglB'];
                        $kategoriId = $_GET['kategoriId'];
                        $dep = $_GET['dep'];
                        $status = $_GET['status'];
                        $url = '?'.$_SERVER['QUERY_STRING'];
                        $picId = $_GET['picId'];
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
                            <option value="1" {{ ($kategoriId == '1')?'selected':'' }}>Dokumen</option>
                            <option value="2" {{ ($kategoriId == '2')?'selected':'' }}>Form</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <select name="status" id="status" class="form-control form-control-sm">
                            <option value="">Pilih Status</option>
                            <option value="3" {{ ($status == '3')?'selected':'' }}>Selesai</option>
                            <option value="4" {{ ($status == '4')?'selected':'' }}>Ditolak</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <select name="picId" id="picId" class="form-control form-control-sm">
                            <option value="">Pilih PIC</option>
                            @foreach($pic as $row)
                              <option value="{{$row->id}}" {{ ($row->id == $picId)?'selected':'' }}>{{$row->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="d-flex flex-row-reverse">
                        <div class="mt-2 ml-1"><button type="submit" name="btn" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button></div>
                        <div class="mt-2 ml-1"><a href="{{ route('laporan.qa.penambahanfile.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-redo"></i></a></div>
                        <div class="mt-2 ml-1"><a href="{{ route('laporan.qa.penambahanfile.export').$url }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></a></div>
                      </div>
                    </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="custom-table table table-striped myTableExport">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Nama</th>
                                    <th>Dept</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>PIC</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1; @endphp
                                  @foreach($form as $row)
                                  <tr>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$no++}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->kode}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{!! Helper::setDate($row->created_at) !!}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->karyawan->nama}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->karyawan->dep}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{!! Helper::statusFormQa($row->status) !!}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->keterangan}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->pic->nama}}</td>
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
</script>
@endsection