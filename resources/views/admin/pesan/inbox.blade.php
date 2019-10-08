@extends('admin.master')

@section('title', '- Inbox')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Pesan Masuk</h2>
                    </div>
                    <div class="card-header insert-menu">
                        <a href="{{ url('admin/pesan/form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Pesan</a>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="custom-table table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Dari</th>
                                    <th>Subject</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesan as $data)
                                <tr class="active-{{$idx}}">
                                    <td>
                                        <input type="checkbox" class="chcks" value="ID" data-class="active-{{$idx++}}" name="chckdel">
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">{{ $data->user->email }}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">
                                            <b>{{ $data->subject }}</b>
                                            <?php
                                                $text = strip_tags($data->message);
                                                $text = str_replace('&nbsp;', '', $text);
                                            ?>
                                            - {{ substr($text, 0, 50) }} ...
                                        </a>
                                        @foreach($data->attach as $att)
                                            <a href="{{ asset('Upesan/'.$att->nama_file) }}">
                                                <span class="badge badge-warning">{{ $att->nama }}</span>
                                            </a> 
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">{{ date('d F Y', strtotime($data->tgl)) }}<br>{{ date('H:i:s', strtotime($data->tgl)) }}</a>
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