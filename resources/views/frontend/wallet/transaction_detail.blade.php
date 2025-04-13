@extends('frontend.layouts.app')

@section('title', 'Detail')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card card-body">
            <div class="text-center">
                <img src="{{asset('frontend/svg/check-circle-svgrepo-com.svg')}}" width="60" alt="">
                <p class="padauk-regular font-weight-bold mt-2" style="font-size: 15px">လုပ်ဆောင်မှု့အောင်မြင်ပါသည်။</p>
                <div>
                    <span style="font-size: 25px; font-weight: 500;"
                        class="{{$transaction->type == 1 ? 'text-success' : 'text-danger'}}">{{$transaction->type == 1 ?
                        "+" : "-"}}
                        {{number_format($transaction->amount)}}</span> <small>MMK</small>
                </div>
            </div>

            <div class="mt-4">
                <table class="table table-borderless">
                    <tr>
                        <th class="padauk-regular" style="font-weight: 700">လုပ်ဆောင်သောအချိန်</th>
                        <td class="text-right">{{$transaction->created_at}}</td>
                    </tr>
                    <tr>
                        <th class="padauk-regular" style="font-weight: 700">လုပ်ဆောင်မှု့အမှတ်</th>
                        <td class="text-right">{{$transaction->ref_no}}</td>
                    </tr>
                    <tr>
                        <th class="padauk-regular" style="font-weight: 700">လုပ်ဆောင်မှု့အမျိုးအစား</th>
                        <td class="text-right">{{$transaction->type == 1 ? "‌‌ငွေလက်ခံ" : "‌ငွေလွှဲ"}}</td>
                    </tr>
                    <tr>
                        <th class="padauk-regular" style="font-weight: 700">ပေးပို့သူ</th>
                        @php
                        $source = null;
                        if($transaction->senderType == 0){
                        $source = $transaction->admin;
                        }else{
                        $source = $transaction->source;
                        }
                        @endphp
                        <td class="text-right">{{$source ? $source->name . " " . "(".
                            App\Helpers\MakeSecretValue::coverPhoneNumber($source->phone) .")" :
                            "-"}}</td>
                    </tr>
                    <tr>
                        <th class="padauk-regular" style="font-weight: 700">ငွေပမာဏ</th>
                        <td class="text-right {{$transaction->type == 1 ? 'text-success' : 'text-danger'}}">
                            {{$transaction->type == 1 ? "+" : "-"}}
                            <span
                                style="font-weight: 500">{{number_format($transaction->amount)}}</span><small>MMK</small>
                        </td>
                    </tr>
                    <tr>
                        <th class="padauk-regular" style="font-weight: 700">မှတ်ချက်</th>
                        <td class="text-right">{{$transaction->description}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection