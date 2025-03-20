<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    public function index()
    {
        return view("backend.wallet.index");
    }

    public function ssd()
    {
        $wallet = Wallet::with("user");

        return DataTables::of($wallet)
            ->addColumn("holder_info", function ($each) {
                return "<p>Name: " . $each->user->name . "</p>" . "<p>Email: " . $each->user->email . "</p>" . "<p>Phone: " . $each->user->phone . "</p>";
            })
            ->editColumn("amount", fn($each) => number_format($each->amount, 2))
            ->editColumn("created_at", fn($each) => Carbon::parse($each->created_at)->format("Y-m-d H:i:s"))
            ->editColumn("updated_at", fn($each) => Carbon::parse($each->updated_at)->format("Y-m-d H:i:s"))
            ->rawColumns(["holder_info"])
            ->make();
    }
}
