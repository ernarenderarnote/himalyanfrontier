@extends('layouts.frontend')
@section('content')
<section class="booking_outer">
    <div class="container">
        <div class="row">	
            <div class="col-md-6 col-sm-6">
                <div class="booking5">
                <h4 class="itinerary_title"><a href="">{{isset($booking_detail->itinerary->title) ? $booking_detail->itinerary->title : ''}}</a></h4><hr/>
                    <h4>Booking Details</h4>
                    @php $booker_name    = json_decode($booking_detail->name);
                         $booker_email   = json_decode($booking_detail->email);
                         $booker_contact = json_decode($booking_detail->mobile);
                         $booker_age     = json_decode($booking_detail->age);
                         $booker_gender  = json_decode($booking_detail->gender);
                         $booker_city    = $booking_detail->city;
                         $total_price    =  $booking_detail->no_of_participants * $booking_detail->activity_price;
                         $included_tax   = ($total_price/100 ) * $booking_detail->bank_charges; 
                    @endphp
                    <table>
                        <tr>
                            <td>Booker Name</td>
                            <td class="dot6">:</td>
                            <td>{{$booker_name[0]}}</td>
                        </tr>
                        <tr>
                            <td>Email ID</td>
                            <td class="dot6">:</td>
                            <td>{{$booker_email[0]}}</td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td class="dot6">:</td>
                            <td>{{$booker_contact[0]}}</td>
                        </tr>
                        <tr>
                            <td>Booker Location</td>
                            <td class="dot6">:</td>
                            <td>{{$booker_city}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 right7">
                <div class="right_side">
                    <span class="total_img">
                    <p>Total Ammount</p>
                    <h4>{{$booking_detail->currency->symbol}} {{ round( ($total_price  + $included_tax) ,2) }}</h4>
                    </span>
                    <span class="total_img red3">
                    <p>Paid Ammount</p>
                    <h4>{{$booking_detail->currency->symbol}} {{ round($booking_detail->payment_paid,2) }}</h4>
                    </span>
                </div>
                <div class="right_side">
                    <span class="total_img pink3">
                    <p>Blance Ammount</p>
                    <h4>{{$booking_detail->currency->symbol}}{{ round($booking_detail->remaining_payment,2) }}</h4>
                    </span>
                    @if($booking_detail->booking_status != 'completed')
                        <span class="total_img lighr5">
                            <p>Blance Due Date</p>
                            <h4>{{\Carbon\Carbon::parse($booking_detail->balance_due_date)->format('d M Y')}}</h4>
                        </span>
                    @endif  
                </div>
                    @if($booking_detail->booking_status != 'completed')
                        <div class="return67 grey100">
                            <a href="{{ route('completePayment', $booking_detail->tracking_booking_id) }}">Pay Remaining Amount</a>
                        </div>
                    @endif
               
            </div>
        </div>
        @if($booking_detail->no_of_participants > 1)
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
                    <th scope="col">Bank Charges ({{$booking_detail->bank_charges}} %)</th>
                    <th scope="col">Ammount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Himachal</td>
                        <td>{{ $booking_detail->no_of_participants }}</td>
                        <td>{{$booking_detail->currency->symbol}}{{ round($booking_detail->activity_price,2) }}</td>
                        <td>{{$booking_detail->currency->symbol}}{{ round($included_tax, 2) }}</td>
                        <td>{{$booking_detail->currency->symbol}}{{round($total_price,2)}}</td>
                        </tr>
                        <tr>
                        <td colspan="4">Total Payable</td>
                        <td> {{$booking_detail->currency->symbol}}{{ round( ($total_price  + $included_tax) ,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection