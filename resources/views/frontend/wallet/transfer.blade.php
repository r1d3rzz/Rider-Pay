@extends("frontend.layouts.app")

@section("title", "Transfer")
@section("content")

<div class="card card-body mb-5">
    <form action="{{route('transfer.confirm')}}" class="mb-3" method="POST" id="amountTransfer">
        @csrf

        <div>From </div>
        <div class="form-group alert alert-primary">
            <div class="mb-2">Name: {{$user->name}}</div>
            <div class="mb-2">Phone: {{$user->phone}}</div>
            <div>Balance: {{$user->wallet ? number_format($user->wallet->amount) : 0}} MMK</div>
        </div>

        <div>To <span id="verifyValue"></span></div>
        <div class="form-group">
            <label for="to_phone">Phone No.</label>
            <div class="input-group">
                <input type="text" name="to_phone" id="to_phone" class="form-control"
                    value="{{old('to_phone', request()->scanQr)}}">
                <span class="input-group-text" style="cursor: pointer;" title="check phone number"
                    id="phoneNumberVerify">
                    <i class="fa-solid fa-check-circle"></i>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{old('amount')}}">
            @error("amount")
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary w-100 d-none" id="confirmBtn">
                Confirm
            </button>
        </div>

    </form>
</div>

@endsection

@section("scripts")
{!! JsValidator::formRequest('App\Http\Requests\WalletAmountTransferValidateRequest', '#amountTransfer'); !!}

<script>
    $(document).ready(function(){
        $("#phoneNumberVerify").on("click", function(){
            const phoneNumber = $("#to_phone").val();

            if(phoneNumber != null && phoneNumber.replaceAll(" ", "") != ""){
                $.ajax({
                    url : "/transfer/phoneVerify?phoneNumber="+ phoneNumber,
                    method : "GET",
                    success: function(res){
                        if(res.status == 200){
                            $("#verifyValue").removeClass("text-danger").addClass('text-primary').text( "( " + res.data + " )");
                            $("#confirmBtn").removeClass("d-none").addClass("d-block");
                        }else{
                            $("#verifyValue").removeClass("text-primary").addClass('text-danger').text( "( " + res.message + " )");
                            $("#confirmBtn").removeClass("d-block").addClass("d-none");
                        }
                    }
                });
            }
        });

        const params = new URLSearchParams(window.location.search);
        const scanQr = params.get('scanQr');
        if(scanQr){
            $("#phoneNumberVerify").click();
        }
    });
</script>

@endsection