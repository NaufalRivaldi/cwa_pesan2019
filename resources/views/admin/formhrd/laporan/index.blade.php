@extends('admin.master')

@section('title', '- Laporan HRD')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <h3>Laporan Form HRD</h3>
                <hr>

                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-cog"></i> Pengaturan
                        </button>
                        <div class="collapse mt-2" id="collapseExample">
                            <div class="card card-body">
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><b>Tanggal Awal</b></label><br>
                                            <input type="date" name="tgl_a" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                        <label><b>Tanggal Akhir</b></label><br>
                                            <input type="date" name="tgl_b" class="form-control">
                                        </div>  
                                        <div class="col-md-4">
                                            <label><b>Kategori</b></label><br>
                                            <select class="js-example-responsive form-control" multiple="multiple" name="kategori" id="selectAll" style="width:100%">
                                                @foreach($kategori as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><b>Departemen</b></label>
                                            <select name="dep" class="form-control dep-select">
                                                <option value="Office" selected>Office</option>
                                                @foreach($cabang as $row)
                                                    <option value="{{ $row->inisial }}">{{ $row->inisial }}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                        <div class="col-md-4">
                                            <label>&nbsp;</label><br>
                                            <input type="submit" value="Cari Data" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h3 class="dep"></h3>
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th width="20%">Nama</th>
                                        <th>Bagian</th>
                                        <th>Tanggal</th>
                                        <th>Mulai</th>
                                        <th>Berakhir</th>
                                        <th>Durasi (Jam)</th>
                                        <th>Keterangan</th>
                                        <th>Upah Lembur</th>
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
                                                <a href="{{ url($url) }}" class="a-block">{!! $row->karyawanAll->nama.' '.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">
                                                    {{ Helper::setDate($row->tgl_a) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{{ date('H:i', strtotime($row->tgl_a)) }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{{ date('H:i', strtotime($row->tgl_b)) }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">
                                                    {{ Helper::setDiff($row->tgl_a, $row->tgl_b, $row->lembur) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{!! $row->keterangan !!}</a>
                                            </td>
                                            
                                            <td>
                                                <a href="{{ url($url) }}" class="a-block">{{ Helper::setUpahLembur($row->tgl_a, $row->tgl_b, $row->lembur) }}</a>
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
    </div>
@endsection