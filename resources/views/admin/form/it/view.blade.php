@extends('admin.master')

@section('title', '- Penanganan IT')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">                       
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">View Penanganan IT</li>
                        </ol>
                    </nav>
                </div>            
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-success"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-2">
                              <b>Kode :</b>
                            </div>
                            <div class="col-md-10">
                              {{ $formPenangananIt->kode }}
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="col-md-2">
                              <b>Tanggal :</b>
                            </div>
                            <div class="col-md-10">
                              {{ Helper::setDate($formPenangananIt->tgl) }}
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="col-md-2">
                              <b>Departemen :</b>
                            </div>
                            <div class="col-md-10">
                              {{ $formPenangananIt->user->dep }}
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="col-md-2">
                              <b>Permasalahan :</b>
                            </div>
                            <div class="col-md-10">
                              {{ $formPenangananIt->masalah }}
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="col-md-2">
                              <b>Penyelesaian :</b>
                            </div>
                            <div class="col-md-10">
                              {{ $formPenangananIt->penyelesaian }}
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="col-md-2">
                              <b>Status :</b>
                            </div>
                            <div class="col-md-10">
                              {!! statusFormPenangananIt($formPenangananIt->stat) !!}
                            </div>
                          </div>
                          <hr>

                          <div class="row">
                            <div class="col-md-2">
                              <b>Progress :</b>
                            </div>
                            <div class="col-md-10">
                              
                              @if(count($formPenangananIt->detailFormPenangananIt) == 0)
                                <div class="timeline-container">
                                  <div class="timeline">
                                    <div class="timeline-rounded"></div>
                                    <div class="timeline-content">
                                      <h6>Pending</h6>
                                      <p>
                                        Form masih belum diacc oleh departemen IT.<br>
                                        <span class="badge badge-success">{{ $formPenangananIt->updated_at }}</span>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              @else
                                @foreach($formPenangananIt->detailFormPenangananIt as $row)
                                  <div class="timeline-container">
                                    <div class="timeline">
                                      <div class="timeline-rounded"></div>
                                      <div class="timeline-content">
                                        <h6>{{ $row->karyawanAll->nama }}</h6>
                                        <p>
                                          {{ $row->keterangan }}
                                          <br>
                                          <span class="badge badge-success">{{ $formPenangananIt->created_at }}</span>
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              @endif
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection