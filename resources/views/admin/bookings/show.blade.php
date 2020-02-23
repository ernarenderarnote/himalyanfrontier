@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Booking Details
    </div>
        @php
            $booker_name    = json_decode($booking->name);
            $booker_email   = json_decode($booking->email);
            $booker_contact = json_decode($booking->mobile);
            $booker_age     = json_decode($booking->age);
            $booker_gender  = json_decode($booking->gender);
            $booker_city    = $booking->city;
            $total_price    = $booking->no_of_participants * $booking->activity_price;
            $included_tax   = ($total_price/100 ) * $booking->bank_charges; 
        @endphp
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="general_details">
                    <h3>{{$booking->itinerary->title}}</h3><hr/>
                    <p><span><b>Booking ID:</b> </span> #{{$booking->tracking_booking_id}}</p>
                    <p><span><b>Tracking ID:</b></span> {{$booking->booking_id}}</p>
                    <p><span><b>Booking Date:</b> </span> {{\Carbon\Carbon::parse($booking->created_at)->format('d M Y')}}</p>
                    <p><span><b>Activity Start Date:</b> </span> {{\Carbon\Carbon::parse($booking->activity_from_date)->format('d M Y')}}</p>
                    <p><span><b>Activity End Date:</b> </span> {{\Carbon\Carbon::parse($booking->activity_to_date)->format('d M Y')}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="booker_details">
                    <h3><p></p><br/></h3>
                    <p><span><b>Booker Name:</b> </span>{{$booker_name[0]}}</p>
                    <p><span><b>Email ID:</b></span> {{$booker_email[0]}}</p>
                    <p><span><b>Contact:</b> </span> {{$booker_contact[0]}}</p>
                    <p><span><b>City:</b> </span> {{$booker_city}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="booker_status">
                    <h3><p></p><br/></h3>
                    <p>
                        <form action="{{ route("admin.booking.update", [$booking->id]) }}" class="booking_status" method="post">
                            <span><b>Booking Status:</b></span>
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <select name="booking_status">
                                <option value="completed" {{$booking->booking_status =='completed' ? 'selected' : ''}} >Completed</option>
                                <option value="partial_completed" {{$booking->booking_status == 'partial_completed' ? 'selected' : ''}}>Partial Completed</option>
                                <option value="pending" {{$booking->booking_status =='pending' ? 'selected' : '' }}>Pending</option>
                                <option value="canceled" {{$booking->booking_status =='canceled' ? 'selected' : ''}}>Canceled</option>
                            </select>
                        </form>  
                    </p>
                    <p><span><b>Order Total:</b></span> {{$booking->currency->symbol}} {{ round( ($total_price  + $included_tax) ,2) }} </p>
                    <p><span><b>Paid Amount:</b> </span> {{$booking->currency->symbol}} {{ round($booking->payment_paid,2) }}</p>
                    <p><span><b>Remaining Amount:</b> </span> {{$booking->currency->symbol}}{{ round($booking->remaining_payment,2) }} </p>
                    @if($booking->booking_status != 'completed')
                        <p><span><b>Blance Due Date:</b> </span> {{\Carbon\Carbon::parse($booking->balance_due_date)->format('d M Y')}} </p>
                    @endif  
                </div>
            </div>
        </div>
        @if($booking->no_of_participants > 1)
            <div class="Prcening_details participants_details">
                <h4>Additional Details</h4>
                <p>Additional Participants Details (Excluded Booker )</p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                    @for($i=1; $i < count($booker_name); $i++)
                        <tr>
                            <td>{{ $booker_name[$i] }}</td>
                            <td>{{ $booker_email[$i] }}</td>
                            <td>{{ $booker_contact[$i] }}</td>
                            <td>{{ $booker_age[$i] }}</td>
                            <td>{{ $booker_gender[$i] }}</td>
                        </tr>
                    @endfor    
                    </tbody>
                </table>
            </div>
        @endif    
        <div class="Prcening_details">
            <h4>Pricing Details</h4>
            <p>Pricing Details (Including Bank Charges)</p>
              
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">No of Person</th>
                    <th scope="col">Per Person Price</th>
                    <th scope="col">Bank Charges ({{$booking->bank_charges}} %)</th>
                    <th scope="col">Ammount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Himachal</td>
                        <td>{{$booking->no_of_participants }}</td>
                        <td>{{$booking->currency->symbol}}{{ round($booking->activity_price,2) }}</td>
                        <td>{{$booking->currency->symbol}}{{ round($included_tax, 2) }}</td>
                        <td>{{$booking->currency->symbol}}{{round($total_price,2)}}</td>
                        </tr>
                        <tr>
                        <td colspan="4">Total Payable</td>
                        <td> {{$booking->currency->symbol}}{{ round( ($total_price  + $included_tax) ,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection