@extends('backend.layouts.app')
@section('title', 'Create New Admin Users')
@section('admin-user-active', 'mm-active')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Create New Admin User</div>
        </div>
    </div>
</div>

<div class="content">

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.admin-user.store')}}" method="POST" id="storeAdmin">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary btn-back mr-3">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Admin User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("scripts")
{!! JsValidator::formRequest('App\Http\Requests\StoreAdminRequest', '#storeAdmin'); !!}
@endsection
