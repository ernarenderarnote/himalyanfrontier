@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Transections Details
    </div>
    <div class="card-body">
        <h3><span>Order Tracking ID: </span><span class="badge badge-secondary">{{$transection->order_id }}<span></span></h3><hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="general_details">
                    <p><span><b>Booking ID:</b> </span><span class="badge badge-success">#{{isset($transection->booking->tracking_booking_id) ? $transection->booking->tracking_booking_id : '' }}</span></p>
                    <p><span><b>Email:</b> </span>{{$transection->email}}</p>
                    <p><span><b>Phone:</b> </span>{{$transection->telephone}}</p>
                    <p><span><b>Billing Name:</b> </span>{{$transection->billing_name}}</p>
                    <p><span><b>Billing Address:</b> </span>{{$transection->billing_address}}</p>
                    <p><span><b>City:</b> </span>{{$transection->city}}</p>
                    <p><span><b>State:</b> </span>{{$transection->state}}</p>
                    <p><span><b>Zip:</b> </span>{{$transection->zip}}</p>
                    <p><span><b>Country:</b> </span>{{$transection->country}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="general_details">
                    <p><span><b>Tracking ID:</b> </span>{{$transection->tracking_id}}</p>
                    <p><span><b>Bank Refrence Number:</b> </span>{{$transection->bank_ref_no}}</p>
                    <p><span><b>Transection Date:</b> </span>{{$transection->trans_date}}</p>
                    <p><span><b>Payment Mode:</b> </span>{{$transection->payment_mode}}</p>
                    <p><span><b>Card Name:</b> </span>{{$transection->card_name}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="general_details">
                    <p><span><b>Billing Name:</b> </span>{{$transection->billing_name}}</p>
                    <p><span><b>Amount Paid:</b> </span>{{$transection->currency_data->symbol}} {{$transection->mer_amount}}</p>
                    <p><span><b>Order Status:</b> </span><span class="badge badge-success">{{$transection->order_status}}</span></p>
                </div>
            </div>
        </div>
            
    </div>
</div>    

@endsection