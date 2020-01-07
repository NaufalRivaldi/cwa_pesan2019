@extends('admin.master')

@section('title', '- Perbaikan Sarana & Prasarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Perbaikan Sarana & Prasarana</h2>
                    </div>
                    <div class="card-header">
                        <a href="{{ route('form.ga.perbaikan.form') }}" class="btn btn-primary btn-sm">Ajukkan Form</a>
                    </div>
                    <div class="card-body">
                        <h3><i class="fas fa-spinner"></i> Form Progress</h3>
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pelaporan</th>
                                        <th>Dept</th>
                                        <th>Permintaan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

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
<div class="modal modalDesain fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Pengajuan Desain</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="karyawan_all">Pembuat</label>
            <input type="text" class="form-control karyawan_all" disabled id="karyawan_all" name="karyawan_all">
        </div>
        <div class="form-group">
            <label for="jenisDesain">Status</label>
            <div class="form-check status">
                
            </div>
        </div>
        <div class="form-group">
            <label for="jenisDesain">Jenis Desain</label>
            <div class="form-check jenisDesain">
                
            </div>
            *
            <span class="keterangan_lain text-info">
                
            </span>
        </div>
        <div class="form-group">
            <label for="tgl_perlu">Tanggal Pengajuan</label>
            <input type="date" class="form-control tgl_pengajuan" disabled id="tgl_perlu" name="tgl_perlu">
        </div>
        <div class="form-group">
            <label for="tgl_perlu">Tanggal Diperlukan</label>
            <input type="date" class="form-control tgl_perlu" disabled id="tgl_perlu" name="tgl_perlu">
        </div>
        <div class="form-group">
            <label for="qty">Qty / Jumlah</label>
            <input type="number" class="form-control qty" disabled id="qty" name="qty">
        </div>
        <div class="form-group">
            <label for="ukuran">Ukuran Cetak</label>
            <input type="text" class="form-control ukuran" disabled id="ukuran" name="ukuran">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" disabled rows="5" class="form-control deskripsi"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- validasi -->
<div class="modal fade" id="modalValidate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title valTitle" id="exampleModalCenterTitle"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="valText">Masukkan nik dan password  untuk acc form tersebut.</p>
                <form action="{{ route('desainIklan.validasi') }}" method="POST">
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
                        <input type="submit" name="btn-submit" value="Verifikasi" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-danger">* Dengan mengacc form ini, maka kepala bagian IT menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
            </div>
        </div>
    </div>
</div>

<!-- validasi -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Ganti Status Pengerjaan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('desainIklan.status') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" class="idForm">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="stat" class="form-control">
                            <option value="2">Acc Kepala Bagian IT/ Progress</option>
                            <option value="3">Progress</option>
                            <option value="4">Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Simpan" class="btn btn-primary btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            // view
            $('.modalClick').on('click', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route("desainIklan.view") }}',
                    data: "id="+id,
                    type: 'GET',
                    success: function(data){
                        console.log(data.status);
                        $('.status').empty();
                        $('.jenisDesain').empty();
                        $('.keterangan_lain').empty();
                        
                        $('.status').append(data.status);
                        $('.jenisDesain').append(data.jenisDesain);
                        $('.keterangan_lain').append(data.keterangan_lain);
                        $('.tgl_pengajuan').val(data.tglPengajuan);
                        $('.tgl_perlu').val(data.tglDiperlukan);
                        $('.qty').val(data.qty);
                        $('.ukuran').val(data.ukuranCetak);
                        $('.deskripsi').val(data.deskripsi);
                        $('.karyawan_all').val(data.karyawan_all);
                        
                    }
                });
                $('.modalDesain').modal('show');
            });

            // modal validasi
            $('.modalVal').on('click', function(){
                $('#modalValidate').modal('show');
                var id = $(this).data('id');
                var val = $(this).data('val');

                switch (val) {
                    case 1:
                        $('.valTitle').empty();
                        $('.valText').empty();
                        $('.alasan').empty();

                        $('.valTitle').append('ACC Form Pengajuan Desain');
                        $('.valText').append("Masukkan NIK dan Password kepala bagian IT untuk acc form desain tersebut");
                        break;

                    case 2:
                        $('.valTitle').empty();
                        $('.valText').empty();
                        $('.alasan').empty();

                        $('.valTitle').append('Tolak Form Pengajuan Desain');
                        $('.valText').append("Masukkan NIK dan Password kepala bagian IT untuk tolak form desain tersebut");
                        $('.alasan').append('<label>Alasan</label><textarea name="keterangan" id="" class="form-control" rows="5"></textarea>');
                        break;
                
                    default:
                        break;
                } 

                $('.idForm').val(id);
                $('.type').val(val);
            });

            // modal validasi
            $('.modalStatus').on('click', function(){
                $('#modalStatus').modal('show');
                var id = $(this).data('id');
                var stat = $(this).data('stat');
                $('.idForm').val(id);
                console.log(stat);

                $("select option[value='"+stat+"']").attr("disabled",true);
            });
        });
    </script>
@endsection