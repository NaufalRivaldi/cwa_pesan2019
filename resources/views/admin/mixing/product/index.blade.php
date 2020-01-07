@extends('admin.master')

@section('title', '- Product')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Produk</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
              <a href="{{route('mixing.product.form')}}" class="btn btn-success btn-sm">Tambah Produk</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="myTable custom-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Mesin</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$product->merk->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>
                          <button class="btn btn-sm btn-info fas fa-eye baseModal" data-id="{{ $product->id }}" data-toggle="modal" data-target="#baseModal"></button>
                          <a href="{{ route('mixing.product.edit', ['id'=>$product->id]) }}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                          <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{ $product->id }}"></button>
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
<div class="modal fade" id="baseModal" tabindex="-1" role="dialog" aria-labelledby="baseModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Base</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button class="btn btn-sm btn-primary" id="linkFormBase" data-id="0">Tambah Base</button>
        <hr>
        <div class="fillBase">
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                url: "{{ route('mixing.product.delete') }}",
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

      $(document).on('click','.deleteBase', function() {    
          var id = $(this).data('id');
          // console.log(id);
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
                url: "{{ route('mixing.base.delete') }}",
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
      
      // modal 
      $(document).on('click', '.baseModal', function(){
        var productId = $(this).data('id');
        $('#linkFormBase').data('id', productId);

        // show base
        $.ajax({
            url: '{{ route("mixing.product.showBase")}}',
            data: "id="+productId,
            type: 'GET',              
            success: function(data) {
              $('.fillBase').empty();
              $('.fillBase').html(data);
          }              
        });
      });

      $(document).on('click', '#linkFormBase', function(){
        var productId = $(this).data('id');
        let url = "{{ route('mixing.base.form', ':productId') }}";
        url = url.replace(':productId', productId);
        document.location.href=url;
      });
    </script>

@endsection