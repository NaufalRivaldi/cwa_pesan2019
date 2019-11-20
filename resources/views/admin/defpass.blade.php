@if(Helper::passDefault())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Anda masih menggunakan password default, klik <a href="{{ route('repassword') }}"><u>disini</u></a> untuk mengganti password.

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif