@extends('admin.master')

@section('title', '- Peminjaman Sarana & Prasarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">                                   
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Peminjaman Sarana & Prasarana</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <!-- <div class="card-header">
                        <h2>Perbaikan Sarana & Prasarana</h2>
                    </div> -->
                    <div class="card-header">
                        <a href="{{ route('form.ga.peminjaman.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a>
                    </div>
                    <div class="card-body">
                        <h3><i class="fas fa-spinner"></i> Form Progress</h3>
                        <div class="table-responsive">
                            <table class="myTable custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Pengaju</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Sarana</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formProgress as $row)
                                    <tr>
                                        <td class="modalClick" data-id="{{ $row->id }}">{{ $no++ }}</td>
                                        <td class="modalClick" data-id="{{ $row->id }}">{{ Helper::setDate($row->created_at) }}</td>
                                        <td class="modalClick" data-id="{{ $row->id }}">{{ $row->user->dep }}</td>
                                        <td class="modalClick" data-id="{{ $row->id }}">
                                            @foreach($row->detailForm as $data)
                                            {{ Helper::setDate($data->tgl) }}<br> 
                                            @endforeach
                                        </td>
                                        <td class="modalClick" data-id="{{ $row->id }}">
                                            @foreach($row->detailForm as $data)
                                            {{ $data->sarana->namaSarana }}<br> 
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(auth()->user()->dep == 'GA' || auth()->user()->dep == 'IT')
                                                @if($row->status == 1)
                                                    <button class="btn btn-success btn-sm modalVal fas fa-user-check" data-id="{{ $row->id }}" data-val="1"></button>
                                                    <button class="btn btn-danger btn-sm modalVal fas fa-times-circle" data-id="{{ $row->id }}" data-val="2"></button>
                                                @endif
                                            @endif
                                            @if(auth()->user()->id == $row->userId)
                                                <a href="#" class="remove-form-peminjaman btn btn-danger btn-sm far fa-trash-alt" data-id="{{ $row->id }}"></a>
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
                                        <th>Tgl Pengajuan</th>
                                        <th>Pengaju</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Sarana</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formSelesai as $row)
                                    <tr>
                                        <td class="modalClick" data-id="{{ $row->id }}">{{ $no++ }}</td>
                                        <td class="modalClick" data-id="{{ $row->id }}">{{ Helper::setDate($row->created_at) }}</td>
                                        <td class="modalClick" data-id="{{ $row->id }}">{{ $row->user->dep }}</td>
                                        <td class="modalClick" data-id="{{ $row->id }}">
                                            @foreach($row->detailForm as $data)
                                            {{ Helper::setDate($data->tgl) }}<br> 
                                            @endforeach
                                        </td>
                                        <td class="modalClick" data-id="{{ $row->id }}">
                                            @foreach($row->detailForm as $data)
                                            {{ $data->sarana->namaSarana }}<br> 
                                            @endforeach
                                        </td>
                                        <td>{{ $row->keterangan }}</td>
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
<div class="modal modalPerbaikan fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form Peminjaman Sarana & Prasarana</h3>
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
            <tr class="tglSelesai">
            
            </tr>
            <tr>
                <td>Pengaju</td>
                <td>:</td>
                <td class="pengaju"></td>
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
        <hr>
        <div class="form-group">
            <label for="keterangan">Sarana :</label>
            <div id="tabelPeminjaman"></div>
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
                <form action="{{ route('form.ga.peminjaman.validasi') }}" method="POST">
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
                <p class="text-danger">* Dengan mengacc form ini, maka kepala bagian / leader GA menyetujui atau bertanggung jawab penuh atas kebenaran isi form. </p>
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
                <form action="{{ route('form.ga.perbaikan.status') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" class="idForm">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="stat" class="form-control statusForm">
                            <option value="2">Acc GA/ Progress</option>
                            <option value="3">Dalam Pengajuan</option>
                            <option value="4">Selesai</option>
                        </select>
                    </div>
                    <div class="form-group fillTgl">
                        
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btn-submit" value="Simpan" class="btn btn-primary btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit -->
<div class="modal fade modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">Edit</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('form.ga.peminjaman.update.sarana') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" class="idForm">
                    <div class="form-group">
                        <label>Tanggal Pengajuan</label>
                        <input type="date" name="tgl" class="form-control tglPengajuan">
                        <!-- error -->
                        @if($errors->has('tgl'))
                            <div class="text-danger">
                                {{ $errors->first('tgl') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Mulai</label>
                        <input type="time" name="pukulA" class="form-control pukulA">
                        @if($errors->has('pukulA'))
                            <div class="text-danger">
                                {{ $errors->first('pukulA') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Sampai</label>
                        <input type="time" name="pukulB" class="form-control pukulB">
                        @if($errors->has('pukulB'))
                            <div class="text-danger">
                                {{ $errors->first('pukulB') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Sarana</label>
                        <select name="saranaId" class="form-control fillSarana">
                        
                        </select>
                        @if($errors->has('saranaId'))
                            <div class="text-danger">
                                {{ $errors->first('saranaId') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="5" class="form-control keterangan"></textarea>
                        @if($errors->has('keterangan'))
                            <div class="text-danger">
                                {{ $errors->first('keterangan') }}
                            </div>
                        @endif
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
       // view
       $(document).on('click', '.modalClick', function(){
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("form.ga.peminjaman.view") }}',
                data: "id="+id,
                type: 'GET',
                success: function(data){
                    console.log(data.status);
                    $('.tglPengajuan').empty();
                    $('.pengaju').empty();
                    $('.status').empty();
                    $('.keterangan').empty();
                    
                    $('.tglPengajuan').append(data.tglPengajuan);
                    $('.pengaju').append(data.pengaju);
                    $('.status').append(data.status);
                    $('.keterangan').append(data.keterangan);
                }
            });

            // view table
            $.ajax({
                type: 'GET',
                url: '{{ route("form.ga.peminjaman.table") }}',
                data: {
                    'id' : id
                },
                success: function(data){
                    $('#tabelPeminjaman').empty();
                    $('#tabelPeminjaman').append(data);
                }
            });

            $('.modalPerbaikan').modal('show');
        });

        // edit
        $(document).on('click', '.editSarana', function(){
            var id = $(this).data('id');
            
            $.ajax({
                type: 'GET',
                url: '{{ route("form.ga.peminjaman.editSarana") }}',
                data: {
                    'id' : id
                },
                success: function(data){
                    $('.modalPerbaikan').modal('hide');
                    $('.modalEdit').modal('show');
                    
                    $('.idForm').val(data.id);
                    $('.tglPengajuan').val(data.tgl);
                    $('.keterangan').val(data.keterangan);
                    $('.pukulA').val(data.pukulA);
                    $('.pukulB').val(data.pukulB);
                    
                    var sarana = '';
                    @foreach($sarana as $sarana)
                        var saranaId = {{ $sarana->id }}
                        if(saranaId == data.saranaId){
                            sarana += "<option value='{{ $sarana->id }}' selected>{{ $sarana->namaSarana }}</option>";
                        }else{
                            sarana += "<option value='{{ $sarana->id }}'>{{ $sarana->namaSarana }}</option>";
                        }
                    @endforeach

                    $('.fillSarana').empty();
                    $('.fillSarana').append(sarana);
                }
            });
        });

        // modal validasi
        $(document).on('click', '.modalVal', function(){
            $('#modalValidate').modal('show');
            var id = $(this).data('id');
            var val = $(this).data('val');

            switch (val) {
                case 1:
                    $('.valTitle').empty();
                    $('.valText').empty();
                    $('.alasan').empty();

                    $('.valTitle').append('ACC Form Peminjaman Sarana & Prasarana');
                    $('.valText').append("Masukkan NIK dan Password kepala bagian / leader GA untuk acc form desain tersebut");
                    break;

                case 2:
                    $('.valTitle').empty();
                    $('.valText').empty();
                    $('.alasan').empty();

                    $('.valTitle').append('Tolak Form Peminjaman Sarana & Prasarana');
                    $('.valText').append("Masukkan NIK dan Password kepala bagian / leader GA untuk tolak form desain tersebut");
                    $('.alasan').append('<label>Alasan</label><textarea name="keterangan" id="" class="form-control" rows="5"></textarea>');
                    break;
            
                default:
                    break;
            } 

            $('.idForm').val(id);
            $('.type').val(val);
        });

        // modal validasi
        $(document).on('click', '.modalStatus', function(){
            $('#modalStatus').modal('show');
            var id = $(this).data('id');
            var stat = $(this).data('stat');
            $('.idForm').val(id);
            console.log(stat);

            $("select option[value='"+stat+"']").attr("disabled",true);
        });

        // remove peminjaman
        $(document).on('click', '.remove-form-peminjaman', function () {
            var postId = $(this).data('id');
            swal({
                title: "Hapus Form Peminjaman?",
                text: "Form ini akan terhapus secara permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if(willDelete){
                    $.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': postId
                        },
                        url: "{{ route('form.ga.peminjaman.delete') }}",
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        });

        // remove sarana
        $(document).on('click', '.hapusSarana', function () {
            var postId = $(this).data('id');
            swal({
                title: "Hapus Data?",
                text: "Data ini akan terhapus secara permanen.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if(willDelete){
                    $.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': postId
                        },
                        url: "{{ route('form.ga.peminjaman.delete.sarana') }}",
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection