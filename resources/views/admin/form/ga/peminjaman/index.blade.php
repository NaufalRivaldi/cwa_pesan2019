@extends('admin.master')

@section('title', '- Perbaikan Sarana & Prasarana')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">                                   
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Perbaikan Sarana & Prasarana</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <!-- <div class="card-header">
                        <h2>Perbaikan Sarana & Prasarana</h2>
                    </div> -->
                    <div class="card-header">
                        <a href="{{ route('form.ga.perbaikan.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Form</a>
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
                                    <?php $no = 1; ?>
                                    @foreach($formProgress as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}" data-id="{{ $data->id }}">{{ Helper::setDate($data->tglPengajuan) }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{{ $data->user->dep }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{{ $data->permintaan }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{!! Helper::statusPerbaikan($data->status) !!}</td>
                                            <td>
                                            @if(auth()->user()->dep == 'GA')
                                                @if($data->status > 1 && $data->status != 4 && $data->status != 5)
                                                    <button class="btn btn-success btn-sm modalStatus" data-id="{{ $data->id }}" data-stat="{{ $data->status }}"><i class="fas fa-exchange-alt"></i></button>
                                                @elseif($data->status == 1)
                                                    <button class="btn btn-success btn-sm modalVal" data-id="{{ $data->id }}" data-val="1"><i class="fas fa-user-check"></i></button>
                                                    <button class="btn btn-danger btn-sm modalVal" data-id="{{ $data->id }}" data-val="2"><i class="fas fa-times-circle"></i></button>
                                                @endif
                                                
                                            @endif
                                            @if(auth()->user()->id == $data->userId)
                                                <a href="#" class="remove-form-perbaikan" data-id="{{ $data->id }}"><i class="btn btn-danger btn-sm far fa-trash-alt"></i></a>
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
                                        <th>Tgl Pelaporan</th>
                                        <th>Tgl Selesai</th>
                                        <th>Dept</th>
                                        <th>Permintaan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($formSelesai as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{{ Helper::setDate($data->tglPengajuan) }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{{ Helper::setDate($data->tglSelesai) }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{{ $data->user->dep }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{{ $data->permintaan }}</td>
                                            <td class="modalClick" data-id="{{ $data->id }}">{!! Helper::statusPerbaikan($data->status) !!}</td>
                                            <td>{{ $data->keterangan }}</td>
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
        <h3 class="modal-title">Form Perbaikan Sarana & Prasarana</h3>
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
        </table>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="permintaan">Permintaan</label>
                    <textarea name="permintaan" id="permintaan" disabled rows="5" class="form-control permintaan"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea name="alasan" id="alasan" disabled rows="5" class="form-control alasan"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" disabled rows="5" class="form-control keterangan"></textarea>
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
                <form action="{{ route('form.ga.perbaikan.validasi') }}" method="POST">
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
@endsection

@section('js')
    <script>
       // view
       $(document).on('click', '.modalClick', function(){
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("form.ga.perbaikan.view") }}',
                data: "id="+id,
                type: 'GET',
                success: function(data){
                    console.log(data.status);
                    $('.tglPengajuan').empty();
                    $('.pengaju').empty();
                    $('.status').empty();
                    $('.tglSelesai').empty();
                    
                    $('.tglPengajuan').append(data.tglPengajuan);
                    $('.pengaju').append(data.pengaju);
                    $('.status').append(data.status);
                    $('.permintaan').val(data.permintaan);
                    $('.alasan').val(data.alasan);
                    $('.keterangan').val(data.keterangan);

                    if(data.tglSelesai != data.tglPengajuan){
                        $('.tglSelesai').append('<td>Tgl Selesai</td><td>:</td><td>'+data.tglSelesai+'</td>');
                    }
                }
            });
            $('.modalPerbaikan').modal('show');
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

                    $('.valTitle').append('ACC Form Perbaikan Sarana & Prasarana');
                    $('.valText').append("Masukkan NIK dan Password kepala bagian / leader GA untuk acc form desain tersebut");
                    break;

                case 2:
                    $('.valTitle').empty();
                    $('.valText').empty();
                    $('.alasan').empty();

                    $('.valTitle').append('Tolak Form Perbaikan Sarana & Prasarana');
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

        // remove perbaikan
        $(document).on('click', '.remove-form-perbaikan', function () {
            var postId = $(this).data('id');
            swal({
                title: "Hapus Form Perbaikan?",
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
                        url: "{{ route('form.ga.perbaikan.delete') }}",
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        });

        $(document).on('change', '.statusForm', function(){
            var stat = $(this).val();
            if(stat == 4){
                $('.fillTgl').append('<label>Tanggal Selesai</label><input type="date" name="tglSelesai" class="form-control">');
            }else{
                $('.fillTgl').empty();
            }
        });
    </script>
@endsection