@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <h3>Laporan Form HRD</h3>
                
                <hr>
                <div class="card">
                    <div class="card-header">
                        <form action="" method="GET">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-5">
                                    <label><b>Kategori</b></label>
                                    <select class="js-example-responsive" multiple="multiple" name="kategori[]" class="form-control" style="width: 100%" id="selectAll">
                                        @foreach($kategori as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label><b>Departemen</b></label>
                                    <select name="dep" class="form-control">
                                        <option value="Office">Office</option>
                                        @foreach($cabang as $row)
                                            <option value="{{ $row->inisial }}">{{ $row->inisial }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="col-md-3">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" value="Cari Data" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Bagian</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($form as $row)
                                    <?php
                                    $url = 'admin/formhrd/detail/'.$row->id;
                                    ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{!! Helper::setKategori($row->id) !!}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{!! $row->karyawanAll->nama.'/'.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">
                                                {{ Helper::setDate($row->created_at) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
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