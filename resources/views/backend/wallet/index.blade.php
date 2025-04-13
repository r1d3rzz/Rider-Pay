@extends('backend.layouts.app')
@section('title', 'Wallets')
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

<div class="mb-3">
    <a href="{{route('admin.wallet.addAmount')}}" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i> Add
        Wallet Amount</a>
    <a href="{{route('admin.wallet.reduceAmount')}}" class="btn btn-danger"><i class="fas fa-minus-circle mr-2"></i>
        Reduce Wallet Amount</a>
</div>

<div class="content">

    <div class="card">
        <div class="card-body">
            <table id="walletTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Account Number</th>
                        <th class="no-sort">Holder Name</th>
                        <th>Amount (MMK)</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        let table = new DataTable('#walletTable', {
            processing: true,
            serverSide: true,
            ajax: 'wallet/datatable/ssd',
            order: [[6, 'desc']],
            columns: [
                {
                    data: "account_number",
                    name: "account_number",
                },
                {
                    data: "holder_info",
                    name: "holder_info",
                },
                {
                    data: "amount",
                    name: "amount",
                },
                {
                    data: "created_at",
                    name: "created_at",
                },
                {
                    data: "updated_at",
                    name: "updated_at",
                },
            ],
            columnDefs: [
                {
                    targets: "no-search",
                    searchable: false
                },
                {
                    targets: "no-sort",
                    orderable: false
                },
                {
                    targets: "no-show",
                    visible: false
                }
            ]
        });
    })
</script>
@endsection