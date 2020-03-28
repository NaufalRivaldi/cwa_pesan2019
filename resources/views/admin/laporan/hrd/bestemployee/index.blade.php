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
      <!-- <div class="card-header">                          
        <h2>Data Hasil Poling</h2>
      </div> -->
      <form action="" method="get">
        <div class="card-header">
          <div class="row"> 
            <div class="col-sm-10">
              <select class="form-control" id="periodeId" name="periodeId" required>
                <option value="">Pilih</option>
                @foreach($periode as $p)
                  <option value="{{ $p->id }}" {{($_GET)?($_GET['periodeId']==$p->id)?'selected':'':''}}>{{$p->namaPeriode}}</option>
                @endforeach
              </select>                
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn col btn-success">Cari</button>
            </div> 
          </div>              
        </div>
      </form>
      <div class="card-header">          
        <?php
          $url = '';
          if ($_GET) {
            $url = '?'.$_SERVER['QUERY_STRING'];
          }
        ?>                    
        <div class="row">
          <div class="col-md-8">
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#resetModal"><i class="fas fa-recycle"></i> Reset Penilaian</button>
          </div>
          <div class="col-md-4">
            Penilaian : {{ $persentase }}%
            <div class="progress">
              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $persentase }}%"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="myTable custom-table table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Periode</th>
                <th>Skor</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            @php $no=1; @endphp
            @foreach($penilaian as $row)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->karyawan->nik }}</td>
                <td>{{ $row->karyawan->nama }}</td>
                <td>{{ $row->karyawan->dep }}</td>
                <td>{{ $row->periode->namaPeriode }}</td>
                <td>{{ $row->totalSkor }}</td>
                <td>
                  <a href="{{ route('laporan.hrd.penilaian.bestemp.view', ['periodeId' => $row->periodeId, 'karyawanId' => $row->karyawanId]) }}" class="btn btn-info btn-sm fas fa-eye"></a>
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
<!-- Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetModalLabel">Pilih Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('laporan.hrd.penilaian.bestemp.reset') }}" method="POST">
      @csrf
      <div class="modal-body">
        <select name="periodeId" id="periodeId" class="form-control" required>
          <option value="">Pilih</option>
          @foreach($periode as $prd)
          <option value="{{ $prd->id }}">{{ $prd->namaPeriode }}</option>
          @endforeach
        </select>          
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Reset</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
      </form>

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