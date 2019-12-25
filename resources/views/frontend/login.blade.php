@extends('frontend.master')

@section('title', '- Login')

@section('content')
    <!-- Flash Data -->
    <span class="flash" data-status="{{ session('status') }}"></span>
    <div class="container" style="margin-top:5%">
        <div class="row">
            <div class="box-login">
                <div class="box-left">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="display-4">Login</h3>
                                <hr>
                                <form action="{{ url('postlogin') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" placeholder="xxxx@cwabali.com" class="form-control">
                                        
                                        @if($errors->has('email'))
                                            <div class="text-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" placeholder="*****" class="form-control">

                                        @if($errors->has('password'))
                                            <div class="text-danger">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info btn-block" value="Masuk">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-right">
                    <div class="text-custom">
                        <h3 class="display-3 font-weight-bold" style="font-size:4em">PORTAL CWJA</h3>
                        <p class="lead text-bold" style="">PT. CITRA WARNA JAYA ABADI</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="">
            <div class="">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('img/natal.png')}}" alt="" class="img-fluid mx-auto d-block" width="80%">
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('.modal').modal('show');
</script>
@endsection