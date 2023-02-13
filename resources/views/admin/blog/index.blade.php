@extends('admin.layouts.app')
@section("title", "Blog List")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Blog List</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">Blog List</li>
      </ol>
    </div>
</div>

<div class="row mb-2">
    <div class="col-sm-12">
        <a href="{{route("admin.blogs.create")}}" class="btn btn-sm btn-success">Create Blog</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">All Blog List</h4>
        </div>
        <div class="card-body">
          
        </div>
      </div>
    </div>
</div>
@endsection