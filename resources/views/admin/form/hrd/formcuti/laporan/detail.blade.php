@extends('admin.master')

@section('title', '- Laporan HRD')

@section('content')
    <div class="row">
      <div class="col-12">
      
      <div class="card">

          <div class="card-header">
            <a href="{{url()->previous()}}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
          </div>
          
          <div class="card-body">
              <h3 class="display-4">Kartu Cuti</h3>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <td width="10%">Nama</td>
                  <td width="1%">:</td>
                  <td class="namaKaryawanCuti">{{$cuti->karyawan->nama}}</td>
                </tr>
                <tr>
                  <td>Departemen</td>
                  <td>:</td>
                  <td class="departemenCuti">{{$cuti->karyawan->dep}}</td>
                </tr>
                <tr>
                <tr>
                  <td>Sisa Cuti</td>
                  <td>:</td>
                  <td class="sisaCuti">{{$cuti->sisa}}</td>
                </tr>
              </table>
              <table id="myTable" class="custom-table table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Cuti</th>
                        <th>Periode</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailCuti as $detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{!!Helper::setDate($detail->tanggalCuti)!!}</td>
                            <td>{{ $detail->cuti->periode }}</td>
                            <td>{{ $detail->cuti->kategoriCuti->kategori }}</td>
                            <td>{{ $detail->keterangan }}</td>
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

@endsection

@section('js')
<script>
    
</script>
@endsection