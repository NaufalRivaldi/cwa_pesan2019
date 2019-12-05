@extends('admin.master')

@section('title', '- Finance')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Finance</h3>
                </div>
                <div class="card-body">
                    <!-- table -->
                    @if($dep == 'IT' || $dep == 'Finance')
                        <h3>Download Penjualan</h3>
                        <a href="{{ url('/admin/finance/') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
                                                <a href="{{ asset('file-finance/'.$data->file_name) }}" class="btn btn-success btn-sm">Unduh</a>
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