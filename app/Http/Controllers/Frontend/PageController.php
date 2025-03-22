<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index()
    {
        return view("frontend.home");
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
}
