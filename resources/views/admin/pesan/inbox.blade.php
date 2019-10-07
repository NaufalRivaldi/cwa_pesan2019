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
                                    <th>#</th>
                                    <th>Dari</th>
                                    <th>Isi</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active-1">
                                    <td>
                                        <input type="checkbox" class="chcks" value="ID" data-class="active-1" name="chckdel">
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">naufal@cwabali.com</a>
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">
                                            <b>test email internal</b> 
                                            - Hello world asdasd<br>
                                        </a>
                                        <span class="badge badge-warning">aya.exe</span> <span class="badge badge-warning">Warning.exe</span>
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">26 Okt<br>15:30:15</a>
                                    </td>
                                </tr>
                                <tr class="active-2">
                                    <td>
                                        <input type="checkbox" class="chcks" value="ID" data-class="active-2" name="chckdel">
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">naufal@cwabali.com</a>
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">
                                            <b>test email internal</b> 
                                            - Hello world asdasd<br>
                                        </a>
                                        <span class="badge badge-warning">aya.exe</span> <span class="badge badge-warning">Warning.exe</span>
                                    </td>
                                    <td>
                                        <a href="#" class="a-block">26 Okt<br>15:30:15</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection