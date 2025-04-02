@extends('frontend.layouts.app')

@section('title', 'Wallet')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card card-body">
            <div class="mb-3">
                <div class="card-info-title">Balance</div>
                <div class="card-info-value">{{($user->wallet ? number_format($user->wallet->amount) : 0)}} <span
                        class="card-info-title">MMK</span></div>
            </div>

            <div class="mb-3">
                <div class="card-info-title">Account Number</div>
                <div class="card-info-value">{{$user->wallet ? $user->wallet->account_number : '-'}}</div>
            </div>

            <div>
                <div class="card-info-title">Holder Name</div>
                <div class="card-info-value">{{$user->name}}</div>
            </div>
        </div>
    </div>
</div>

@endsection