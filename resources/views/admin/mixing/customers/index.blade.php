@extends('admin.master')

@section('title', '- Customers')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Pelanggan</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
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
        <a href="{{route('mixing.customers.form')}}" class="btn btn-primary btn-sm">
          <li class="fa fa-plus-circle">
          </li>
          Tambah
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="myTable">
          <thead>
            <tr>
              <th>No</th>
              <th>Member ID</th>
              <th>Nama</th>
              <th>Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$customer->memberId}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <td>
                  <a href="{{ route('mixing.customers.view', ['id'=>$customer->id]) }}" class="btn btn-sm btn-success fas fa-eye"></a>
                @if(auth()->user()->dep == 'IT')
                  <a href="{{ route('mixing.customers.edit', ['id'=>$customer->id]) }}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                  <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{ $customer->id }}"></button>  
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
                url: "{{ route('mixing.customers.delete') }}",
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