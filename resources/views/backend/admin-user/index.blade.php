@extends('backend.layouts.app')
@section('title', 'Admin Users')
@section('admin-user-active', 'mm-active')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Admin Users</div>
        </div>
    </div>
</div>

<div class="content">

    <div class="py-3">
        <a href="{{route('admin.admin-user.create')}}" class="btn btn-primary text-white"><i
                class="fas fa-plus-circle"></i> Create Admin User</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        let table = new DataTable('#example', {
            processing: true,
            serverSide: true,
            ajax: 'admin-user/datatable/ssd',
            columns: [
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "phone",
                    name: "phone",
                },
                {
                    data: "action",
                    name: "action",
                }
            ]
        });

        $(document).on("click", ".btn-adminUser-delete", function (e) {
            e.preventDefault();
            const id = $(this).data("id");

            Swal.fire({
                title: "Are you sure?",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                     $.ajax({
                        url: "/admin/admin-user/" + id,
                        type: "DELETE",
                        success: function(res){
                            if(res == "success"){
                                table.ajax.reload();
                                Swal.fire({
                                    title: "Deleted!",
                                    icon: "success"
                                });
                            }
                        }
                    });
                }
            });
        });
    })
</script>
@endsection
