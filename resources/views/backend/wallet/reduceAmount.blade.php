@extends('backend.layouts.app')
@section('title', 'Reduce Wallet Amount')
@section('wallet-active', 'mm-active')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-wallet icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Wallets</div>
        </div>
    </div>
</div>

<div class="content">
    <form action="{{route('admin.wallet.reduceAmount.post')}}" method="POST" id="reduceWalletAmount">
        @csrf

        <div class="card">
            <div class="card-header">
                Reduce User Wallet Amount
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="user_id">Choose Username</label>
                    <select name="user_id" class="form-control select2-single" id="user_id">
                        <option selected disabled>Choose Username</option>
                        @foreach ($usernames as $username)
                        <option value="{{$username->id}}">{{$username->name}} ({{$username->phone}})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount">Add Amount</label>
                    <input type="number" value="1000" name="amount" id="amount" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="3"
                        class="form-control">Reduce Wallet Amount From {{auth()->user()->name}}</textarea>
                </div>

                <div class="text-right">
                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger w-25">Reduce
                        Amount</button>
                    <a href="{{route('admin.wallet.index')}}" class="btn btn-primary w-25">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section("scripts")
{!! JsValidator::formRequest('App\Http\Requests\ReduceUserWalletAmountRequest', '#reduceWalletAmount'); !!}
@endsection