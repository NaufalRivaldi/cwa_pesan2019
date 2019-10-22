@extends('frontend.master')

@section('title', '- Pengumuman')

@section('content')
    <div class="container" style="margin-top:2%">
        <div class="row">
            <div class="co-12">
                <h1 class="display-4">Pengumuman <span class="badge badge-secondary">Internal CWJA</span></h1>
                <hr class="hr-yellow">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(isset($ultah))
                        <div class="alert alert-info" role="alert">
                            <span class="text-blink">
                                Happy birthday to 
                                @foreach($ultah as $data)
                                    {{ $data->nama.' ('.$data->divisi.'),' }}
                                @endforeach
                                Wish you all the best.
                            </span>
                        </div>
                        @endif
                        @foreach($pengumuman as $r)
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ url('/detail/'.$r->id) }}">
                                        <div class="col-pnm">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span class="badge badge-info col-12">
                                                        {{ date('l, d F Y', strtotime($r->tgl)) }}
                                                    </span>
                                                </div>
                                                <div class="col-2">
                                                    {{ $r->user->nama }}
                                                </div>
                                                <div class="col-7">
                                                    {{ $r->subject }}
                                                    <?php  
                                                        $date1 = new DateTime($r->tgl);
                                                        $date2 = new DateTime($date_now);
                                                        $diff = $date1->diff($date2);
                                                    ?>
                                                    @if($diff->days < 2)
                                                        <span class="text-blink">New!</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="row" style="margin-top:1%">
                            <div class="col-12">
                                {{ $pengumuman->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection