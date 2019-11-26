@extends('admin.master')

@section('title', '- Finance')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ (Helper::ubahFinance()) ? 'Kirim Data Ke Pusat' : 'Finance' }}</h3>
                </div>
                <div class="card-body">
                    @if(Helper::isInsertFinance())
                        @if(Helper::cekUpdateFinance())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Harap segera update penjualan terakhir.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ url('/admin/finance/save') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">File Kirim</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="form-control">
                                    <p class="text-warning">File pada program</p>
                                    <!-- error -->
                                    @if($errors->has('file'))
                                        <div class="text-danger">
                                            {{ $errors->first('file') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="btn" value="Simpan" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                        <hr>
                    @endif

                    <!-- table -->
                    @if($dep == 'IT' || $dep == 'Finance')
                        <h3>Download Penjualan</h3>
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari, Tanggal</th>
                                        <th>Cek</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($finance))
                                        @foreach($finance as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ date('l, d F Y', strtotime($data->nama)) }}</td>
                                            <td>
                                                <a href="{{ url('/admin/finance/detail/'.$data->nama) }}" class="btn btn-success btn-sm">Lihat</a>
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