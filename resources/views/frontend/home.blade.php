@extends("frontend.layouts.app")

@section("title", "Rider Pay")
@section("content")

<div class="row justify-content-center my-3">
    <div class="col-lg-12">

        <div class="text-center mb-3">
            <img id="profileImage" width="90" class="rounded-circle"
                src="https://ui-avatars.com/api/?name={{$user->name}}&background=5842e3&color=fff" alt="">
            <div class="h4">{{$user->name}}</div>
            <div class="text-muted font-weight-bold">{{$user->wallet ? number_format($user->wallet->amount) : 0}} MMK
            </div>
        </div>

        @if ($user->wallet)
        <div class="mb-3 d-flex" style="gap: 10px">
            <div class="card card-body p-2 mb-md-0">
                <div>
                    <img class="mr-2" src="{{asset('frontend/svg/scan-qr.svg')}}" width="40" alt="">
                    <span>Scan & Pay</span>
                </div>
            </div>
            <div class="card card-body p-2">
                <a href="{{route('transfer.receive_qr')}}" class="text-decoration-none text-dark">
                    <div>
                        <img class="mr-2" src="{{asset('frontend/svg/qr-code.svg')}}" width="40" alt="">
                        <span>Receive QR</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="mb-3">
            <div class="card card-body">
                <a href="{{route('transfer')}}" class="text-decoration-none text-dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img src="{{asset('frontend/png/money-transfer.png')}}" width="20" alt="">
                            Transfer
                        </div>
                        <div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </a>
                <hr>
                <a href="{{route('wallet')}}" class="text-decoration-none text-dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <i class="fa-solid fa-wallet mr-1"></i>
                            Wallet
                        </div>
                        <div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </a>
                <hr>

                <a href="{{route('transfer.transactions')}}" class="text-decoration-none text-dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <i class="fa-solid fa-arrow-right-arrow-left mr-1"></i>
                            Transaction
                        </div>
                        <div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </a>

            </div>
        </div>
        @endif
    </div>
</div>

@endsection