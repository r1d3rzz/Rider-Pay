<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UUIDGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Jenssegers\Agent\Agent;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("backend.user.index", compact("users"));
    }

    public function show() {}

    public function create()
    {
        return view("backend.user.create");
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            Wallet::firstOrCreate([
                "user_id" => $user->id, //for condition
            ], [
                "account_number" => UUIDGenerator::GenerateCardNumber(),
                "amount" => 0
            ]);

            DB::commit();

            return redirect()->route("admin.user.index")->with("create", "Create Successfully.");
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return "/ErrorPage";
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("backend.user.edit", compact(["user"]));
    }

    public function update($id, UpdateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "password" => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            Wallet::firstOrCreate([
                "user_id" => $user->id, //for condition
            ], [
                "account_number" => UUIDGenerator::GenerateCardNumber(),
                "amount" => 0
            ]);

            DB::commit();

            return redirect()->route("admin.user.index")->with("update", "Update Successfully.");
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            return "/ErrorPage";
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return "success";
    }

    //For DataTable
    public function ssd()
    {
        $data = User::query();
        return DataTables::of($data)
            ->editColumn("user_agent", function ($each) {
                $agent = new Agent();
                $agent->setUserAgent($each->user_agent);
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();

                $table = "<table class='table table-bordered table-danger'>
                    <tbody>
                        <tr>
                            <th>Device</th>
                            <td>$device</td>
                        </tr>
                        <tr>
                            <th>OS</th>
                            <td>$platform</td>
                        </tr>
                        <tr>
                            <th>Browser</th>
                            <td>$browser</td>
                        </tr>
                    </tbody>
                </table>";

                if ($each->user_agent) {
                    return $table;
                } else {
                    return "-";
                }
            })
            ->editColumn("created_at", function ($each) {
                return Carbon::parse($each->created_at)->format("Y-m-d H:i:s");
            })
            ->editColumn("updated_at", function ($each) {
                return Carbon::parse($each->updated_at)->format("Y-m-d H:i:s");
            })
            ->addColumn("action", function ($each) {
                $editBtn = "<a href=" . route("admin.user.edit", $each->id) . " class='text-warning mr-3'><i class='fas fa-edit'></i></a>";
                $delBtn = "<a href='#' data-id='" . $each->id . "' class='text-danger btn-User-delete'><i class='fas fa-trash-alt'></i></a>";
                return "<div>" . $editBtn . $delBtn . "</div>";
            })
            ->rawColumns(["action", "user_agent"])
            ->make(true);
    }
}
