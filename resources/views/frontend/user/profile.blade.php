@extends("frontend.layouts.app")

@section("title", "Profile")
@section("content")

<div class="row justify-content-center my-3">
    <div class="col-lg-8">

        <div class="text-center ">
            <img id="profileImage" width="100" class="rounded-circle"
                src="https://ui-avatars.com/api/?name={{$user->name}}&background=5842e3&color=fff" alt="">
        </div>

        <div class="card card-body mb-5">
            <div class="d-flex justify-content-between">
                <div>Name</div>
                <div>{{$user->name}}</div>
            </div>
            <hr>

            <div class="d-flex justify-content-between">
                <div>Phone</div>
                <div>{{$user->phone}}</div>
            </div>
            <hr>

            <div class="d-flex justify-content-between">
                <div>Email</div>
                <div>{{$user->email}}</div>
            </div>
        </div>

        <div class="card card-body">
            <div class="d-flex justify-content-between">
                <div>Update Password</div>
                <div>
                    <a href="{{route('password_update')}}" class="text-decoration-none text-dark"><i
                            class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-between">
                <div>Logout</div>
                <div class="text-danger">
                    <i class="btn-logout fa-solid fa-right-from-bracket"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section("scripts")

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