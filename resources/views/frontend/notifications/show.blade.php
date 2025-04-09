@extends('frontend.layouts.app')

@section('title', 'အသေးစိတ်')
@section('content')

@php
$isTransactionNotification = false;
if($notification->data["title"] == "Received" || $notification->data["title"] == "Transfer"){
$isTransactionNotification = true;
}
@endphp

<div class="card card-body">
    <div>
        <h5>{{$isTransactionNotification ? "Transaction" : $notification->data["title"]}}</h5>
        @if ($isTransactionNotification)
        <div>{{$notification->data["title"]}}</div>
        @endif

        <div class="text-muted mt-2">
            {{Carbon\Carbon::parse($notification->created_at)->format("Y-m-d H:i A")}}
        </div>

        <div class="bg-light p-2 mt-3">
            {{$notification->data["message"]}}
        </div>
    </div>
</div>

<div class="text-center">
    <button onclick="return window.location.href='/notifications'" class="btn btn-primary btn-sm w-50 mt-3"><i
            class="fa-solid fa-chevron-left mr-3"></i> Back</button>
</div>
@endsection