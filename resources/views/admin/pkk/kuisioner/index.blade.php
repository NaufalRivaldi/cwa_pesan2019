@extends('admin.master')

@section('title', '- Kuesioner')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Kuesioner</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <a href="{{ route('pkk.kuisioner.form') }}" class="btn btn-primary btn-sm">
                <li class="fa fa-plus-circle">
                </li>
                Tambah
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Pertanyaan</th>
                      <th>Status</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  @foreach($kuisioner as $kuisioner)
                  <tbody>
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$kuisioner->pertanyaan}}</td>
                      <td>{!!Helper::statusPKK($kuisioner->status)!!}</td>
                      <td>{!!Helper::kategoriPKK($kuisioner->kategori)!!}</td>
                      <td>
                      @if($kuisioner->status != 1)
                        <a href="{{ route('pkk.kuisioner.status', ['id'=>$kuisioner->id]) }}" class=""><li class="btn btn-success fa fa-check-circle btn-sm"></li></a>
                        <a href="#" class="activated"><li class="fa fa-edit btn btn-warning btn-sm"></li></a>
                      @else
                        <a href="{{ route('pkk.kuisioner.status', ['id'=>$kuisioner->id]) }}" class=""><li class="btn btn-danger btn-sm fa fa-times-circle"></li></a>
                        <!-- <button class="fa fa-trash btn btn-danger delete" data-id="{{ $kuisioner->id }}"></button> -->
                        <a href="{{ route('pkk.kuisioner.edit', ['id'=>$kuisioner->id]) }}"><li class="btn btn-sm btn-warning fas fa-edit"></li></a>
                      @endif
                        
                        @if(auth()->user()->dep == 'IT')
                        <button class="btn btn-sm btn-danger fas fa-trash delete"data-id="{{ $kuisioner->id }}"></button>
                        @endif 
                      </td>                     
                      
                    </tr>                    
                  </tbody>
                  @endforeach
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script>
      $(document).on('click','.delete',function() {    
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
                url: "{{ route('pkk.kuisioner.delete') }}",
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
    </script>

@endsection