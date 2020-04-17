@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">                       
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Cuti</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.hrd.cuti.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a> 
                    <span id="insert-menu"></span>
                    
                    <a href="{{ route('form.hrd.cuti.generate') }}" class="btn btn-success btn-sm" > Generate</a> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="myTable custom-table table table-hover">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Kategori Cuti</th>
                                    <th>Sisa Cuti</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cuti as $c)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$c->karyawan->nama}}</td>
                                        <td>{{$c->kategoriCuti->kategori}}</td>
                                        <td>{{$c->sisaCuti}}</td>
                                        <td>{{$c->periode}}</td>
                                        <td>{!!Helper::statusCuti($c->status)!!}</td>
                                        <td>
                                          <a href="{{route('form.hrd.cuti.edit', ['id'=>$c->id])}}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                                          <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{$c->id}}"></button>
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
<div class="modal fade" id="generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('form.hrd.cuti.generate')}}" method="post" id="formKategori">
        @csrf
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Kategori</label>
            <select class="form-control" id="exampleFormControlSelect1" name="idKategori">
              <option value="">Kategori...</option>
              @foreach($kategori as $k)
              <option value="{{$k->id}}">{{$k->kategori}}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submitKategori">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script>        
        $('.submitKategori').on('click', function() {
          $('#formKategori').submit();
        })

        
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
                url: "{{ route('form.hrd.cuti.delete') }}",
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

  </script>
@endsection