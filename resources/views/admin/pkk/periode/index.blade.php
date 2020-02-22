@extends('admin.master')

@section('title', '- Periode')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Periode</li>
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
              <a href=" {{ route('pkk.periode.form') }} " class="btn btn-primary btn-sm">
                <li class="fa fa-plus-circle">
                </li>
                Tambah
              </a>
              <form action="{{route('pkk.periode')}}" method="get" class="ml-auto" id="submitFilter">
                <select class="form-control-sm filter" name="kategori" id="exampleFormControlSelect1">
                  <option value="">Pilih Kategori...</option>
                  <option value="1" {{ ($_GET)?($_GET['kategori']) == 1 ?'selected':'':'' }}>Best Employee</option>
                  <option value="2" {{ ($_GET)?($_GET['kategori']) == 2 ?'selected':'':'' }}>Penilaian Kepala Departemen</option>
                  <option value="3" {{ ($_GET)?($_GET['kategori']) == 3 ?'selected':'':'' }}>Penilaian Kepala Toko</option>
                  <option value="4" {{ ($_GET)?($_GET['kategori']) == 4 ?'selected':'':'' }}>Survei Kepuasan Karyawan</option>
                  <option value="5" {{ ($_GET)?($_GET['kategori']) == 5 ?'selected':'':'' }}>Penilaian Karyawan</option>
                </select>
              </form>
            </div>
          </div>            
          <div class="card-body">
            <div class="table-responsive">
            <table class="table myTable custom-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($periode as $periode)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$periode->namaPeriode}}</td>
                    <td>{{Helper::setDate($periode->tglMulai)}}</td>
                    <td>{{Helper::setDate($periode->tglSelesai)}}</td>
                    <td>{!!Helper::statusPKK($periode->status)!!}</td>
                    <td>{!!Helper::kategoriPKK($periode->kategori)!!}</td>
                    <td>
                    @if($periode->status != 1)
                      <a href="{{ route('pkk.periode.status', ['id'=>$periode->id]) }}" class=""><li class="btn btn-success fa fa-check-circle btn-sm"></li></a>
                      <a href="#" class="activated"><li class="fa fa-edit btn btn-warning btn-sm"></li></a>
                    @else
                      <a href="{{ route('pkk.periode.status', ['id'=>$periode->id]) }}" class=""><li class="btn btn-danger btn-sm fa fa-times-circle"></li></a>
                      <a href="{{ route('pkk.periode.edit', ['id'=>$periode->id]) }}"><li class="fa fa-edit btn btn-warning btn-sm"></li></a>
                      <!-- <button class="fa fa-trash btn btn-danger delete" data-id="{{ $periode->id }}"></button> -->
                    </td>
                    @endif
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
          Swal.fire({
          title: 'Perhatian!',
          text: "Apakah anda yakin menghapus data ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "POST",
                url: "{{route('pkk.periode.delete')}}",
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