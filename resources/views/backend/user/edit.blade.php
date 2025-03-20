@extends('backend.layouts.app')
@section('title', 'Edit Users')
@section('user-active', 'mm-active')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit User</div>
        </div>
    </div>
</div>

<div class="content">

    @include("backend.layouts.flash")

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.user.update', $user->id)}}" method="POST" id="updateUser">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $user->name)}}">
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{old('email', $user->email)}}">
                </div>

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{old('phone', $user->phone)}}">
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary btn-back mr-3">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("scripts")
{!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest', '#updateUser'); !!}
@endsection