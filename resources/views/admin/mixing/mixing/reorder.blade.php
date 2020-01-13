@extends('admin.master')

@section('title', '- Mixing')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">
            Input Data Mixing
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
                <div class="form-group">
                  <label for="inputPelanggan" class="col-form-label"><h4>Pelanggan</h4></label>
                  <div class="row">
                    <input type="hidden" value="{{$customer->id}}" class="idCust" name="customersId">                
                    <div class="col-sm-3 mb-1">
                      <label for="customerMemberId">Member ID</label>
                      <input id="inputMemberId" type="text" class="form-control memberIdC" value="{{$customer->memberId}}" id="memberIdC" readonly>
                    </div>                  
                    <div class="col-sm-5 mb-1">
                      <label for="inputCustomerName">Nama</label>
                      <input id="inputCustomerName" type="text" class="form-control nameC" value="{{$customer->name}}" id="nameC" readonly>                      
                      @if($errors->has('customersId'))
                      <div class="text-danger">
                        {{ $errors->first('customersId') }}
                      </div>
                      @endif
                    </div>                
                    <div class="col-sm-4 mb-1">
                      <label for="inputCustomerPhone">Phone</label>
                      <input id="inputCustomerPhone" type="text" class="form-control phoneC" value="{{$customer->phone}}" id="phoneC" readonly>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputMerk">Mesin <span class="text-danger"></span></label>
                      <select class="form-control merkId" id="inputMerk" name="merkId">
                      <option value=""></option>
                      @foreach($merks as $merk)
                        <option value="{{ $merk->id }}" {{($mixing->product->merk->id == $merk->id)?'selected':''}} >{{ $merk->name }}</option>
                      @endforeach
                      </select>                
                        @if($errors->has('merkId'))
                        <div class="text-danger">
                          {{ $errors->first('merkId') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Produk <span class="text-danger">*Pilih mesin terlebih dahulu</span></label>
                      <select class="form-control fillProduct productId" id="exampleFormControlSelect1" name="productId">
                      @foreach($products as $product)
                        <option value="{{ $product->id }}" {{($mixing->product->id == $product->id)?'selected':''}} >{{ $product->name }}</option>
                      @endforeach
                      </select>                
                        @if($errors->has('productId'))
                        <div class="text-danger">
                          {{ $errors->first('productId') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect2">Base <span class="text-danger">*Pilih produk terlebih dahulu</span></label>
                      <select class="form-control fillBase" id="exampleFormControlSelect2" name="baseId">
                      @foreach($base as $base)
                        <option value="{{ $base->id }}" {{($mixing->base->id == $base->id)?'selected':''}} >{{ $base->name }}</option>
                      @endforeach
                      </select>                  
                      @if($errors->has('baseId'))
                      <div class="text-danger">
                        {{ $errors->first('baseId') }}
                      </div>
                      @endif
                    </div>
                    <div class="row">
                     <div class="col-md-6">                       
                      <div class="form-group">
                        <label for="inputJumlah">Jumlah</label>
                        <input id="inputJumlah" type="text" class="form-control" name="qty" value="{{$mixing->qty}}">                 
                        @if($errors->has('qty'))
                        <div class="text-danger">
                          {{ $errors->first('qty') }}
                        </div>
                        @endif
                      </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect3">Kemasan</label>
                        <select class="form-control" id="exampleFormControlSelect3" name="unit">
                          <option value="">Pilih</option>
                          <option value="PAIL" {{($mixing->unit == 'PAIL')?'selected':''}}>PAIL</option>
                          <option value="GALON" {{($mixing->unit == 'GALON')?'selected':''}}>GALON</option>
                          <option value="KG" {{($mixing->unit == 'KG')?'selected':''}}>KG</option>
                          <option value="LITER" {{($mixing->unit == 'LITER')?'selected':''}}>LITER</option>
                        </select>
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
                      <label for="inputKodeWarna">Kode Warna</label>
                      <input id="inputKodeWarna" type="text" class="form-control" name="colorCode" value="{{$mixing->colorCode}}">                 
                        @if($errors->has('colorCode'))
                        <div class="text-danger">
                          {{ $errors->first('colorCode') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="inputNamaWarna">Nama Warna</label>
                      <input id="inputNamaWarna" type="text" class="form-control" name="colorName" value="{{$mixing->colorName}}">                 
                        @if($errors->has('colorName'))
                        <div class="text-danger">
                          {{ $errors->first('colorName') }}
                        </div>
                        @endif
                    </div>
                    <label for="exampleFormControlSelect1">Formula <span class="text-danger">*Pilih mesin terlebih dahulu</span></label>
                    <div class="row fillFormula">
                    @foreach($formula as $formula)
                    <div class="col-md-3">
                    <label for="exampleFormControlSelect3" style="font-size:0.7em">{{$formula->formula->color}}</label>
                        <div class="form-group">                    
                            <input {{($formula->nilai != 0)?'checked':''}} type="checkbox" class="form-check-input mt-2 select" value="" data-id="'{{$formula->formula->id}}'" data-class="cb{{$formula->formula->id}}" onclick="ifChecked(this)">
                            <input type="hidden" class="form-control" name="formulaId[]" value="{{$formula->formula->id}}">
                            <input type="text" class="form-control form-control-sm cb{{$formula->formula->id}}" name="nilai[]" id="inputBox
                            " value="{{$formula->nilai}}" {{($formula->nilai != 0)?'':'readonly'}}>               
                        </div>
                    </div>
                    @endforeach                    
                    </div>
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
        <a href="{{route('mixing.customers.form')}}" class="btn btn-success btn-sm mb-3">Tambah Pelanggan</a>
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
      $(document).on('click', '.modalBtn', function() {
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

      $(document).ready(function() {
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

        // show base
        $('.productId').on('change', function(){
          var productId = $(this).val();
          $.ajax({
              url: '{{ route("mixing.mixing.showBase")}}',
              data: "id="+productId,
              type: 'GET',              
              success: function(data) {
                $('.fillBase').empty();
                $('.fillBase').append(data);
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
                $('.fillFormula').empty();
                $('.fillFormula').append(data);
            }              
          });
        });

      });      

      //if checked
      function ifChecked(e) {
        var id = $(e).data('id');
        var nameClass = $(e).data('class');

        if($(e).prop("checked") == true){
          $('.'+nameClass).removeAttr('readonly')
        }
        else if($(e).prop("checked") == false){          
          $('.'+nameClass).attr('readonly',true)
        }
      }

      function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

    </script>
@endsection