<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use App\Wallet;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index()
    {
        return view("frontend.home", [
            "user" => auth()->user()
        ]);
    }

    public function profile()
    {
        $user = Auth::guard("web")->user();
        return view("frontend.user.profile", compact(["user"]));
    }

    public function passwordUpdate()
    {
        return view("frontend.user.password_update");
    }

    public function updatePasswordUpdate(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->update();
            return redirect()->route('profile')->with("update", "Password Updated Success");
        }

        return back()->withErrors(["current_password" => "Current Password is Invalid! Try Again."])->withInput();
    }

    public function userWallet()
    {;
        $user = Auth::guard("web")->user();
        return view("frontend.wallet.wallet", compact(["user"]));
    }

    public function transfer()
    {
        $user = Auth::guard("web")->user();
        return view("frontend.wallet.transfer", compact(["user"]));
    }

    public function transfer_confirm(Request $request)
    {
        $user = Auth::guard("web")->user();
        $to_phone = $request->to_phone;
        $amount = $request->amount;
        $description = $request->description;

        if ($amount < 1000) {
            return back()->withErrors([
                "amount" => "Amount at least 1000 MMK"
            ])->withInput();
        }

        return view("frontend.wallet.transfer_confirm", compact([
            "user",
            "to_phone",
            "amount",
            "description"
        ]));
    }

    public function transfer_continue(Request $request)
    {
        dd($request->all());
    }

    public function phoneVerify(Request $request)
    {
        $phoneNumber = $request->phoneNumber;
        $receiverAcc = User::where("phone", $phoneNumber)->first();
        if ($receiverAcc) {
            return response()->json([
                "status" => 200,
                "data" => $receiverAcc->name
            ]);
        }

        return response()->json([
            "status" => 404,
            "message" => "Account Not Found!"
        ]);
    }

    public function passwordVerify(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => 200,
                "data" => $user
            ]);
        }
        return response()->json([
            "status" => 403,
            "message" => "Invalid Password!"
        ]);
    }

    public function makeTransaction(Request $request)
    {
        $receiverPhone = $request->receiverPhone;
        $amount = $request->amount;

        DB::beginTransaction();

        try {
            $sender = auth()->user();
            $receiver = User::where("phone", $receiverPhone)->first();

            if ($sender != null && $receiver->id != null) {

                if ($sender->wallet == null) {
                    return response()->json([
                        "status" => 400,
                        "message" => "Your Wallet is Invalid! Please Try Again."
                    ]);
                }

                if ($receiver->wallet == null) {
                    return response()->json([
                        "status" => 400,
                        "message" => "Receiver Wallet is Invalid! Please Try Again."
                    ]);
                }

                $senderWallet = $sender->wallet;
                $senderWallet->decrement("amount", $amount);
                $senderWallet->update();


                $receiverWallet = $receiver->wallet;
                $receiverWallet->increment("amount", $amount);
                $receiverWallet->update();

                DB::commit();

                return response()->json([
                    "status" => 200,
                    "message" => "Transaction Success",
                ]);
            } else {
                throw new ErrorException();
            }
        } catch (Exception $th) {
            DB::rollBack();
            return response()->json([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }
}
