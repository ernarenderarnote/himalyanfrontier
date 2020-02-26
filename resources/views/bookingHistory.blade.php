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
                                <td><b>Order Placed</b></td>
                                <td><b>TOTAL</b></td>
                                @if($booking->booking_status == 'completed')
                                    <td><b>Payment Completed</b></td>
                                    @else
                                    <td><b>Remaining Payment</b></td>
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
                                @if(isset($booking->booking_status) && $booking->booking_status == 'canceled')
                                    <td class="custom_oeder4"><span class="badge badge-danger">{{isset($booking->booking_status) ? str_replace('_',' ',ucwords($booking->booking_status) ) : ''}}</span></td>
                                @elseif(isset($booking->booking_status) && $booking->booking_status == 'partial_completed')
                                    <td class="custom_oeder4"><span class="badge badge-warning">{{isset($booking->booking_status) ? str_replace('_',' ',ucwords($booking->booking_status) ) : ''}}</span></td>
                                @elseif(isset($booking->booking_status) && $booking->booking_status == 'completed')
                                    <td class="custom_oeder4"><span class="badge badge-success">{{isset($booking->booking_status) ? str_replace('_',' ',ucwords($booking->booking_status) ) : ''}}</span></td>    
                                @endif
                            </tr>
                        </table>
                    </div>
                    <div class="ordr34">
                        <h4>{{isset($booking->itinerary->title) ? $booking->itinerary->title : ''}}</h4>
                        <p>{{isset($booking->itinerary->subtitle) ? $booking->itinerary->subtitle : ''}}</p>
                        </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="order2">
                                    <img class="img-thumbnail" src="{{ url('/storage/images/itinerary/featureImages/'.$booking->itinerary->feature_img) }}">
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
                                        <span style="font-weight:bold;">Booked BY:</span><span>{{$booker_name[0]}}</span><br/>
                                        <span style="font-weight:bold;">Email ID: </span><span> {{$booker_email[0]}}</span><br/>
                                        <span style="font-weight:bold;">Contact Number: </span><span> {{$booker_contact[0]}}</span><br/>
                                        <span style="font-weight:bold;">Travel Location: </span><span> {{$booker_city}}</span><br/>
                                        <span style="font-weight:bold;">Activity Start Date: </span><span class="badge badge-info"> @if($booking->activity_from_date) {{\Carbon\Carbon::parse($booking->activity_from_date)->format('d M Y')}} @endif </span><br/>
                                        <span style="font-weight:bold;">Activity End Date: </span><span class="badge badge-info"> @if($booking->activity_to_date) {{\Carbon\Carbon::parse($booking->activity_to_date)->format('d M Y')}} @endif </span><br/>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="eturen_outer">
                                    <div class="return67 grey99">
                                        <a href="{{ route('bookingDetails', $booking->booking_id) }}">View Order Details</a>
                                    </div>
                                    @if($booking->booking_status != 'completed' && $booking->tracking_booking_id != NULL && $booking->booking_status != 'canceled' && $booking->activity_from_date >= date('Y-m-d'))
                                        <div class="return67 grey99">
                                            <a href="{{ route('completePayment', $booking->tracking_booking_id) }}">Pay Remaining Amount</a>
                                        </div>
                                    @endif
                                    @if($booking->booking_status != 'canceled')    
                                        <div class="return67">
                                            <form method="post" action="{{route('cancelOrder',base64_encode($booking->id))}}">
                                                <input type="hidden" name="_method" value="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger cancel-order-btn" value="Cancel Order">
                                            </form>
                                        </div>
                                        @else
                                        <div class="return67">
                                            <a href="#" onclick="return false;">Canceled Order</a>
                                        </div>
                                    @endif    
                                </div>
                            </div>
                        </div>
                    
            @empty
            No Bookings

            @endforelse
            </div>
                </div>
        </div>
    </section>
</div>
@endsection