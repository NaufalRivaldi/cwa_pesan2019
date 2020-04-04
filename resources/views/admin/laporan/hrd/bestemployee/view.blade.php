@extends('admin.master')

@section('title', '- Hasil Poling')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <!-- <h2 class="pageheader-title">Data Hasil Poling</h2> -->
            <div class="page-breadcrumb">
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Hasil Poling</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="row">
    <div class="col-md-12">    
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Data Penilaian Best Employee</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mt-3">
      <div class="card-header">
        <a href="{{ route('laporan.hrd.penilaian.bestemp') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>            
      </div>
      <div class="card-body">
        <h4>{{ $karyawan->nama }}</h4>
        <p>{{ $karyawan->dep }}</p>
      </div>
    </div>
  </div>
</div>

<div class="row mt-3">
  @foreach($penilaian as $data)
  <div class="col-md-6">
    <div class="card mb-2">
      <div class="card-header">
        <h6>Departemen Penilai</h6>
        <p>{{ $data->user->dep }}</p>
        <h6>Periode Penilaian</h6>
        <p><span class="badge badge-success">{{ $data->periode->namaPeriode }}</span></p>
        
        <!-- form -->
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>Uraian Penilaian</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data->detailPenilaianEmployee as $detail)
            <tr>
              <td>{{ $detail->indikator->pertanyaan }}</td>
              <td><input type="number" class="form-control form-control-sm" min="1" max="10" required value="{{ $detail->nilai }}" disabled></td>
            </tr>
            @endforeach
            <tr>
              <td>t <small class="text-info">(Nilai = -4)</small></td>
              <td><input type="number" class="form-control form-control-sm" value="{{ $data->t }}" disabled></td>
            </tr>
            <tr>
              <td>ip <small class="text-info">(Nilai = -0)</small></td>
              <td><input type="number" class="form-control form-control-sm" value="{{ $data->ip }}" disabled></td>
            </tr>
            <tr>
              <td>ik <small class="text-info">(Nilai = -0)</small></td>
              <td><input type="number" class="form-control form-control-sm" value="{{ $data->ik }}" disabled></td>
            </tr>
            <tr>
              <td>p <small class="text-info">(Nilai = -5)</small></td>
              <td><input type="number" class="form-control form-control-sm" value="{{ $data->p }}" disabled></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Total</td>
              <td><input type="number" class="form-control form-control-sm" value="{{ $data->total }}" disabled></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@section('modal')

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
            url: "{{ route('pkk.kanidat.destroy') }}",
            data: {
              id: id,
              _token: '{{ csrf_token() }}'
            },
            success: function(data){
              location.reload()
            }
          })
        }
    });
  });
</script>

@endsection