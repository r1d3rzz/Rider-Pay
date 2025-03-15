<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = AdminUser::all();
        return view("backend.admin-user.index", compact("users"));
    }

    public function show() {}

    public function create() {}

    public function edit() {}


    //For DataTable
    public function ssd()
    {
        $data = AdminUser::query();
        return DataTables::of($data)->make(true);
    }
}
