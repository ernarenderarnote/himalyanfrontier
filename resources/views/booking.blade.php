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
              <select class="select-box form-control select-option" name="schedule_id" id="schedule_id">
                <option value="">Select Activity Date</option>
                @forelse($itinerary->schedule as $schedule)
                  <option value="{{$schedule->id}}">{{\Carbon\Carbon::parse($schedule->from_date)->format('M d')}} to {{\Carbon\Carbon::parse($schedule->to_date)->format('M d Y')}}</option>
                @empty
                <option>No Dates Available</option>
                @endforelse
              </select>
            </div>
          </div>
        </div>
        <div class="payment-inner col-sm-12">
          <h4>Personal Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-3 form-group">
              <label>Full Name<span>*</span></label>
              <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ $user->full_name ?? '' }}">
            </div>
            <div class="col-sm-3 form-group">
              <label>Email<span>*</span></label>
              <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $user->email ?? '' }}">
            </div>
            <div class="col-sm-3 form-group">
              <label>Mobile<span>*</span></label>
              <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" value="{{ $user->phone ?? '' }}">
            </div>
            <div class="col-sm-3 form-group">
              <label>Age<span>*</span></label>
              <input type="text" class="form-control" name="age" placeholder="Age" value="{{ $user->profile->age ?? '' }}">
            </div>
          </div>
          <div class="clear"></div>
          <div class="row col-md-12">
            <div class="col-sm-3 form-group">
              <label>Gender<span>*</span></label>
              <select class="select-box form-control" id="gender" name="gender"  tabindex="-1" aria-hidden="true">
                <option value="">Select Gender</option>
                <option value="male"   {{ isset($user->profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ isset($user->profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
            <div class="col-sm-2 form-group">
              <label>Height<span>*</span></label>
              <input type="text" class="form-control" name="height" placeholder="Height" value="{{ $user->profile->height ?? '' }}">
            </div>
            <div class="col-sm-2 form-group">
              <label>Weight<span>*</span></label>
              <input type="text" class="form-control" name="weight" placeholder="Weight" value="{{ $user->profile->weight ?? '' }}">
            </div>
          </div>
          
          <div class="clear"></div>
        </div>
        <div class="payment-inner col-sm-12">
          <h4>Address Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-3 form-group">
              <label>Address<span>*</span></label>
              <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $user->profile->address ?? '' }}">
            </div>
            <div class="col-sm-3 form-group">
              <label>State<span>*</span></label>
              <input type="text" class="form-control" name="state" placeholder="State" >
            </div>
            <div class="col-sm-3 form-group">
              <label>City<span>*</span></label>
              <input type="text" class="form-control" name="city" placeholder="City">
            </div>
            <div class="col-sm-3 form-group">
              <label>Pin Code<span>*</span></label>
              <input type="text" class="form-control" name="pin_code" placeholder="Pin Code">
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="payment-inner col-sm-12 p-l-0 p-r-0">
          <h4>Other Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-3 form-group">
              <label>How did you find about us?<span>*</span></label>
              <select class="select-box form-control select-option" name="source">
                <option value="">Please Select</option>
                <option value="Internet">Internet</option>
                <option value="Friends">Friends</option>
                <option value="email">Mail</option>
                <option value="ads">Ads</option>
              </select>
            </div>
            <div class="col-sm-3 form-group">
              <label>Have you joined activity with us?<span>*</span></label>
              <select class="select-box form-control select-option" name="travelexperiance" tabindex="-1" aria-hidden="true">
                <option value="">Please Select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="payment-inner col-sm-12">
          <h4>Payment Details</h4>
          <div class="row col-md-12">
            <div class="col-sm-4 form-group">
              <label>Activity Name: </label>
              <input type="hidden" name="activity_id" value="{{$itinerary->id}}">
              <input type="text" class="form-control" value="{{$itinerary->title}}" readonly="">
            </div>
            <div class="col-sm-4  form-group">
              <label>No. Of Participants: </label>
              <input type="number" name="no_of_participants" class="form-control" value="1" min="1" max="100">
            </div>
            <div class="col-sm-4  form-group text-center">
              <label>Amount  (persons x activity-fee) </label>
              <input type="hidden" name="currency_id" value="{{$itinerary->converted_currency_id}}">
              <input type="hidden" name="activity_price" value="{{$itinerary->converted_price}}">
              <p class="fee-div">1 X {{$itinerary->converted_price}} = <strong> {{$itinerary->currency_symbol}} {{$itinerary->converted_price}}</strong></p>
            </div>
            <div class="col-sm-12 m-b-20">
              <div class="col-sm-12 p-l-0 p-r-0 m-b-10">
                <div class="checkbox-step m-t-10">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="agree" class="termsconditions" value="0" aria-required="true"> &nbsp;I have read and accept the  <a class="booking-terms" href="https://www.ridingsolo.in/terms/details/1" target="_blank">Terms &amp; Conditions</a></label>
                </div>
              </div>
              <button type="submit" name="submit" id="sendcontact" class="btn btn-lg btn-booking pull-right">Book Now</button>
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
@endsection