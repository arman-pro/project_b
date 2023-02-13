@extends('admin.layouts.app')
@section("title", "Role Permissions")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Role Permission List</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">Role Permission</li>
      </ol>
    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-sm-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Role Permission</h4>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead class="bg-light">
                    <tr>
                        <th>SL</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                @if($roles->isNotEmpty())
                    @foreach($roles as $role)
                    <tbody>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$role->name}}</td>
                            <td class="text-center">
                                <div class="btn-group dropstart">
                                    <button type="button" class="btn btn-success btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{route('admin.permission', ['role' => $role->id])}}">Assign Permission</a>
                                        <a 
                                            class="dropdown-item edit" 
                                            data-link="{{route('admin.roles.update', ['role' => $role->id])}}"
                                            data-name="{{$role->name}}" 
                                            href="javascript:void(0)">Edit</a>
                                        <a class="dropdown-item delete_btn" href="javascript:void(0)">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                @endif
            </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12 m-auto">
       <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Create Role</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.roles.store')}}" method="post">
                @csrf
                <input type="hidden" name="create" value="1">
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" name="name" placeholder="Role Name" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" id="edit_form" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="edit_name" class="form-control">
                </div>
                <button type="submit" class="btn btn-sm btn-success">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $(document).on("click", ".edit", function(){
            let link = $(this).attr('data-link');
            let name = $(this).attr('data-name');
            $('#edit_form').attr('action', link);
            $('#edit_form input[name="name"]').val(name);
            $('#modal-default').modal('show');
        });
    });
</script>
@endpush