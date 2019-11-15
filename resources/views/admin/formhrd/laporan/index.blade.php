<?php
    $tgl = date('d F Y', strtotime($month)).' s/d '.date('d F Y');
    if($_GET){
        $urls = explode('&', $_SERVER['QUERY_STRING']);
        $kt = [];
        foreach($urls as $url){
            $value = explode('=', $url);
            if($value[0] == 'kategori')
                $kt[] = $value[1];
        }

        $tgl = date('d F Y', strtotime($_GET['tgl_a'])).' s/d '.date('d F Y', strtotime($_GET['tgl_b']));
    }
?>

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
                        <?php
                            $url = '';
                            if($_GET)
                                $url = $_SERVER['QUERY_STRING'];
                        ?>
                        <a href="{{ url('admin/formhrd/laporan/export?'.$url) }}" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Excel</a>
                        <div class="collapse mt-2" id="collapseExample">
                            <div class="card card-body">
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><b>Tanggal Awal</b></label><br>
                                            <input type="date" name="tgl_a" class="form-control" value="{{ (!empty($_GET['tgl_a'])) ? $_GET['tgl_a'] : date('Y-m-d', strtotime($month)) }}" required>
                                        </div>
                                        <div class="col-md-4">
                                        <label><b>Tanggal Akhir</b></label><br>
                                            <input type="date" name="tgl_b" class="form-control" value="{{ (!empty($_GET['tgl_b'])) ? $_GET['tgl_b'] : '' }}" required>
                                        </div>  
                                        <div class="col-md-4">
                                            <label><b>Kategori</b></label><br>
                                            <select class="js-example-responsive form-control" multiple="multiple" name="kategori" id="selectAll" style="width:100%">
                                                @foreach($kategori as $row)
                                                    <option value="{{ $row->id }}" {{ ($_GET) ? (in_array($row->id, $kt)) ? 'selected' : '' : '' }}>{{ $row->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><b>Departemen</b></label>
                                            <select name="dep" class="form-control dep-select">
                                                <option value="All" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == 'All') ? 'selected' : '' : '' }}>All</option>
                                                <option value="Office" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == 'Office') ? 'selected' : '' : '' }}>Office</option>
                                                @foreach($cabang as $row)
                                                    <option value="{{ $row->inisial }}" {{ (!empty($_GET['dep'])) ? ($_GET['dep'] == $row->inisial) ? 'selected' : '' : '' }}>{{ $row->inisial }}</option>
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
                        <p class="lead">Tanggal : {{ $tgl }}</p>
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
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{!! Helper::setKategori($row->id) !!}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{!! $row->karyawanAll->nama.' '.Helper::statusKaryawan($row->karyawanAll->stat) !!}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{{ $row->karyawanAll->dep }}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">
                                                    {{ Helper::setDate($row->tgl_a) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{{ date('H:i', strtotime($row->tgl_a)) }}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{{ date('H:i', strtotime($row->tgl_b)) }}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">
                                                    {{ Helper::setDiff($row->tgl_a, $row->tgl_b, $row->lembur) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{!! $row->keterangan !!}</a>
                                            </td>
                                            
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{{ Helper::setUpahLembur($row->tgl_a, $row->tgl_b, $row->lembur) }}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="a-block modal-formHRD" data-toggle="modal" data-target="#viewForm" data-id="{{ $row->id }}">{!! Helper::setStatus($row->stat) !!}</a>
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

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="viewForm" tabindex="-1" role="dialog" aria-labelledby="viewFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFormLabel">Form HRD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="showForm"></span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.modal-formHRD').click(function () {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('laporan.view') }}",
                type: "POST",
                data: {form_id: id},
                success: function(text){
                    $('.showForm').empty();
                    $('.showForm').append(text);
                }
            });
        });
    </script>
@endsection