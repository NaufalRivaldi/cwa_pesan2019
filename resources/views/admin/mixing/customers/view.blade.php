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
        <a href="{{route('customers')}}" class="btn btn-success btn-sm">Kembali</a>
      </div>
      <div class="card-header">
        <table class="" width="100%">
            <tr>
                <td width="15%">Member ID</td>
                <td width="5%">:</td>
                <td>{{ $customer->memberId }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>:</td>
                <td>{{ $customer->phone }}</td>
            </tr>
        </table>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Cabang</th>
                <th>Produk</th>
                <th>Kemasan</th>
                <th>Kode Warna</th>
                <th>Base</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mixing as $mixing)
                <tr>
                <td data-id="{{$mixing->id}}" class="dataView">{{$no++}}</td>
                <td data-id="{{$mixing->id}}" class="dataView">{{date('d/m/Y', strtotime($mixing->created_at))}}</td>
                <td data-id="{{$mixing->id}}" class="dataView">{{$mixing->users->store->initial}}</td>
                <td data-id="{{$mixing->id}}" class="dataView">{{$mixing->product->name}}</td>
                <td data-id="{{$mixing->id}}" class="dataView">{{$mixing->unit}}</td>
                <td data-id="{{$mixing->id}}" class="dataView">{{$mixing->colorCode}}</td>
                <td data-id="{{$mixing->id}}" class="dataView">{{$mixing->base}}</td>
                <td>
                <p style="display:none">{{$mixing->customers->memberId}}</p>
                    <a href="{{ route('mixing.reorder', ['id' => $mixing->id]) }}" class="btn btn-sm btn-success">Reorder</a>
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

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <h3 class="display-6 merk"></h3>
          <div class="row">
            <div class="col-md-6">
              <label for="inputNama" class="col-form-label"><p>Tanggal : <span class="createdDate"></span></p></label>
            </div>
            <div class="col-md-6">
              <label for="inputNama" class="col-form-label"><p>Cabang : <span class="storeName"></span></p></label>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Produk</label>
                  <input id="inputNama" type="text" class="form-control product" name="productId" disabled>
              </div>
              <div class="form-group">
                <label for="inputNama">Base</label>
                <input id="inputNama" type="text" class="form-control base" name="base" disabled> 
              </div>
              <div class="row">
                <div class="col-md-6">                       
                <div class="form-group">
                  <label for="inputNama">Jumlah</label>
                  <input id="inputNama" type="text" class="form-control qty" name="qty" disabled>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Kemasan</label>
                  <input id="inputNama" type="text" class="form-control unit" name="unit" disabled>
                </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputNama">Kode Warna</label>
                <input id="inputNama" type="text" class="form-control colorCode" name="colorCode" disabled>
              </div>
              <div class="form-group">
                <label for="inputNama">Formula</label>
                <textarea name="formula" id="" cols="30" rows="4" class="form-control formula" disabled></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')

    <script>
      $(document).ready(function() {
        $('.delete').on('click',function() {            
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
                url: "{{ route('customers.delete') }}",
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
      });

      $(document).ready(function() {
        $('.dataView').on('click', function() {
          var id = $(this).data('id');
          $.ajax({
              url: '{{ route("mixing.view")}}',
              data: "id="+id,
              type: 'GET',              
              success: function(data) {
                $('#viewModal').modal('show');
                $('.product').val(data.productName);
                $('.base').val(data.base);
                $('.qty').val(data.qty);
                $('.unit').val(data.unit);
                $('.colorCode').val(data.colorCode);
                $('.formula').val(data.formula);
                $('.createdDate').empty();
                $('.createdDate').append(data.createDate);
                $('.storeName').empty();
                $('.storeName').append(data.storeName);
                $('.merk').empty();
                $('.merk').append(data.merk);
            }              
          });
        });
      });
    </script>

@endsection