@extends('layouts.frontend')
@section('content')
<div class="container">
    <section class="delover_outer2">
        <div class="container">
       <div class="custom_heding"> <h3>Booking History</h3></div>
            @forelse($booking_history as $booking)
                <div class="row border_outer37">
                    <div class="table_uter">
                        <table class="deliver23">
                            <tr>
                                <td>ORDER PLACED</td>
                                <td>TOTAL</td>
                                @if($booking->booking_status == 'completed')
                                    <td>Payment Completed</td>
                                    @else
                                    <td>Remaining Payment</td>
                                @endif    
                                <td>&nbsp;</td>
                                <td class="custom_oeder4"><span class="badge badge-info">ORDER # {{$booking->tracking_booking_id}}</span></td>
                            </tr>
                            <tr>
                                @php 
                                $total_price    =  $booking->no_of_participants * $booking->activity_price;
                                $included_tax   = ($total_price/100 ) * $booking->bank_charges;
                                @endphp
                                <td>{{\Carbon\Carbon::parse($booking->created_at)->format('d M Y')}}</td>
                                <td>{{$booking->currency->symbol}} {{round( $total_price + $included_tax, 2) }}</td>
                                @if($booking->booking_status == 'completed')
                                    <td>{{\Carbon\Carbon::parse($booking->updated_at)->format('d M Y')}}</td>
                                    @else
                                    <td>{{$booking->currency->symbol}} {{round($booking->remaining_payment, 2) }}</td>
                                @endif    
                                <td>&nbsp;</td>
                                <td class="custom_oeder4">Order Status <span class="inoibe4">{{isset($booking->booking_status) ? strtoupper($booking->booking_status) : ''}}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="ordr34">
                        <h4>{{isset($booking->itinerary->title) ? $booking->itinerary->title : ''}}</h4>
                        <p>{{isset($booking->itinerary->subtitle) ? $booking->itinerary->subtitle : ''}}</p>
                        </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="order2">
                                    <img src="{{ url('/storage/images/itinerary/featureImages/'.$booking->itinerary->feature_img) }}">
                                </div>
                                
                                <!--<div class="text929">
                                    <h5>{{isset($booking->activity_price) ? $booking->activity_price : ''}}</h5>
                                    <div class="btton_ou7">
                                        <a href="#">Buy it again</a>
                                    </div>
                                </div> -->   
                            </div>
                            @php $booker_name    = json_decode($booking->name);
                                $booker_email   = json_decode($booking->email);
                                $booker_contact = json_decode($booking->mobile);
                                $booker_city    = $booking->city;
                            @endphp
                            <div class="col-md-5 col-sm-5 booking_details">
                                <div class="text9290">
                                    <p>
                                        <span>Booked BY: {{$booker_name[0]}}</span><br/>
                                        <span>Email ID: {{$booker_email[0]}}</span><br/>
                                        <span>Contact Number: {{$booker_contact[0]}}</span><br/>
                                        <span>Travel Location: {{$booker_city}}</span><br/>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="eturen_outer">
                                    <div class="return67 grey99">
                                        <a href="{{ route('bookingDetails', $booking->booking_id) }}">View Order Details</a>
                                    </div>
                                    @if($booking->booking_status != 'completed' && $booking->tracking_booking_id != NULL)
                                        <div class="return67 grey99">
                                            <a href="{{ route('completePayment', $booking->tracking_booking_id) }}">Pay Remaining Amount</a>
                                        </div>
                                    @endif    
                                    <div class="return67">
                                        <a href="#">Cancel Order</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            no Booking

            @endforelse
        </div>
    </section>
</div>
@endsection