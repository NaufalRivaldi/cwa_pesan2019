@extends('admin.master')

@section('title', '- Trash')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Tempat Sampah</h2>
                    </div>
                    <div class="card-header">
                        <span id="insert-menu"></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="custom-table table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">
                                            <input type="checkbox" class="chckalltrash"k data-class="" name="chckall">
                                        </th>
                                        <th>Kepada</th>
                                        <th>Subject</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- pesan inbox -->
                                    @foreach($inbox as $data)
                                    <?php
                                        $url = 'admin/pesan/trash/detail/'.$data->id;
                                    ?>
                                    <tr class="active-{{$idx}} tr-checked">
                                        <td>
                                            <input type="checkbox" class="chckstrash" value="{{ $data->id }}" data-class="active-{{$idx++}}" name="chckdel[]">
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
                                            <a href="{{ url('admin/pesan/trash/buInbox/'.$data->id) }}" class="btn btn-success btn-sm backup-pesan-outbox-inbox" data-id="{{ $data->id }}"><i class="fas fa-undo-alt"></i> Pulihkan</a>
                                            <a href="#" class="btn btn-danger btn-sm remove-pesaninbox-trash" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- pesan inbox -->
                                    <!-- pesan outbox-->
                                    @foreach($outbox as $data)
                                    <?php
                                        $url = 'admin/pesan/outbox/detail/'.$data->id;
                                    ?>
                                    <tr class="active-{{$idx}} tr-checked">
                                        <td>
                                            <input type="checkbox" class="chckstrash" value="{{ $data->id }}" data-class="active-{{$idx++}}" name="chckdel[]">
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">
                                                @foreach($data->penerima as $row)
                                                    {{ $row->user->email.", " }}
                                                @endforeach
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">
                                                <b>{{ $data->subject }}</b>
                                                - {{ Helper::setDesc($data->message) }} ...
                                            </a>
                                            @foreach($data->attach as $att)
                                                <a href="{{ asset('Upesan/'.$att->nama_file) }}">
                                                    <span class="badge badge-warning">{{ $att->nama }}</span>
                                                </a> 
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url($url) }}" class="a-block">{{ date('d F Y', strtotime($data->tgl)) }}<br>{{ date('H:i:s', strtotime($data->tgl)) }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/pesan/trash/buOutbox/'.$data->id) }}" class="btn btn-success btn-sm backup-pesan-outbox-outbox" data-id="{{ $data->id }}"><i class="fas fa-undo-alt"></i> Pulihkan</a>

                                            <a href="#" class="btn btn-danger btn-sm remove-pesanoutbox-trash" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- pesan outbox -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection