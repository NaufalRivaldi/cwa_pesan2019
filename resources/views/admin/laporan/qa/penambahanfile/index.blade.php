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
                    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-cog"></i> Pengaturan
                        </button>
                        <?php
                            $url = '';
                            if($_GET)
                                $url = $_SERVER['QUERY_STRING'];
                        ?>

                        @if($_GET)
                        <a href="{{ url('admin/formhrd/laporan/export?'.$url) }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel</a>
                        @endif

                        <div class="collapse mt-2" id="collapseExample">
                          <div class="card card-body">
                            <form action="" method="GET">
                              <div class="row">
                                <div class="col-md-4">
                                  <label><b>Tanggal Awal</b></label><br>
                                  <input type="date" name="tgl_a" class="form-control" value="{{ (!empty($_GET['tgl_a'])) ? $_GET['tgl_a'] : '' }}" required>
                                </div>
                                <div class="col-md-4">
                                <label><b>Tanggal Akhir</b></label><br>
                                  <input type="date" name="tgl_b" class="form-control" value="{{ (!empty($_GET['tgl_b'])) ? $_GET['tgl_b'] : '' }}" required>
                                </div>  
                                <div class="col-md-4">
                                  <label><b>Kategori</b></label><br>
                                  <select class="js-example-responsive form-control" multiple="multiple" name="kategori" id="selectAll" style="width:100%">
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <label><b>Departemen</b></label>
                                  <select name="dep" class="form-control dep-select">
                                    <option value="All" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == 'All') ? 'selected' : '' : '' }}>All</option>
                                    <option value="Office" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == 'Office') ? 'selected' : '' : '' }}>Office</option>
                                    <option value="Gudang" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == 'Gudang') ? 'selected' : '' : '' }}>Gudang</option>
                                    @foreach(Helper::allDep() as $row)
                                        <option value="{{ $row->inisial }}" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == $row->inisial) ? 'selected' : '' : '' }}>{{ $row->inisial }}</option>
                                    @endforeach
                                  </select>
                                </div>  
                                <div class="col-md-4">
                                  <label>&nbsp;</label><br>
                                  <input type="submit" value="Cari Data" class="btn btn-primary">
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="custom-table table table-striped myTableExport">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Nama</th>
                                    <th>Dept</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1; @endphp
                                  @foreach($form as $row)
                                  <tr>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$no++}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{!! Helper::setDate($row->created_at) !!}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->karyawan->nama}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->karyawan->dep}}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{!! Helper::kategoriFormQa($row->kategori) !!}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{!! Helper::statusFormQa($row->status) !!}</td>
                                    <td class="viewModal" data-id="{{$row->id}}">{{$row->keterangan}}</td>
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