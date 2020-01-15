@extends('admin.master')

@section('title', '- Formula')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Formula</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Formula</li>
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
        <a href="{{ route('mixing.formula') }}" class="btn btn-success btn-sm"><li class="fa fa-angle-left"></li></a>
        <a href="{{ route('mixing.formula.formbymerk', ['merkId'=>$merk->id]) }}" class="btn btn-primary btn-sm">
          <li class="fa fa-plus-circle">
          </li>
          Tambah
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <h3 class="display-6">{{ $merk->name }}</h3>
        <table class="table myTable custom-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Warna</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($formula as $formula)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $formula->color }}</td>
                    <td>
                        <a href="{{ route('mixing.formula.edit', ['id'=>$formula->id]) }}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                        <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{ $formula->id }}"></button>
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
          // console.log(id);
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
                url: "{{ route('mixing.formula.delete') }}",
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