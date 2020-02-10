@extends('admin.master')

@section('title', '- Kuesioner')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
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
          <div class="container">
            <div class="card-header row">
              <a href="{{ route('pkk.kuisioner.form') }}" class="btn btn-primary btn-sm">
                <li class="fa fa-plus-circle">
                </li>
                Tambah
              </a>              
              <form action="{{route('pkk.kuisioner')}}" method="get" class="ml-auto" id="submitFilter">
                <select class="form-control-sm filter" name="kategori" id="exampleFormControlSelect1">
                  <option value="">Pilih Kategori...</option>
                  <option value="1" {{ ($_GET)?($_GET['kategori']) == 1 ?'selected':'':'' }}>Best Employee</option>
                  <option value="2" {{ ($_GET)?($_GET['kategori']) == 2 ?'selected':'':'' }}>Penilaian Kepala Departemen</option>
                  <option value="3" {{ ($_GET)?($_GET['kategori']) == 3 ?'selected':'':'' }}>Penilaian Kepala Toko</option>
                  <option value="4" {{ ($_GET)?($_GET['kategori']) == 4 ?'selected':'':'' }}>Survei Kepuasan Karyawan</option>
                </select>
              </form>
            </div>
          </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable table custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Pertanyaan</th>
                      <th>Status</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($kuisioner as $kuisioner)
                    <tr>
                      <td>{{$no++}}</td>
                      <td width="50%">{{$kuisioner->pertanyaan}}</td>
                      <td>{!!Helper::statusPKK($kuisioner->status)!!}</td>
                      <td>{!!Helper::kategoriPKK($kuisioner->kategori)!!}</td>
                      <td>
                      @if($kuisioner->status != 1)
                        <a href="{{ route('pkk.kuisioner.status', ['id'=>$kuisioner->id]) }}" class="btn btn-success fa fa-check-circle btn-sm"><i class=""></i></a>
                        <a href="#" class="activated"><i class="fa fa-edit btn btn-warning btn-sm"></i></a>
                      @else
                        <a href="{{ route('pkk.kuisioner.status', ['id'=>$kuisioner->id]) }}" class=""><i class="btn btn-danger btn-sm fa fa-times-circle"></i></a>
                        <!-- <button class="fa fa-trash btn btn-danger delete" data-id="{{ $kuisioner->id }}"></button> -->
                        <a href="{{ route('pkk.kuisioner.edit', ['id'=>$kuisioner->id]) }}"><i class="btn btn-sm btn-warning fas fa-edit"></i></a>
                      @endif
                        
                      @if(auth()->user()->dep == 'IT')
                        <button class="btn btn-sm btn-danger far fa-trash-alt delete"data-id="{{ $kuisioner->id }}"></button>
                      @endif 
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