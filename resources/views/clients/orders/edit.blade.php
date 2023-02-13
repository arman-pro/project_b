@extends('clients.layouts.app')
@section('title', "Edit Order")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Edit Order</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route("dashboard.orders.index")}}">Order List</a>
        </li>
        <li class="breadcrumb-item active">Edit Order</li>
      </ol>
    </div>
</div>
<div class="row mb-1">
    <div class="col-sm-12">
      <a href="{{route("dashboard.orders.index")}}" class="btn btn-sm btn-warning">Back</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-11 m-auto">
        <form action="{{route("dashboard.orders.update", ['order' => $order->id])}}" method="post">
            @method("PUT")
            @csrf
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title">Edit Order</h4>
                </div>
                <div class="card-body">                
                    <div class="form-col">
                        <div class="form-group row">
                            <label for="job_type" class="col-sm-3 col-form-label text-right">Job Type*</label>
                            <div class="col-sm-9">
                                <select name="job_type" id="job_type" class="form-control @error('job_type') is-invalid @enderror" required>
                                <option value="" hidden>Select Job Type</option>
                                @foreach(get_order_job_types() as $job_type) 
                                    <option @if($order->job_type == $job_type) selected @endif value="{{$job_type}}">{{$job_type}}</option>
                                @endforeach
                                </select>  
                                @error('job_type')
                                <div class="invalid-feedback">{{$message }}</div>  
                                @enderror              
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image_qty" class="col-sm-3 col-form-label text-right">Image Quantity*</label>
                            <div class="col-sm-9">
                                <input type="number" name="image_qty" id="image_qty" class="form-control @error('image_qty') is-invalid @enderror" value="{{$order->image_qty}}" placeholder="Image Quantity" required/>
                                @error('image_qty')
                                <div class="invalid-feedback">{{$message }}</div>  
                                @enderror
                            </div>                                        
                        </div>
                        <div class="form-group row">
                            <label for="delivery_date" class="col-sm-3 col-form-label text-right">Delivery Date*</label>
                            <div class="col-sm-9">
                                <input type="date" name="delivery_date" id="delivery_date" value="{{$order->delivery_date}}" class="form-control @error('delivery_date') is-invalid @enderror" required/>
                                @error('delivery_date')
                                <div class="invalid-feedback">{{$message }}</div>  
                                @enderror               
                            </div> 
                        </div>
                        <div class="form-group row">
                            <label for="image_destination" class="col-sm-3 col-form-label text-right">Image Destination*</label>
                            <div class="col-sm-9">
                                <input type="text" name="image_destination" value="{{$order->image_destination}}" id="image_destination" class="form-control @error('image_destination') is-invalid @enderror" placeholder="Image Destination (Links)" required/>
                                @error('image_destination')
                                <div class="invalid-feedback">{{$message }}</div>  
                                @enderror            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_description" class="col-sm-3 col-form-label text-right">Job Description*</label>
                            <div class="col-sm-9">
                                <textarea name="job_description" id="job_description" cols="30" rows="4" class="form-control @error('job_description') is-invalid @enderror" placeholder="Job Description">{{$order->job_description}}</textarea>
                                @error('job_description')
                                <div class="invalid-feedback">{{$message }}</div>  
                                @enderror         
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="job_description" class="col-sm-3 col-form-label text-right">&nbsp;</label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>                
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection



