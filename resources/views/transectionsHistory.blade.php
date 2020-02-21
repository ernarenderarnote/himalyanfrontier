@extends('layouts.frontend')
@section('content')
<div class="container">
<section class="trave_outer">
	<div class="container">
		<div class="traveler_details">
			<h4>Transections Details</h4>
            <hr/>
			<table class="table table-bordered table_trevl">
                <thead>
                    <tr>
                        <th scope="col">Billing Name</th>
                        <th scope="col">OrderID</th>
                        <th scope="col">TrackingID</th>
                        <th scope="col">Bank Refrence Number</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Card Name</th>
                        <th scope="col">Ammount</th>
                        <th scope="col">Transection Date</th>
                        <th scope="col">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($transections as $transection)
                    <tr>
                    
                        <td scope="col">{{$transection->billing_name}}</td>
                        <td scope="col">{{$transection->order_id}}</td>
                        <td scope="col">{{$transection->tracking_id}}</td>
                        <td scope="col">{{$transection->bank_ref_no}}</td>
                        <td scope="col">{{$transection->payment_mode}}</td>
                        <td scope="col">{{$transection->card_name}}</td>
                        <td scope="col">{{$transection->currency}} {{$transection->mer_amount}}</td>
                        <td scope="col">{{$transection->trans_date}}</td>
                        <td scope="col">{{$transection->order_status}}</td>
                    </tr>
                @empty 
                    No Transections Made Yet....
                @endforelse  
                </tbody>
        </table>

        {{ $transections->links() }}
	</div>

</section>
</div>
@endsection