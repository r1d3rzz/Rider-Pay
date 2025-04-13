<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\MakeSecretValue;
use App\Helpers\SendNotification;
use App\Helpers\UUIDGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserWalletAmountRequest;
use App\Http\Requests\ReduceUserWalletAmountRequest;
use App\Transaction;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    public function index()
    {
        return view("backend.wallet.index");
    }

    public function addWalletAmount()
    {
        $usernames = User::with("wallet")->get();
        return view("backend.wallet.addAmount", compact(["usernames"]));
    }

    public function reduceWalletAmount()
    {
        $usernames = User::with("wallet")->get();
        return view("backend.wallet.reduceAmount", compact(["usernames"]));
    }

    public function addWalletAmountStore(AddUserWalletAmountRequest $request)
    {
        $amount = $request->amount;
        $description = $request->description;

        DB::beginTransaction();

        try {
            $sender = auth()->user();

            $receiver = User::with("wallet")->where("id", $request->user_id)->firstOrFail();

            if ($receiver == null) {
                return back()->withErrors("fail", "User not found!")->withInput();
            }

            if ($sender != null && $receiver->id != null) {

                if ($receiver->wallet == null) {
                    return back()->withErrors("fail", "Receiver Wallet is Invalid! Please Try Again.")->withInput();
                }

                $receiverWallet = $receiver->wallet;
                $receiverWallet->increment("amount", $amount);
                $receiverWallet->update();

                $refNumber = UUIDGenerator::GenerateRefNumber();

                $receiverTxn = new Transaction();
                $receiverTxn->ref_no = $refNumber;
                $receiverTxn->txn_id = UUIDGenerator::GenerateTxnNumber();
                $receiverTxn->user_id = $receiver->id;
                $receiverTxn->source_id = $sender->id;
                $receiverTxn->type = 1;
                $receiverTxn->amount = $amount;
                $receiverTxn->description = $description;
                $receiverTxn->save();

                SendNotification::send($receiver, "Received", "Your wallet received " . $amount . " MMK from " . $sender->name . " ( " . MakeSecretValue::coverPhoneNumber($sender->phone) . " )", $receiverTxn->id, Transaction::class, url("/transfer/transactions/" . $receiverTxn->txn_id));

                DB::commit();

                return redirect()->route("admin.wallet.index")->with("success", "Transaction Success");
            } else {
                throw new ErrorException();
            }
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withErrors("fail", $th->getMessage())->withInput();
        }
    }

    public function reduceWalletAmountStore(ReduceUserWalletAmountRequest $request)
    {
        $amount = $request->amount;
        $description = $request->description;

        DB::beginTransaction();

        try {
            $receiver = auth()->user();

            $sender = User::with("wallet")->where("id", $request->user_id)->firstOrFail();

            if ($receiver == null) {
                return back()->withErrors("fail", "User not found!")->withInput();
            }

            if ($sender != null && $receiver->id != null) {
                $senderWallet = $sender->wallet;
                $senderWallet->decrement("amount", $amount);
                $senderWallet->update();

                $refNumber = UUIDGenerator::GenerateRefNumber();

                $senderTxn = new Transaction();
                $senderTxn->ref_no = $refNumber;
                $senderTxn->txn_id = UUIDGenerator::GenerateTxnNumber();
                $senderTxn->user_id = $sender->id;
                $senderTxn->source_id = $sender->id;
                $senderTxn->type = 1;
                $senderTxn->senderType = 0;
                $senderTxn->amount = $amount;
                $senderTxn->description = $description;
                $senderTxn->save();

                SendNotification::send($sender, "Reduce Wallet Amount", "Your wallet reduce amount " . $amount . " MMK from " . $receiver->name . " ( " . MakeSecretValue::coverPhoneNumber($receiver->phone) . " )", $senderTxn->id, Transaction::class, url("/transfer/transactions/" . $senderTxn->txn_id));

                DB::commit();

                return redirect()->route("admin.wallet.index")->with("success", "Transaction Success");
            } else {
                throw new ErrorException();
            }
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withErrors("fail", $th->getMessage())->withInput();
        }
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
