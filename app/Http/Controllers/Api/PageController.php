<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use Illuminate\Http\Request;

use function App\Helpers\success;

class PageController extends Controller
{
    public function profile()
    {
        return success("profile success", [
            "user" => new ProfileResource(auth()->user()),
        ]);
    }

    public function transactions(Request $request)
    {
        $authUserId = auth()->id();
        $transactions = Transaction::with(["user", "source"])->where("user_id", $authUserId);
        if ($request->type && $request->type != "all") {
            $transactions = $transactions->where("type", $request->type);
        }

        if ($request->date) {
            $transactions = $transactions->whereDate("created_at", $request->date);
        }

        $transactions = $transactions->latest()->paginate(5);

        return TransactionResource::collection($transactions)->additional(["status" => 200, "message" => "Transaction Success   "]);
    }

    public function transactionDetail(string $txn_id)
    {
        $transaction = Transaction::with("source")->where("txn_id", $txn_id)->first();
        return success("Transaction Detail", new TransactionDetailResource($transaction));
    }
}
