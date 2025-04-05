@extends('frontend.layouts.app')

@section('title', 'Receive QR')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card card-body text-center">
            <div class="text-center">
                <img
                    src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->generate($user->phone)) !!} ">
            </div>
            <div>
                <p style="font-size: 1.5rem">{{$user->name}}</p>
                <p>{{$user->phone}}</p>
            </div>
        </div>
    </div>
</div>

@endsection