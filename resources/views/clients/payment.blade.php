@extends('clients.layouts.app')
@section('title', 'Online Payment')

@section('pagebar')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Payment</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        @csrf 
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <div class="form-group">
                            <label for="">Amount* ({{env('PAYPAL_CURRENCY', 'USD')}})</label>
                            <input type="number" min="0" name="amount" class="form-control" placeholder="Amount" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-sm">Pay with PayPal <i class="fa fa-paypal"></i></button>
                            <a href="{{route('dashboard.orders.index')}}" class="btn btn-outline-danger btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    Pay With Paypal
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush
