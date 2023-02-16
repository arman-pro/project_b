@extends('admin.layouts.app')
@section("title", "Admin List")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Admin List</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route("admin.index")}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">Admin List</li>
      </ol>
    </div>
</div>
<div class="row mb-2">
    <div class="col-sm-12">
     <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-warning">Create Admin</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Admin User List</h4>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered" id="user_lists">
                <thead class="bg-light">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($admins->isNotEmpty())
                    @foreach($admins as $admin)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->getRoleNames()[0] ?? "N/A"}}</td>
                        <td>
                            @if($admin->is_active)
                                <span class="badge badge-success">Active</span>
                            @else 
                                <span class="badge badge-danger">Deactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group dropstart">
                                <button type="button" class="btn btn-success btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{route("admin.users.edit", ['user' => $admin->id])}}">Edit</a>
                                    <a 
                                        class="dropdown-item delete_btn" href="javascript:void(0)"
                                        data-link="{{route('admin.users.destroy', ['user' => $admin->id])}}"
                                    >Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
{{-- delete form --}}
<form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@push('js')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#user_lists').dataTable({
            columnDefs: [
                {targets: -1, orderable: false, searchable: false}
            ],
        });

        $(document).on('click', '.delete_btn', function(){
            let link = $(this).data('link');
            Swal.fire({
                title: 'Are you sure to delete?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete It!'
            }).then((result) => {
                if(result.isConfirmed) {
                    $("#delete_form").attr('action', link);
                    $('#delete_form').submit();
                }else {
                    return;
                }
            });
        })
    });
</script>
@endpush