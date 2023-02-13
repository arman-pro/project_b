@extends('clients.layouts.app')
@section("title", "Order List")

@section('pagebar')
<div class="row mb-1">
    <div class="col-sm-6">
      <h3 class="m-0">Order List</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Order List</li>
      </ol>
    </div>
</div>
<div class="row mb-1">
    <div class="col-sm-12">
      <a href="{{route("dashboard.orders.create")}}" class="btn btn-sm btn-warning">Add Order</a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="card-title">Order List</h4>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-sm table-ordered" id="order_table">
                    <thead class="bg-light">
                        <tr>
                            <th>SL</th>
                            <th>Job Type</th>
                            <th>Image Qty.</th>
                            <th>Delivery Date</th>
                            <th>Image Dest.</th>
                            <th>Job Desc.</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders->isNotEmpty())
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->job_type}}</td>
                            <td>{{$order->image_qty}}</td>
                            <td>{{date('d/m/y', strtotime($order->delivery_date))}}</td>
                            <td>
                                {{-- {{$order->image_destination}} <br/> --}}
                                @if($order->image_destination)
                                    <a href="{{$order->image_destination}}" target="_blank" rel="noopener noreferrer">Click Here</a>
                                @else 
                                    N/A 
                                @endif
                            </td>
                            <td>
                                <a class="job_description" href="javascript:void(0)" data-message="{{$order->job_description}}">See Job Description</a>
                            </td>
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
                            <td>{{date("d/m/y", strtotime($order->created_at))}}</td>
                            <td>
                                <div class="btn-group dropstart">
                                    <button type="button" class="btn btn-success btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">                                        
                                        <a class="dropdown-item" href="{{route('dashboard.orders.edit', ['order' => $order->id])}}">Edit</a>
                                        <a class="dropdown-item delete_btn" href="javascript:void(0)" data-link="{{route('dashboard.orders.destroy', ['order' => $order])}}">Delete</a>
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
<form action="" id="delete_form" method="post">
    @csrf @method('DELETE')
</form>
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
        $('#order_table').dataTable({
            columnDefs: [
                {targets: -1, orderable: false, searchable: false}
            ],
        });

        $(".job_description").on("click", function(){
            var message = $(this).data('message');
            Swal.fire({
                text: message,
            });
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
        });
    });
</script>
@endpush