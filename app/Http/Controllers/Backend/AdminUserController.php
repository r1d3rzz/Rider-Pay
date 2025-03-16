<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = AdminUser::all();
        return view("backend.admin-user.index", compact("users"));
    }

    public function show() {}

    public function create()
    {
        return view("backend.admin-user.create");
    }

    public function store(StoreAdminRequest $request)
    {
        $adminUser = new AdminUser();
        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->phone = $request->phone;
        $adminUser->password = Hash::make($request->password);
        $adminUser->save();

        return redirect()->route("admin.admin-user.index")->with("create", "Create Successfully.");
    }

    public function edit($id)
    {
        $user = AdminUser::findOrFail($id);
        return view("backend.admin-user.edit", compact(["user"]));
    }

    public function update($id, UpdateAdminRequest $request)
    {
        $adminUser = AdminUser::findOrFail($id);

        $adminUser->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "password" => $request->password ? Hash::make($request->password) : $adminUser->password,
        ]);

        return redirect()->route("admin.admin-user.index")->with("update", "Update Successfully.");
    }

    public function destroy($id)
    {
        $user = AdminUser::findOrFail($id);
        $user->delete();
        return "success";
    }

    //For DataTable
    public function ssd()
    {
        $data = AdminUser::query();
        return DataTables::of($data)
            ->addColumn("action", function ($each) {
                $editBtn = "<a href=" . route("admin.admin-user.edit", $each->id) . " class='text-warning mr-3'><i class='fas fa-edit'></i></a>";
                $delBtn = "<a href='#' data-id='" . $each->id . "' class='text-danger btn-adminUser-delete'><i class='fas fa-trash-alt'></i></a>";
                return "<div>" . $editBtn . $delBtn . "</div>";
            })
            ->make(true);
    }
}
