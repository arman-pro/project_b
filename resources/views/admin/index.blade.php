@extends('admin.layouts.app')
@section("title", "Admin Panel")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Dashboard</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">Home</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12 col-sm-12">
    <div class="card">
      <div class="card-header bg-light">
        <h4 class="card-title">Quick Access</h4>
      </div>
      <div class="card-body">
        <a href="{{route("admin.category.create")}}" class="btn btn-sm btn-primary">Create Category</a>
        <a href="{{route("admin.blogs.create")}}" class="btn btn-sm btn-info">Create Blog</a>
        <a href="{{route("admin.blogs.index")}}" class="btn btn-sm btn-success">Blog List</a>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
            {{-- total category --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Categories</span>
                  <span class="info-box-number">{{$total_category ?? 0}}</span>
                </div>
              </div>
            </div> 

            {{-- total blog --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Blogs</span>
                  <span class="info-box-number">{{$total_blogs ?? 0}}</span>
                </div>
              </div>
            </div> 

            {{-- total client --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Clients</span>
                  <span class="info-box-number">{{$total_clients ?? 0}}</span>
                </div>
              </div>
            </div> 

            {{-- total orders --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Orders</span>
                  <span class="info-box-number">{{$total_orders ?? 0}}</span>
                </div>
              </div>
            </div> 

            {{-- total admins --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Admins</span>
                  <span class="info-box-number">{{$total_admins ?? 0}}</span>
                </div>
              </div>
            </div> 

           </div>
        </div>
      </div>
    </div>
</div>

@endsection