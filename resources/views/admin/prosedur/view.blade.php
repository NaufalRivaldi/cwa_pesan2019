@extends('admin.master')

@section('title', '- Detail Prosedur')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a href="{{route('prosedur.index')}}"><li class="breadcrumb-item" aria-current="page">Prosedur</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Prosedur</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-header">
                    <a href="{{url()->previous()}}" class="btn btn-success btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <h2>{{$prosedur->nama}}</h2>
                            <p>Departemen : {{$prosedur->departemen->nama}}</p>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="fraDisabled" class="embed-responsive-item" src="{{ asset('file-prosedur/'.$prosedur->file.'#toolbar=0') }}" onload="disableContextMenu();" onMyLoad="disableContextMenu();" allowfullscreen ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('body').on('contextmenu', function(e){
            return false;
        });
    });
</script>

@endsection