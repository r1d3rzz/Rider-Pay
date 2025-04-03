@extends("frontend.layouts.app")

@section("title", "Transfer")
@section("content")

<div class="card card-body">
    <div>
        <div>From </div>
        <div class="form-group alert alert-primary">
            <div class="mb-2">Name: {{$user->name}}</div>
            <div class="mb-2">Phone: {{$user->phone}}</div>
            <div>Balance: {{$user->wallet ? number_format($user->wallet->amount) : 0}} MMK</div>
        </div>

        <div>To</div>
        <div class="form-group">
            <label for="to_phone">Phone No.</label>
            <input type="text" class="form-control" id="receiverPhone" readonly value="{{$to_phone}}">
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="transferAmount" readonly value="{{number_format($amount)}}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" readonly>{{$description}}</textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary w-100" id="transferConfirmBtn">
                Continue
            </button>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script>
    $(document).ready(function(){
        let passwordValid = false;
        $("#transferConfirmBtn").on("click", function(){
            Swal.fire({
            title: "Enter Your Password",
            html: "<input type='password' id='wallet_password' class='form-control'/>",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
                if (result.isConfirmed) {
                    password = $("#wallet_password").val();

                    $.ajax({
                        url: "{{route('transfer.passwordVerify')}}",
                        type: "GET",
                        data: {password},
                        success: function(res){
                            if(res.status === 200){
                                const receiverPhone = $("#receiverPhone").val();
                                const amount = {{$amount}};
                                const description = $("#description").val();

                                $.ajax({
                                    url: "{{route('transfer.makeTransaction')}}",
                                    type: "GET",
                                    data: {receiverPhone, amount, description },
                                    success: function(response){
                                        if(response.status === 200){
                                            Swal.fire({
                                                text: response.message,
                                                icon: "success"
                                            }).then(() => window.location.href = '/');
                                        }else{
                                            Swal.fire({
                                                text: response.message,
                                                icon: "warning"
                                            });
                                        }
                                    }
                                });
                            }else{
                                Swal.fire({
                                    text: res.message,
                                    icon: "error"
                                });
                            }

                        }
                    });
                }
            });
        });
    });
</script>
@endsection