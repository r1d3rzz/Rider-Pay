@extends("frontend.layouts.app")

@section("title", "Password")
@section("content")

<div class="row justify-content-center my-3">

    <div class="col-lg-8">
        <form action="{{route('update_password_update')}}" method="POST" id="updatePassword">
            @csrf
            <div class="card card-body mb-5">

                <div class="d-flex justify-content-center">
                    <img src="{{asset('frontend/svg/Reset Password 1.svg')}}" width="250px" alt="">
                </div>

                @if ($errors)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div><i class="fas fa-exclamation-triangle mr-2"></i> {{$error}}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endforeach
                @endif

                <div class="form-group">
                    <label for="password">Current Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="current_password" required autocomplete="password">

                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input id="new-password" type="password"
                        class="form-control @error('new-password') is-invalid @enderror" name="new_password" required
                        autocomplete="new-password">

                    @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary text-white w-100">Update Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


@section("scripts")

{!! JsValidator::formRequest('App\Http\Requests\UpdatePasswordRequest', '#updatePassword'); !!}

<script>
    $(document).ready(function(){
        $(".btn-logout").on("click", function(){

           Swal.fire({
                title: "Do you want to Logout?",
                showCancelButton: true,
                confirmButtonText: "Logout",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('logout')}}",
                        type: "POST",
                        success: function(res){
                            Swal.fire("Logout", "", "success").then(() => window.location.reload());
                        }
                    });
                }
            });


        })
    })
</script>

@endsection