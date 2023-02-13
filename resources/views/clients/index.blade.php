@extends('clients.layouts.app')
@section("title", "Dashboard")

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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            {{-- total orders --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Orders</span>
                  <span class="info-box-number">{{$total_orders ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>  

            {{-- pending orders --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pending Orders</span>
                  <span class="info-box-number">{{$pending_orders ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>  

            {{-- Processing orders --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="far fa-flag"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Processing Orders</span>
                  <span class="info-box-number">{{$processing_orders ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>  

            {{-- Processing orders --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Complete Orders</span>
                  <span class="info-box-number">{{$complete_orders ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>  
          </div> 
          <div class="row">
            {{-- Processing orders --}}
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-window-close"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Cancel Orders</span>
                  <span class="info-box-number">{{$ccancel_orders ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>  
          </div>         
        </div>
      </div>
    </div>
  </div>

  {{-- user card --}}
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header bg-success">
          <h4 class="card-title">User Details</h4>
        </div>
        <div class="card-body">
          <table class="tale table-sm">
            <tbody>
              <tr>
                <th>Name</th>
                <td>{{$user->name}}</td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>{{$user->email}}</td>
              </tr>
              <tr>
                <th>Phone/WhatsApp</th>
                <td>{{$user->phone ?? "N/A"}}</td>
              </tr>
              <tr>
                <th>Company Name</th>
                <td>{{$user->company_name ?? "N/A"}}</td>
              </tr>
              <tr>
                <th>Address</th>
                <td>{{$user->address ?? "N/A"}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
@endsection