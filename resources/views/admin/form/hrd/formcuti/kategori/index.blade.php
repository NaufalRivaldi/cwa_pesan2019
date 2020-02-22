@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">                      
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Kategori Cuti</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('form.hrd.cuti.kategori.form') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a> 
                    <span id="insert-menu"></span>
                </div>
                <div class="card-body">
                    <!-- <div class="display-4">Data Kategori Cuti</div> -->
                    <!-- <br> -->
                    <div class="table-responsive">
                        <table class="myTable custom-table table table-hover">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Cuti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategoriCuti as $kCuti)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$kCuti->kategori}}</td>
                                    <td>{{$kCuti->jumlahCuti}}</td>
                                    <td>
                                        <a href="{{ route('form.hrd.cuti.kategori.edit', ['id'=>$kCuti->id]) }}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                                        <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{ $kCuti->id }}"></button>
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



@section('js')

    <script>
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
                url: "{{ route('form.hrd.cuti.kategori.delete') }}",
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