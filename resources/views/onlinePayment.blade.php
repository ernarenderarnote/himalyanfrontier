@extends('layouts.frontend')
@section('content')
	<section class="about_us">

		<div class="container">
			<div class="about_outer terms">
				<h3 class="read456">HimalayanFrontiers.com Secure Payment</h3>
				<div class="col-md-12">
					<form id="payment-direct" method="post" action="{{ route('directPayment') }}" >
						@csrf
						<div class="panel panel-info">
							
							
								
							<div class="panel-body">
								
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6 form-group">
											<label>First Name<span>*</span></label>
											<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" />
											@if($errors->has('first_name'))
												<em class="invalid-feedback">
													{{ $errors->first('first_name') }}
												</em>
											@endif
										</div>
										<div class="col-md-6 form-group">
											<label>Last Name<span>*</span></label>
											<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" />
											@if($errors->has('last_name'))
												<em class="invalid-feedback">
													{{ $errors->first('last_name') }}
												</em>
											@endif
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-md-4 form-group">
											<label>Country<span>*</span></label>
											<select id="country" name="country_id" class="form-control" value="{{ old('category_id') }}">
												<option value="" selected disabled>Select</option>
												@foreach($countries as $key => $country)
												<option value="{{$key}}"> {{$country}}</option>
												@endforeach
											</select>
											@if($errors->has('country_id'))
												<em class="invalid-feedback">
													{{ $errors->first('country_id') }}
												</em>
											@endif
										</div>
										<div class="col-md-4 form-group">
											<label>State<span>*</span></label>
											<div class="col-md-12">
												<select name="state" id="state" class="form-control">
												</select>
											</div>
											@if($errors->has('state'))
												<em class="invalid-feedback">
													{{ $errors->first('state') }}
												</em>
											@endif
										</div>
										<div class="col-md-4 form-group">
											<label>City<span>*</span></label>
											<div class="col-md-12">
												<input type="text" name="city" class="form-control" value="{{ old('city') }}" />
											</div>
											@if($errors->has('city'))
												<em class="invalid-feedback">
													{{ $errors->first('city') }}
												</em>
											@endif
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-4 form-group">
											<label>Email Address<span>*</span></label>
											<div class="col-md-12"><input type="text" name="email_address" class="form-control" value="{{ old('email_address') }}" /></div>
											@if($errors->has('email_address'))
												<em class="invalid-feedback">
													{{ $errors->first('email_address') }}
												</em>
											@endif
										</div>
										<div class="col-md-4 form-group">
											<label>Zip / Postal Code<span>*</span></label>
											
											<div class="col-md-12">
												<input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}" />
												@if($errors->has('email_address'))
													<em class="invalid-feedback">
														{{ $errors->first('zip_code') }}
													</em>
												@endif
											</div>
										</div>
										<div class="col-md-4 form-group">
											<label>Phone Number<span>*</span></label>
											
											<div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" /></div>
											@if($errors->has('phone_number'))
												<em class="invalid-feedback">
													{{ $errors->first('phone_number') }}
												</em>
											@endif
										</div>
									</div>
									
									<div class="form-group">
										<label>Address<span>*</span></label>
										<div class="col-md-12">
											<textarea type="text" name="address" rows="4" class="form-control" value="{{ old('address') }}"></textarea>
											@if($errors->has('address'))
												<em class="invalid-feedback">
													{{ $errors->first('address') }}
												</em>
											@endif
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-4 form-group">
											<label>Currency<span>*</span></label>
											<select id="currency" name="currency" class="form-control" value="{{ old('currency') }}">
												<option value="" selected disabled>Select</option>
												@foreach($currencies as $key => $currency)
												<option value="{{$key}}"> {{$currency}}</option>
												@endforeach
											</select>
											@if($errors->has('currency'))
												<em class="invalid-feedback">
													{{ $errors->first('currency') }}
												</em>
											@endif
										</div>
										<div class="col-md-4 form-group">
											<label>Ammount<span>*</span></label>
											<div class="col-md-12">
												<input type="text" name="amount" value="{{ old('ammount') }}" class="form-control">
											</div>
											@if($errors->has('amount'))
												<em class="invalid-feedback">
													{{ $errors->first('amount') }}
												</em>
											@endif
										</div>

										
									</div>
									
									<div class="row col-md-3">
										<input type="submit" value="Make Payment" class="btn btn-warning">
									</div>
								</div>
								
								
							</div>
							
						</div>	
						
					</form>
					
				</div>
				
			</div>
			
		</div>
	
	</section>
	
<script>
$(document).ready(function(){
    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+countryID,
           success:function(res){               
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