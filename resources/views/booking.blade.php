@extends('layouts.frontend')
@section('content')
<div class="container">
<div class="row col-md-12">
    <div class="col-lg-12 payment-div">
      <form id="payment-form" method="post" action="{{ route('makePayment') }}" novalidate="novalidate">
        @csrf
        <div class="p-r-0 p-l-0 m-t-20">
          <h4 class="text-center">{{$itinerary->title}}</h4>
        </div>
        <div class="payment-inner col-sm-12">
          <h4>Activity Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-6 form-group">
              <label>Activity Name: </label>
              <input type="hidden" name="activity_id" value="{{$itinerary->id}}">
              <input type="text" autocomplete="off" class="form-control" value="{{$itinerary->title}}" readonly="">
            </div>
            <div class="col-sm-6 form-group">
              <label>Date of Activity<span>*</span></label>
              <select class="select-box form-control select-option" name="booking_date" id="schedule_id" value="{{ old('booking_date') }}">
                <option value="">Select Activity Date</option>
                @forelse($itinerary->schedule as $schedule)
                  @if($schedule->from_date >= date('Y-m-d'))
                    @if(isset($selected_schedule_id) && $selected_schedule_id != '' )
                      <option value="{{$schedule->id}}" {{$selected_schedule_id == $schedule->id ? 'selected' : '' }}>{{\Carbon\Carbon::parse($schedule->from_date)->format('M d')}} to {{\Carbon\Carbon::parse($schedule->to_date)->format('M d Y')}}</option>
                    @else
                      <option value="{{$schedule->id}}">{{\Carbon\Carbon::parse($schedule->from_date)->format('M d')}} to {{\Carbon\Carbon::parse($schedule->to_date)->format('M d Y')}}</option>
                    @endif
                  @endif  
                @empty
                <option value="">No Dates Available</option>
                @endforelse
              </select>
              @if($errors->has('booking_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('booking_date') }}
                    </em>
              @endif
            </div>
          </div>
        </div>
        <div class="payment-inner col-sm-12">
          <h4>Personal Details</h4>
          <div class="personal-details-data">
            <h5 class="m-l-10 m-b-10 text-danger participant-h"></h5>
              <div class="row col-md-12">
                <div class="col-sm-3 form-group">
                  <label>Full Name<span>*</span></label>
                  <input type="text" class="form-control part-name" name="name[0]" placeholder="Full Name" value="{{ $user->full_name ?? '' }}">
                  @if($errors->has('name.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name.*') }}
                    </em>
                  @endif
                </div>
                <div class="col-sm-3 form-group">
                  <label>Email<span>*</span></label>
                  <input type="text" class="form-control part-email" name="email[0]" placeholder="Email" value="{{ $user->email ?? '' }}">
                  @if($errors->has('email.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email.*') }}
                    </em>
                  @endif
                </div>
                <div class="col-sm-3 form-group">
                  <label>Mobile<span>*</span></label>
                  <input type="text" class="form-control part-mobile" name="mobile[0]" placeholder="Mobile Number" value="{{ $user->phone ?? '' }}">
                  @if($errors->has('mobile.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('mobile.*') }}
                    </em>
                  @endif
                </div>
                <div class="col-sm-3 form-group">
                  <label>Age<span>*</span></label>
                  <input type="text" class="form-control part-age" name="age[0]" placeholder="Age" value="{{ $user->profile->age ?? '' }}">
                  @if($errors->has('age.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('age.*') }}
                    </em>
                  @endif
                </div>
              </div>
              <div class="clear"></div>
              <div class="row col-md-12">
                <div class="col-sm-3 form-group">
                  <label>Gender<span>*</span></label>
                  <select class="select-box form-control part-gender" id="gender" name="gender[0]"  tabindex="-1" aria-hidden="true">
                    <option value="">Select Gender</option>
                    <option value="male"   {{ isset($user->profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ isset($user->profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                  </select>
                  @if($errors->has('gender.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('gender.*') }}
                    </em>
                  @endif
                </div>
                <!--<div class="col-sm-2 form-group">
                  <label>Height<span>*</span></label>
                  <input type="text" class="form-control part-height" name="height[0]" placeholder="Height" value="{{ $user->profile->height ?? '' }}">
                  @if($errors->has('height.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('height.*') }}
                    </em>
                  @endif
                </div> -->
                <!--
                <div class="col-sm-2 form-group">
                  <label>Weight<span>*</span></label>
                  <input type="text" class="form-control part-weight" name="weight[0]" placeholder="Weight" value="{{ $user->profile->weight ?? '' }}">
                  @if($errors->has('weight.*'))
                    <em class="invalid-feedback">
                        {{ $errors->first('weight.*') }}
                    </em>
                  @endif
                </div>
                -->
              </div>
              
              <div class="clear"></div>
             
            </div>
    
          </div>
          
        <div class="payment-inner col-sm-12">
          <h4>Address Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-3 form-group">
              <label>Address<span>*</span></label>
              <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $user->profile->address ?? '' }}">
                @if($errors->has('address'))
                    <em class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </em>
                  @endif
            </div>
            <div class="col-sm-3 form-group">
              <label>Country<span>*</span></label>
              <select id="country" name="country" class="form-control" value="{{ old('country') }}">
								<option value="" selected disabled>Select</option>
                @foreach($countries as $key => $country)
                  <option value="{{$key}}"> {{$country}}</option>
                @endforeach
              </select>  
            </div>
            <div class="col-sm-3 form-group">
              <label>State<span>*</span></label>
              <select class="form-control" id="state" name="state">
              </select>
            </div>
            <div class="col-sm-3 form-group">
              <label>City<span>*</span></label>
              <input type="text" class="form-control" name="city" placeholder="City">
              @if($errors->has('city'))
                <em class="invalid-feedback">
                    {{ $errors->first('city') }}
                </em>
              @endif
            </div>
            <div class="col-sm-3 form-group">
              <label>Pin Code<span>*</span></label>
              <input type="text" class="form-control" name="pin_code" placeholder="Pin Code">
              @if($errors->has('pin_code'))
                <em class="invalid-feedback">
                    {{ $errors->first('pin_code') }}
                </em>
              @endif
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="payment-inner col-sm-12 number-per p-l-0 p-r-0">
          <h4>Additional Participants</h4>
          <div class="col-sm-3 form-group additional-participants">
            <label>Additional Participants</label>
              <select class="select-box form-control selectpicker select-option" name="additional_user" id="addparti">
                <option value="">select participants</option>
                @for( $i=1; $i<=20; $i++ )
                  <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
          </div>
          <div class="clear end-participants"></div>
        </div>
        <div class="payment-inner col-sm-12 p-l-0 p-r-0">
          <h4>Other Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-3 form-group">
              <label>How did you find about us?</label>
              <select class="select-box form-control select-option" name="source">
                <option value="">Please Select</option>
                <option value="Internet">Internet</option>
                <option value="Friends">Friends</option>
                <option value="email">Mail</option>
                <option value="ads">Ads</option>
              </select>
              @if($errors->has('source'))
                <em class="invalid-feedback">
                    {{ $errors->first('source') }}
                </em>
              @endif
            </div>
            <div class="col-sm-4 form-group">
                  <input type="hidden" class="bank-charges"    value="{{$bank_charges}}">
                  <input type="hidden" class="partial-payment" value="{{$partial_payment}}">
                  <input type="hidden" class="remaining-payment" value="{{$remaining_payment}}">
              <label>Have you joined activity with us?</label>
              <select class="select-box form-control select-option" name="travelexperiance" tabindex="-1" aria-hidden="true">
                <option value="">Please Select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              @if($errors->has('travelexperiance'))
                <em class="invalid-feedback">
                    {{ $errors->first('travelexperiance') }}
                </em>
              @endif
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="payment-inner col-sm-12 custom_payment5">
          <h4>Payment Details</h4>
          <div class="row col-md-12 custom_activty6">
            <div class="col-sm-4 form-group">
              <label>Activity Name: </label>
              <input type="hidden" name="activity_id" value="{{$itinerary->id}}">
              <input type="text" class="form-control" value="{{$itinerary->title}}" readonly="">
            </div>
            <div class="col-sm-4  form-group">
              <label>Payment Option<span>*</span></label>
              <select class="select-box payment_method form-control selectpicker select-option" name="payment_percentage" autocomplete="off">
                <option value="">Please Select</option>
                <option value="full_payment">Full Payment</option>
                <option value="partial">{{isset($partial_payment) ? $partial_payment  : 20}}%</option>
              </select>
              @if($errors->has('payment_percentage'))
                <em class="invalid-feedback">
                    {{ $errors->first('payment_percentage') }}
                </em>
              @endif
            </div>
            <div class="col-sm-4  form-group text-center custom_free8">
              <label>Ammount  (persons x activity-fee) </label>
              <input type="hidden" name="currency_id" value="{{ $itinerary->converted_currency_id }}">
              <input type="hidden" name="activity_price" value="{{$itinerary->converted_price}}">
              <p class="fee-div"><strong class="participant-number">1</strong> X <strong class="activity-price">{{$itinerary->converted_price}}</strong> = <strong> {{$itinerary->currency_symbol}}</strong> <strong class="price-total">{{$itinerary->converted_price}}</strong></p>
              <p>
                <strong class="bank_charges">Including {{isset($bank_charges) ? $bank_charges : 3.07}} % Bank Charges</strong> 
                <strong> {{$itinerary->currency_symbol}}</strong>
                <strong class="amount-including-tax">{{ round( ($itinerary->converted_price/100) * isset($bank_charges) ? $bank_charges : 3.07 ,2) }}</strong>
              </p>
              <p><strong>Total Ammount</strong> 
                <strong> {{$itinerary->currency_symbol}}</strong>
                <strong class="total_incl_tax"> {{ round($itinerary->converted_price +  ($itinerary->converted_price/100)*3.07 ,2) }}  </strong>
              </p>
              <div class="custom_book4"> <button type="submit" name="submit" id="sendcontact" class="btn btn-lg btn-booking pull-right">Book Now</button></div>
            </div>
            <div class="col-sm-12 m-b-20">
              <div class="col-sm-12 p-l-0 p-r-0 m-b-10">
                <div class="checkbox-step custom_chek7 m-t-10">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="agree" class="termsconditions" value="0" aria-required="true"> &nbsp;I have read and accept the  <a class="booking-terms" href="{{route('termsConditions')}}" target="_blank">Terms &amp; Conditions</a></label>
                    @if($errors->has('agree'))
                      <em class="invalid-feedback">
                       {{ $errors->first('agree') }}
                      </em>
                    @endif                
                </div>
              </div>
             
              <div class="clear"></div>
            </div>
          </div>
          
          <div class="clear"></div>
        </div>
        <div class="col-sm-12">
          
          <div class="clear"></div>
        </div>
      </form>
      <div class="clear"></div>
    </div>
  </div>
</div>  

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="loader" style="display:none;"><img src="/images/demo_wait.gif"></div>
<script>
$(document).ready(function(){
    $('#country').change(function(){
    $('.loader').show();
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+countryID,
           success:function(res){   
            $('.loader').hide();            
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
    }      
   });
});


</script>   
@endsection