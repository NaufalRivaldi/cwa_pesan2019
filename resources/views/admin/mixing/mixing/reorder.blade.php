@extends('admin.master')

@section('title', '- Mixing')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">
            Reorder Mixing
            </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{route('mixing.mixing')}}"><li class="breadcrumb-item" aria-current="page">Mixing</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<!-- <div class="container"> -->
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <h3 class="card-header">Form Mixing</h3>
      <div class="card">
        <div class="card-body">          
              <form action="{{route('mixing.mixing.add')}}" method="post">
                <!-- read id -->
                {{csrf_field()}}
                <input type="hidden" value="{{ $customer->id }}" name="customersId">                 
                <div class="form-group">
                  <label for="inputNama" class="col-form-label"><h4>Pelanggan</h4></label>
                  <div class="row">
                    <input type="hidden" value="{{ $customer->id }}" class="idCust" name="customersId">                    
                    <div class="col-sm-3 mb-1">
                      <label for="customerMemberId">Member ID</label>
                      <input id="inputNama" type="text" class="form-control memberIdC" value="{{ $customer->memberId }}" id="memberIdC" readonly>
                    </div>
                    <div class="col-sm-1 mb-1">     
                      <label for="searchCust" class="searchCst">&nbsp;</label>               
                      <button type="button" class="btn btn-success fas fa-search btn-lg" id="searchCust" data-toggle="modal" data-target="#exampleModal">
                      </button>
                    </div> 
                    <div class="col-sm-4 mb-1">
                      <label for="customerName">Nama</label>
                      <input id="inputNama" type="text" class="form-control nameC" value="{{ $customer->name }}" id="nameC" readonly>                      
                      @if($errors->has('name'))
                      <div class="text-danger">
                        {{ $errors->first('name') }}
                      </div>
                      @endif
                    </div>           
                    <div class="col-sm-4 mb-1">
                      <label for="customerPhone">Phone</label>
                      <input id="inputNama" type="text" class="form-control phoneC" value="{{ $customer->phone }}" id="phoneC" readonly>
                    </div>                
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputMerk">Mesin <span class="text-danger"></span></label>
                      <input type="hidden" class="form-control" name="merkId" value="{{$mixing->product->merk->id}}">
                      <input type="text" class="form-control" name="" value="{{$mixing->product->merk->name}}" readonly>
                        @if($errors->has('productId'))
                        <div class="text-danger">
                          {{ $errors->first('productId') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Produk <span class="text-danger">*Pilih mesin terlebih dahulu</span></label>
                      <input type="hidden" class="form-control" name="productId" value="{{$mixing->productId}}">
                      <input type="text" class="form-control" name="" value="{{$mixing->product->name}}" readonly>
                        @if($errors->has('productId'))
                        <div class="text-danger">
                          {{ $errors->first('productId') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="inputNama">Base</label>
                      <input readonly id="inputNama" type="text" class="form-control" name="base" value="{{ $mixing->base }}">                  
                      @if($errors->has('base'))
                      <div class="text-danger">
                        {{ $errors->first('base') }}
                      </div>
                      @endif
                    </div>
                    <div class="row">
                     <div class="col-md-6">                       
                      <div class="form-group">
                        <label for="inputNama">Jumlah</label>
                        <input readonly id="inputNama" type="text" class="form-control" name="qty" value="{{ $mixing->qty }}">                 
                        @if($errors->has('qty'))
                        <div class="text-danger">
                          {{ $errors->first('qty') }}
                        </div>
                        @endif
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Kemasan</label>
                        <input type="hidden" value="{{$mixing->unit}}" name="unit">                        
                        <input type="text" class="form-control" value="{{$mixing->unit}}" name="" readonly>
                        @if($errors->has('unit'))
                          <div class="text-danger">
                              {{ $errors->first('unit') }}
                          </div>
                        @endif
                      </div>
                     </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputNama">Kode Warna</label>
                      <input readonly id="inputNama" type="text" class="form-control" name="colorCode" value="{{ $mixing->colorCode }}">                 
                        @if($errors->has('colorCode'))
                        <div class="text-danger">
                          {{ $errors->first('colorCode') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="inputNama">Nama Warna</label>
                      <input readonly id="inputNama" type="text" class="form-control" name="colorName" value="{{ $mixing->colorName }}">                 
                        @if($errors->has('colorCode'))
                        <div class="text-danger">
                          {{ $errors->first('colorCode') }}
                        </div>
                        @endif
                    </div>
                    <h4 class="mt-4">Formula <span class="text-danger">*Pilih mesin terlebih dahulu</span></h4>
                    <span class="row fillFormula">
                        @foreach($formula as $formula)
                        <div class="col-md-3">
                          <div class="form-group">
                              @if($formula->nilai != 0)
                              <label for="inputNama">{{ $formula->formula->color }}</label>
                              <input type="hidden" class="form-control" name="formulaId[]" value="{{ $formula->formulaId }}">
                              <input readonly type="text" class="form-control" name="nilai[]" value="{{ $formula->nilai }}">
                              @else                              
                              <input type="hidden" class="form-control" name="formulaId[]" value="{{ $formula->formulaId }}">
                              <input readonly type="hidden" class="form-control" name="nilai[]" value="{{ $formula->nilai }}">
                              @endif
                          </div>
                        </div>
                        @endforeach
                    </span>
                  </div>
                </div>                   
                <input type="submit" value="Simpan" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-danger">
              </form>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
@endsection

@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table myTable custom-table">
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
                <button class="btn btn-warning modalBtn btn-sm" data-id="{{$customer->id}}" type="button">Pilih</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script>
      $(document).ready(function() {
        $('.modalBtn').on('click', function() {
          var id = $(this).data('id');
          $.ajax({
              url: '{{ route("mixing.mixing.fill")}}',
              data: "id="+id,
              type: 'GET',              
              success: function(data) {
                var json = data
                $('#exampleModal').modal('hide');
                $('.idCust').val(json.id);
                $('.nameC').val(json.name);
                $('.phoneC').val(json.phone);
                $('.memberIdC').val(json.memberId);
            }              
          });
        });

        // show product
        $('.merkId').on('change', function(){
          var merkId = $(this).val();
          $.ajax({
              url: '{{ route("mixing.mixing.showProduct")}}',
              data: "id="+merkId,
              type: 'GET',              
              success: function(data) {
                $('.fillProduct').empty();
                $('.fillProduct').append(data);
            }              
          });
        });

        // show formula
        $('.merkId').on('change', function(){
          var merkId = $(this).val();
          $.ajax({
              url: '{{ route("mixing.mixing.showFormula")}}',
              data: "id="+merkId,
              type: 'GET',              
              success: function(data) {
                console.log(data);
                $('.fillFormula').empty();
                $('.fillFormula').append(data);
            }              
          });
        });
      });
    </script>
@endsection