@extends('admin.layouts.app')
@section('title', 'Payment List')

@section('pagebar')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Payment List</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="card-title">Payment List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm" id="payment_list">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment Id</th>
                                <th>Payer E-mail</th>
                                <th>Order</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{\Carbon\Carbon::parse($payment->date)->diffForHumans()}}</td>
                                <td>{{$payment->amount}} {{$payment->currency}}</td>
                                <td>{{$payment->payment_id}}</td>
                                <td>{{$payment->payer_email}}</td>
                                <td>
                                    <a href="{{route('admin.orders.show', ['order' => $payment->order_id])}}">View Order</a>    
                                </td>                              
                                <td>{{$payment->payment_status}}</td>
                            </tr>
                            @empty                                
                            @endforelse
                           
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
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
        $('#payment_list').dataTable({
            columnDefs: [
                {targets: -1, orderable: false, searchable: false}
            ],
        });
    });
</script>
@endpush