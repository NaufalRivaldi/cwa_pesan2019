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
                    <div class="card-header">
                        <a href="{{ url('admin/pesan/form') }}" class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i> Buat Pesan</a> 
                        <span id="insert-menu"></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">
                                            <input type="checkbox" class="chckall"k data-class="" name="chckall">
                                        </th>
                                        <th width="20%">Dari</th>
                                        <th>Subject</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pesan as $data)
                                    <?php
                                        $url = 'admin/pesan/inbox/detail/'.$data->id;
                                    ?>
                                    <tr class="active-{{$idx}} {{ Helper::read($data->id, auth()->user()->id) }} tr-checked">
                                        <td>
                                            <input type="checkbox" class="chcks" value="{{ $data->id }}" data-class="active-{{$idx++}}" name="chckdel[]">
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{{ $data->user->email }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">
                                                <b>{{ $data->subject }}</b>
                                                - {{ Helper::setDesc($data->message) }} ...
                                            </a>
                                            @foreach($data->attach as $att)
                                                <a href="{{ asset('Upesan/'.$att->nama_file) }}" download="{{ $att->nama }}">
                                                    <span class="badge badge-warning">{{ $att->nama }}</span>
                                                </a> 
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{{ date('d F Y', strtotime($data->tgl)) }}<br>{{ date('H:i:s', strtotime($data->tgl)) }}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm remove-pesan" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></a>
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