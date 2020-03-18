@extends('admin.master')

@section('title', '- Mixing')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">
            <!-- Input Data Mixing -->
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
      <div class="card">     
      <div class="card-header">
          <a href="{{ route('mixing.mixing') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
      </div>
        <div class="card-body">      
              <form action="{{route('mixing.mixing.add')}}" method="post">
                <!-- read id -->
                {{csrf_field()}}
                <input type="hidden" value="" name="">                 
                <div class="form-group">
                  <label for="inputPelanggan" class="col-form-label"><h4>Pelanggan</h4></label>
                  <div class="row">
                    <input type="hidden" value="" class="idCust" name="customersId">                
                    <div class="col-sm-3 mb-1">
                      <label for="customerMemberId">Member ID</label>
                      <input id="inputMemberId" type="text" class="form-control memberIdC" value="" id="memberIdC" readonly required>
                    </div>
                    <div class="col-sm-1 mb-1">     
                      <label for="searchCust" class="searchCst">&nbsp;</label>               
                      <button type="button" class="btn btn-success fas fa-search btn-lg" id="searchCust" data-toggle="modal" data-target="#exampleModal">
                      </button>
                    </div>                  
                    <div class="col-sm-4 mb-1">
                      <label for="inputCustomerName">Nama</label>
                      <input id="inputCustomerName" type="text" class="form-control nameC" value="" id="nameC" readonly required>                      
                      @if($errors->has('customersId'))
                      <div class="text-danger">
                        {{ $errors->first('customersId') }}
                      </div>
                      @endif
                    </div>                
                    <div class="col-sm-4 mb-1">
                      <label for="inputCustomerPhone">Phone</label>
                      <input id="inputCustomerPhone" type="text" class="form-control phoneC" value="" id="phoneC" readonly required>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputMerk">Tanggal Mixing <span class="text-danger"></span></label>
                        <input type="date" name="tglMixing" id="" class="form-control" required>                
                        @if($errors->has('tglMixing'))
                        <div class="text-danger">
                          {{ $errors->first('tglMixing') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="inputMerk">Mesin <span class="text-danger"></span></label>
                      <select class="form-control merkId" id="inputMerk" name="merkId" required>
                      <option value=""></option>
                      @foreach($merks as $merk)
                        <option value="{{ $merk->id }}">{{ $merk->name }}</option>
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
                      <select class="form-control fillProduct productId" id="exampleFormControlSelect1" name="productId" required>
                        
                      </select>                
                        @if($errors->has('productId'))
                        <div class="text-danger">
                          {{ $errors->first('productId') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect2">Base <span class="text-danger">*Pilih produk terlebih dahulu</span></label>
                      <select class="form-control fillBase" id="exampleFormControlSelect2" name="baseId" required>
                        
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
                        <input id="inputJumlah" type="text" class="form-control" name="qty" required>                 
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
                        <select class="form-control" id="exampleFormControlSelect3" name="unit" required>
                          <option value="">Pilih</option>
                          <option value="PAIL">PAIL</option>
                          <option value="GALON">GALON</option>
                          <option value="KG">KG</option>
                          <option value="LITER">LITER</option>
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
                      <input id="inputKodeWarna" type="text" class="form-control" name="colorCode" required>                 
                        @if($errors->has('colorCode'))
                        <div class="text-danger">
                          {{ $errors->first('colorCode') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                      <label for="inputNamaWarna">Nama Warna</label>
                      <input id="inputNamaWarna" type="text" class="form-control" name="colorName" required>                 
                        @if($errors->has('colorName'))
                        <div class="text-danger">
                          {{ $errors->first('colorName') }}
                        </div>
                        @endif
                    </div>
                    <label for="exampleFormControlSelect1">Formula <span class="text-danger">*Pilih mesin terlebih dahulu</span></label>
                    <div class="row fillFormula">
                        <!-- <span class=""></span> -->
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
        <div class="card">
          <div class="card-header">
            <a href="{{route('mixing.customers.form')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
          </div>
          <div class="card-body">
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
        </div>        
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