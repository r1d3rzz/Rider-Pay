<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UUIDGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\User;
use App\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use function App\Helpers\fail;
use function App\Helpers\success;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $formData = $request->validate([
            "phone" => ["required"],
            "password" => ["required"]
        ]);

        if (Auth::attempt($formData)) {

            $token = auth()->user()->createToken("Rider Pay")->accessToken;
            return success("Login Success", [
                "token" => $token
            ]);
        } else {
            return success("Phone or Password is Wrong!");
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                "name" => ["required", "min:3", "max:50"],
                "email" => ["required", "email", Rule::unique("users", "email")],
                "phone" => ["required", "min:10", "max:13", Rule::unique("users", "phone")],
                "password" => ["required", "min:8", "max:16"],
            ]);

            DB::beginTransaction();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->ip = $request->ip();
            $user->user_agent = $request->server("HTTP_USER_AGENT");
            $user->login_at = date("Y-m-d H:m:s");
            $user->save();

            Wallet::firstOrCreate([
                "user_id" => $user->id, //for condition
            ], [
                "account_number" => UUIDGenerator::GenerateCardNumber(),
                "amount" => 0
            ]);

            $token = $user->createToken('Rider Pay')->accessToken;

            DB::commit();

            return success("register success", [
                "token" => $token
            ]);
        } catch (Exception $error) {
            DB::rollBack();
            return fail($error->getMessage());
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return success("logout success", [
            "user_id" => auth()->id()
        ]);
    }
}
