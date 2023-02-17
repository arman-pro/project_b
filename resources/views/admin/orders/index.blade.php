@extends('admin.layouts.app')
@section("title", "Order List")

@section('pagebar')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Order List</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{route('admin.index')}}">Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">Order List</li>
      </ol>
    </div>
</div>
<div class="row mb-2">
    <div class="col-sm-12">
     <button class="btn btn-sm btn-warning" id="filter_btn" type="button">Filter</button>
    </div>
</div>
<div class="row mb-2" id="filter_form">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.orders.index')}}" method="get">
                    <div class="form-row">
                        <div class="col-sm-4 form-group">
                            <label for="user">User</label>
                            <select 
                                name="user" id="user" 
                                multiple="multiple"
                                data-placeholder="Select a User"
                                data-allowClear="true"
                                class="form-control select2 select2-primary"
                            >
                                @foreach ($users as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="type">Job Type</label>
                            <select 
                                name="type" id="type"
                                multiple="multiple" data-placeholder="Select Job Type"
                                data-allowClear="true"
                                class="form-control select2 select2-primary"
                            >
                                @foreach(get_order_job_types() as $type)
                                    <option value="{{urlencode($type)}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="status">Status</label>
                            <select 
                                name="status" id="status" 
                                multiple="multiple" data-placeholder="Select Status" 
                                class="form-control select2 select2-primary"
                                data-allowClear="true"
                            >
                                <option value="1">Pending</option>
                                <option value="2">Processing</option>
                                <option value="3">Complete</option>
                                <option value="0">Cancel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-success">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
            <h4 class="card-title">All Order List</h4>
        </div>
        <div class="card-body overflow-auto">
          <table class="table table-sm table-bordered" id="order_lists">
            <thead class="bg-light">
                <tr>
                    <th>SL</th>
                    <th>User</th>
                    <th>Job Type</th>
                    <th>Image Qty.</th>
                    <th>Delivery Date</th>
                    <th>Image Dest.</th>
                    <th>Job Description</th>                    
                    <th>Status</th>                   
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($orders->isNotEmpty())
                @foreach($orders as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->job_type}}</td>
                    <td>{{$order->image_qty}}</td>
                    <td>{{date('d/m/y', strtotime($order->delivery_date)) ?? "N/A"}}</td>
                    <td> 
                       <a href="{{$order->image_destination}}" target="_blank">Click Here</a>
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
                    <td class="text-center">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-success btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{route("admin.orders.show", ["order" => $order->id])}}">Show</a>
                                <a 
                                    class="dropdown-item delete_btn" href="javascript:void(0)"
                                    data-link="{{route("admin.orders.destroy", ["order" => $order->id])}}"
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

{{-- delelete form --}}
<form action="" id="delete_form" method="post">@method("DELETE") @csrf</form>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('js')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
        });

        $("#filter_form").hide();
        $("#filter_btn").click(function() {
            $('#filter_form').toggle('slow');
        });
    });

    $(document).ready(function() {
        $('#order_lists').dataTable({
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