@extends('admin.master')

@section('title', '- Laporan HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Laporan Peminjaman Sarana & Prasarana</h3>
                    </div>
                    <div class="card-header">
                      
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="custom-table table table-striped myTableExport">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Tgl Selesai</th>
                                        <th>Dept</th>
                                        <th>Permintaan</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection