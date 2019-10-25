@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <table id="myTable" class="custom-table table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Bagian</th>
                            <th>Status</th>
                            <th>Keterangan</th>
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
                                    <a href="{{ url($url) }}" class="a-block">
                                        {{ Helper::setDate($row->created_at) }}
                                    </a>
                                </td>
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
                                    <a href="{{ url($url) }}" class="a-block">{!! Helper::setStatus($row->stat) !!}</a>
                                </td>
                                <td>
                                    <a href="{{ url($url) }}" class="a-block">{{ Helper::setAlasan($row->id) }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection