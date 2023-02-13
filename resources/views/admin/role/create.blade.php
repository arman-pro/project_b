@extends('admin.layouts.app')
@section("title", "Create Role Permissions")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Create Role Permission</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('admin.roles.index')}}">Role Permission</a>
        </li>
        <li class="breadcrumb-item active">Create Role</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Create Role</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.roles.store')}}" method="post">
                @csrf
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
</div>
@endsection