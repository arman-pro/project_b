@extends('admin.layouts.app')
@section("title", "Show Order Detail")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Show Order Detail</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('admin.orders.index')}}">Order List</a>
        </li>
        <li class="breadcrumb-item active">Show Order Detail</li>
      </ol>
    </div>
</div>
<div class="row mb-2">
    <div class="col-sm-12">
     <a class="btn btn-sm btn-success" href="{{route('admin.orders.index')}}">Back</a>
    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">Order Detail</h4>
        </div>
        <div class="card-body overflow-auto">
            <form action="{{route("admin.orders.update", ['order' => $order->id])}}" method="POST">
                @csrf @method('PUT')
            <table class="table table-sm table-bordered">
                <tbody>
                    <tr>
                        <th style="width:180px;">Job Type</th>
                        <td>{{$order->job_type}}</td>
                    </tr>
                    <tr>
                        <th>Order By</th>
                        <td>{{$order->user->name}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($order->status == 1)
                                <span class="badge badge-warning">Pending</span>
                            @elseif($order->status == 2)
                                <span class="badge badge-info">Processing</span>
                            @elseif($order->status == 3)
                                <span class="badge badge-success">Complete</span>
                            @elseif($order->status == 0)
                                <span class="badge badge-danger">Cancel</span>
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <th>Delivery Date</th>
                        <td>{{date('d/m/y', strtotime($order->job_type))}}</td>
                    </tr>
                    <tr>
                        <th>Image Quantity</th>
                        <td>{{$order->image_qty ?? 0}}</td>
                    </tr>
                    <tr>
                        <th>Image Destination</th>
                        <td>
                            <a href="{{$order->image_destination}}" target="_blank" rel="noopener noreferrer">Click Here</a>    
                        </td>
                    </tr>
                    <tr>
                        <th>Job Description</th>
                        <td>{{$order->job_description ?? "N/A"}}</td>
                    </tr>
                    <tr>
                        <th>Gallery</th>
                        <td>
                            @forelse ($galleries as $gallery)
                                <a href="{{asset('storage/gallery/' . $gallery)}}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{asset("storage/gallery/" . $gallery)}}" class="img-thumbnail" alt="..." style="width: 300px;" />
                                </a>
                            @empty   
                            N/A                             
                            @endforelse    
                        </td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Change Status</th>
                        <td>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    <option value="" hidden>Select a Status</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Processing</option>
                                    <option value="3">Complete</option>
                                    <option value="0">Cancel</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection

@push('js')

<script>

    $(document).ready(function() {
        // here will be our code...
    });
</script>
@endpush