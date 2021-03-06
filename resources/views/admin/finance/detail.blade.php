@extends('admin.master')

@section('title', '- Finance')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{url('/admin/finance/')}}"><li class="breadcrumb-item" aria-current="page">Finance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/admin/finance/') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <!-- table -->
                    @if($dep == 'IT' || $dep == 'Finance' || $dep == 'SCM')
                        <h3>Download Penjualan</h3>                        
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($finance))
                                        @foreach($finance as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->file_name }}</td>
                                            <td>
                                                <a href="{{ asset('file-finance/'.$data->file_name) }}" class="btn btn-success btn-sm">Unduh  <i class=" fas fa-download"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection