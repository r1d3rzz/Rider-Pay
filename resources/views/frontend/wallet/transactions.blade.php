@extends('frontend.layouts.app')

@section('title', 'Transactions')
@section('content')

<div class="card card-body mb-3">
    <div><i class="fa-solid fa-filter mr-1"></i> Filter</div>
    <div class="row mt-2">
        <div class="col-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                </div>
                <input type="text" value="{{request()->date}}" class="form-control" id="dateFilter" placeholder="All">
            </div>
        </div>
        <div class="col-5">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tags"></i></span>
                </div>
                <select class="form-control" id="typeFilter">
                    <option @if(request()->type == "all") selected @endif value="all">All</option>
                    <option @if(request()->type == "1") selected @endif value="1">လက်ခံ</option>
                    <option @if(request()->type == "2") selected @endif value="2">ပေးပို့</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="infinite-scroll mb-5">
    @foreach ($transactions as $transaction)
    <div class="card card-body mb-2 transaction" data-txn_id="{{$transaction->txn_id}}">
        <div class="row d-flex no-warp justify-content-between px-2 align-items-center">
            <div class="d-flex justify-content-center">
                <div><img src="{{asset('frontend/svg/transaction-svgrepo-com.svg')}}" width="20" alt=""></div>
            </div>
            <div>
                <div class="padauk-regular"> {{$transaction->type == 1 ? "ပေးပို့သူ" : "ငွေလွှဲမည် သို့
                    "}} <span class="sourcePhone">{{
                        App\Helpers\MakeSecretValue::coverPhoneNumber($transaction->source->phone) }}</span>
                </div>
                <div class="poppins-regular"><small>{{$transaction->created_at}}</small></div>
            </div>
            <div class="">
                <small
                    class="poppins-regular font-weight-bold {{ $transaction->type == 1 ? 'text-success' : 'text-danger' }}">
                    {{$transaction->type == 1 ? "+" : "-"}}
                    {{ number_format($transaction->amount) }} MMK
                </small>
            </div>
        </div>
    </div>
    @endforeach
    {{$transactions->links()}}
</div>

@if (count($transactions) < 1) <div class="d-flex flex-column justify-content-center align-items-center"
    style="height: 60vh; gap: 10px;">
    <img src="{{asset('frontend/svg/undraw_no-data_ig65.svg')}}" width="300" alt="">
    <div style="font-size: 1.5rem" class="text-muted">Empty Transaction</div>
    </div>
    @endif

    @endsection

    @section("scripts")
    <script>
        $(document).ready(function(){
        $(document).on("click", ".transaction", function(){
            const txn_id = $(this).data("txn_id");
            window.location.href = `/transfer/transactions/${txn_id}`;
        });

        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div>Loading</div>',
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });

        $("#typeFilter").on("change", function(){
            const date = $('#dateFilter').val();
            const type = $("#typeFilter").val();
            history.pushState(null, "", "?date="+date+"&type="+type);
            window.location.reload();
        });

        $('#dateFilter').daterangepicker({
            "singleDatePicker": true,
            "autoUpdateInput": false,
            "autoApply": false,
            "locale": {
                "format": "YYYY-MM-DD",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "firstDay": 1
            },
        });

        $("#dateFilter").on("apply.daterangepicker",function(ev, picker){
            $(this).val(picker.startDate.format("YYYY-MM-DD"));
            const date = $('#dateFilter').val();
            const type = $("#typeFilter").val();
            history.pushState(null, "", "?date="+date+"&type="+type);
            window.location.reload();
        });

        $("#dateFilter").on("cancel.daterangepicker",function(ev, picker){
            $(this).val("");
            const date = $('#dateFilter').val();
            const type = $("#typeFilter").val();
            history.pushState(null, "", "?date="+date+"&type="+type);
            window.location.reload();
        });
    });
    </script>
    @endsection
