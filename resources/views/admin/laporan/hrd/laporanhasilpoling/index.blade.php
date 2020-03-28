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
                    <li class="breadcrumb-item active" aria-current="page">Data Hasil Poling</li>
                </ol>
            </nav>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="poling-tab" data-toggle="tab" href="#poling" role="tab" aria-controls="poling" aria-selected="true">Poling</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="kanidat-tab" data-toggle="tab" href="#kanidat" role="tab" aria-controls="kanidat" aria-selected="false">Kandidat</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="poling" role="tabpanel" aria-labelledby="poling-tab">
            <div class="card mt-3">
              <!-- <div class="card-header">                          
                <h2>Data Hasil Poling</h2>
              </div> -->
              <form action="" method="get">
                <div class="card-header">
                  <div class="row"> 
                    <div class="col-sm-10">
                      <select class="form-control" id="periodeId" name="periodeId">
                          @foreach($searchPeriode as $p)
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
                    <a href="{{ route('laporan.hrd.hasilpoling.detail').$url }}" class="btn btn-sm btn-primary">Detail Poling</a>
                    <a href="{{ route('laporan.hrd.hasilpoling.export').$url }}" class="btn btn-sm btn-success">Export <i class="far fa-file-excel"></i></a>
                    <a href="{{ route('pkk.kanidat.import', ['periodeId' => $periode]) }}" class="btn btn-sm btn-warning">Set Kandidat <i class="far fa-user"></i></a>
                  </div>
                  <div class="col-md-3">
                    Penilaian : {{ $persentase }}%
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $persentase }}%"></div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <button class="btn btn-info btn-sm fas fa-eye mt-3" data-toggle="modal" data-target="#exampleModal"></button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <table class="myTable custom-table table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Periode</th>
                        <th>Departemen</th>
                        <th>Skor</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($dep as $d)
                          <?php
                            $skor = 0;
                          ?>                        
                      @foreach(Helper::laporanHasilPoling($d) as $hasil)
                        @if($d == $hasil->karyawan->dep)                       
                          @if($skor <= $hasil->skor)
                            <?php 
                              $skor = $hasil->skor;
                            ?>
                            <tr>
                              <td>{{$no++}}</td>
                              <td>{{$hasil->karyawan->nama}}</td>
                              <td>{{$hasil->poling->periode->namaPeriode}}</td>
                              <td>{{$hasil->karyawan->dep}}</td>
                              <td>{{$hasil->skor}}</td>
                          </tr>
                          @endif                      
                        @endif
                      @endforeach
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="kanidat" role="tabpanel" aria-labelledby="kanidat-tab">
          <div class="card mt-3">
              <div class="card-header">          
                <h5>Kandidat Best Employee</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <table class="myTable custom-table table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Periode</th>
                        <th>Skor</th>
                        <th>t</th>
                        <th>ip</th>
                        <th>ik</th>
                        <th>p</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no1 = 1 @endphp
                    @foreach($kanidat as $knd)
                      <tr>
                        <td>{{ $no1++ }}</td>
                        <td>{{ $knd->karyawan->nama }}</td>
                        <td>{{ $knd->periode->namaPeriode }}</td>
                        <td>{{ $knd->poin }}</td>
                        <td>{{ $knd->t }}</td>
                        <td>{{ $knd->ip }}</td>
                        <td>{{ $knd->ik }}</td>
                        <td>{{ $knd->p }}</td>
                        <td>
                          <a href="{{ route('pkk.kanidat.edit', ['id'=>$knd->id]) }}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                          <button class="btn btn-sm btn-danger far fa-trash-alt delete" data-id="{{ $knd->id }}"></button>  
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
    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Persentase Penilaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped custom-table" id="myTable2">
          <thead>
            <tr>
              <th>No</th>
              <th>Departemen</th>
              <th>Jumlah Karyawan</th>
              <th>Jumlah Telah Menilai</th>
              
            </tr>
          </thead>
          <tbody>
            <?php $no1 = 1; $jmlKaryawan = 0; $jmlPenilai = 0; ?>
            @foreach($dep as $d)
            <tr>
              <td>{{ $no1++ }}</td>
              <td>{{ $d }}</td>
              <td>{{ Helper::jmlKaryawan($d) }}</td>
              <td>{{ Helper::jmlPenilai($d) }}</td>
              <?php
                $jmlKaryawan += Helper::jmlKaryawan($d);
                $jmlPenilai += Helper::jmlPenilai($d);
              ?>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" class="font-weight-bold text-center">Total</td>
              <td>{{ $jmlKaryawan }}</td>
              <td>{{ $jmlPenilai }}</td>
            </tr>
          </tfoot>
        </table>
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