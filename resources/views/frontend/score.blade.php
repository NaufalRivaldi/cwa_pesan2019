@extends('frontend.master')

@section('title', '- Scoreboard')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">Scoreboard Penjualan</h1>
                <p class="lead">Last Update : xxxx-xx-xx 00:00:00</p>
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Dari Tanggal</label>
                                        <input type="date" name="dari_tgl" class="form-control">
                                        <input type="checkbox" name="group" value="1" checked> Gabungkan Skor Per Divisi.
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Sampai Tanggal</label>
                                        <input type="date" name="sampai_tgl" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="" class="text-bold">Divisi</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Semua Divisi</option>
                                            @foreach($divisi as $r => $i)
                                            <option value="{{ $r }}">{{ $i }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection