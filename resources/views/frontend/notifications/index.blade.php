@extends('frontend.layouts.app')

@section('title', 'Notifications')
@section('content')

<div class="infinite-scroll mb-5">
    @foreach ($notifications as $notification)
    @php
    $isTransactionNotification = false;
    if($notification->data["title"] == "Received" || $notification->data["title"] == "Transfer"){
    $isTransactionNotification = true;
    }
    @endphp
    <a href="{{route('notifications.show', $notification->id)}}"
        class="text-dark card card-body mb-3 {{$notification->read_at != null ? " afterRead" : null}}">
        <div>
            <h5>{{$isTransactionNotification ? "Transaction" : $notification->data["title"]}}</h5>
            @if ($isTransactionNotification)
            <div>{{$notification->data["title"]}}</div>
            @endif
        </div>
        <div>
            {{Illuminate\Support\Carbon::parse($notification->created_at)->format("Y-m-d H:i:s A")}}
        </div>
    </a>
    @endforeach
    {{$notifications->links()}}
</div>



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
    });
</script>
@endsection