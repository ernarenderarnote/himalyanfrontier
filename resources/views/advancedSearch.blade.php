@extends('layouts.frontend')
@section('content')
<section class="single_product7 advanced-search-page">
	@if(isset($_GET['activity']) && $_GET['activity'] != '') 
    @php $activity = $activities->where('slug',$_GET['activity'])->first(); @endphp
    @if(isset($activity->thumbnails) || isset($activity->gallery_img) )
        <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
            <!-- Wrapper for slides -->
            <div class='carousel-inner'>
				<div class="banner-activity-name">{{$activity->title}}</div>
                <div class='carousel-item active'>
                    @if($activity->thumbnails)
                        <img src="{{ url('/storage/images/activity/featureImages/'.$activity->thumbnails) }}" alt='' />
					@endif
                </div>
                @if($activity->gallery_img)
                    @forelse(json_decode($activity->gallery_img) as $key=>$gallery)
                        
                        <div class='carousel-item'>
							<img src="{{ url('/storage/images/activity/galleryImages/'.$gallery) }}" >
							
						</div>
                        @empty

                    @endforelse
                @endif
                <!-- Controls -->
                <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                    <span class='fa fa-arrow-circle-left'></span>
                </a>
                <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                    <span class='fa fa-arrow-circle-right'></span>
                </a>
                
            </div>
            <div class="container">
            <div class="col-md-12 activity-description custom_actity">
                {!! $activity->description ?? '' !!}
            </div>
            </div>
        </div>
        @endif
    @endif
    <br/>
	<div class="container custom_flex">
		<div class="row">
			<div class="col-md-3 col-sm-12 left_side_bar">
				<div class="left_side">
					<form method="get" class="advanced_serch_form" action="{{route('advanced-search')}}">
						<h3>Find your Adventure</h3>
						<h5>Find your dream adventure</h5>
						@php  
							$s = '';
							$get_destination = ''; 
							$get_activity = '';
							$get_itinerary = '';
							$get_rating_from = '1';
							$get_rating_to = '4';
							$get_date = '';
						@endphp
						@if(isset($_GET) && !empty($_GET))
							@if(isset($_GET['s']))
								@php $s= $_GET['s']; @endphp
							@endif
							@if(isset($_GET['destination']))
								@php $get_destination = $_GET['destination']; @endphp
							@endif
							@if(isset($_GET['activity']))
								@php $get_activity = $_GET['activity']; @endphp
							@endif
							@if(isset($_GET['itinerary_type']))
								@php $get_itinerary = $_GET['itinerary_type']; @endphp
							@endif
							@if(isset($_GET['rating_from']))
								@php $get_rating_from = $_GET['rating_from']; @endphp
							@endif
							@if(isset($_GET['rating_to']))
								@php $get_rating_to = $_GET['rating_to']; @endphp
							@endif
							@if(isset($_GET['date']))
								@php $get_date = $_GET['date']; @endphp
							@endif
						@endif
						<ul class="custom_ul">
							<li class="search5"> <input type="text" name="s" value="{{$s}}" placeholder="Keyword Search.."></li>
							<h4 class="destinal">Destination <i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
							<ul class="radei" style="{{ $get_destination !='' ? '' : 'display:none'}}">
								@forelse($destinations as $destination)
									<li><input type="radio" name="destination" value="{{$destination->slug}}" {{ $destination->slug == $get_destination ? 'checked' : '' }} >{{$destination->title}}</li>
									@empty
								@endforelse
							</ul>
							<h4 class="destinal">Activity <i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
							<ul class="radei actavate" style="{{ $get_activity !='' ? '' : 'display:none'}}">
								@forelse($activities as $activity)
									<li><input type="radio" name="activity" value="{{$activity->slug}}" {{ $activity->slug == $get_activity ? 'checked' : '' }}>{{$activity->title}}</li>
									@empty
								@endforelse
							</ul>
							<!-- <li class="hot_deal"><input type="radio" name="itinerary_type"  value="hot_deal" {{ $get_itinerary == 'hot_deal' ? 'checked' : '' }}>Hot Deal</li> -->
							<li class="fixed"><input type="radio" name="itinerary_type"  value="fixed_departure" {{ $get_itinerary == 'fixed_departure' ? 'checked' : '' }}>Fixed Departure</li>
							<h4 class="date4 destinal">Date</h4>
							<ul class="radei date-li" style="{{ $get_date !='' ? '' : 'display:none'}}">
								<li><input type="radio" name="date"  value="01" {{ $get_date == '01' ? 'checked' : '' }}>Jan</li>
								<li><input type="radio" name="date"  value="02" {{ $get_date == '02' ? 'checked' : '' }}>Feb</li>
								<li><input type="radio" name="date"  value="03" {{ $get_date == '03' ? 'checked' : '' }}>Mar</li>
								<li><input type="radio" name="date"  value="04" {{ $get_date == '04' ? 'checked' : '' }}>Apr</li>
								<li><input type="radio" name="date"  value="05" {{ $get_date == '05' ? 'checked' : '' }}>May</li>
								<li><input type="radio" name="date"  value="06" {{ $get_date == '06' ? 'checked' : '' }}>Jun</li>
								<li><input type="radio" name="date"  value="07" {{ $get_date == '07' ? 'checked' : '' }}>Jul</li>
								<li><input type="radio" name="date"  value="08" {{ $get_date == '08' ? 'checked' : '' }}>Aug</li>
								<li><input type="radio" name="date"  value="09" {{ $get_date == '09' ? 'checked' : '' }}>Sep</li>
								<li><input type="radio" name="date"  value="10" {{ $get_date == '10' ? 'checked' : '' }}>Oct</li>
								<li><input type="radio" name="date"  value="11" {{ $get_date == '11' ? 'checked' : '' }}>Nov</li>
								<li><input type="radio" name="date"  value="12" {{ $get_date == '12' ? 'checked' : '' }}>Dec</li>
							</ul>
							<h4 class="date4">Grading</h4>
						</ul>
						<div class="slidecontainer">
							<input type="hidden" name="rating_from" id="rating-from" value="{{ $get_rating_from != '' ? $get_rating_from : '1' }}">
							<input type="hidden" name="rating_to" id="rating-to" value="{{ $get_rating_to != '' ? $get_rating_to : '1' }}">
							<label id="rating-label">{{$get_rating_from}} - {{$get_rating_to}}</label>
							<div id="slider-range"></div>
						</div>
				    </form>
				</div>
			</div>
         
			<div class="col-md-9 col-sm-12 sidebar-right">
				@if($get_activity)
				  
				@endif
				<!-- navigation holder -->
	  
				<!-- Page oriented legend -->
				<div class="right_side">
					<div id="">
						@forelse($itineraries as $itinerary)
							<div class="row margin_bottom1">
								<div class="col-md-5 col-sm-5">
									<div class="img_outer">
										<img src="{{ url('/storage/images/itinerary/featureImages/'.$itinerary->feature_img) }}">
									</div>
								</div>
								<div class="col-md-5 col-sm-5">
									<div class="heading_outer">
										<a href="{{ route('activity.slug', ['slug'=>$itinerary->slug]) }}">
										<h3>{{$itinerary->title}}</h3>
										</a>
										<ul>
											{!! $itinerary->activity_points !!}
										</ul>
										
									</div>
								</div>
								<div class="col-md-2 col-sm-2 no_padding4">
									<div class="rating_outer">
										<div class="star">
											<p>
												@if(isset($itinerary->rating))
													@for($i=1; $i<5; $i++)
														@if ($i <= $itinerary->rating )
															<span class="fa fa-star checked"></span>
														@else
															<span class="fa fa-star"></span>
														@endif
													@endfor       
													
													<p>
														@if($itinerary->rating == 1)
															Easy
														@elseif($itinerary->rating ==2 )
															Moderate
														@elseif($itinerary->rating == 3)
															Streneous
														@else
															Difficult
														@endif
													</p>
												@endif
											</p>
										</div>
										
										<div class="book_now">
											@if($itinerary->converted_price)
												<h4><span class="">{{$itinerary->currency_symbol}} {{ number_format($itinerary->converted_price,2) }}</span><br/><small>Per Person</small></h4>
												<div class="btn_ouer">
													<form action="{{route('booking')}}" method="POST">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">	
														<input type="hidden" name="activity_id" value="{{$itinerary->id}}">	
														<button class="btn" type="submit">BOOK NOW</button>	
													</form>	
												</div>
											@else
												<div class="btn_ouer">
													<button class="btn contact-price" data-entry-id="{{$itinerary->id}}" type="button">Contact for Price</button>
												</div>
											@endif	
										</div>
										<div class="btn_ouer read">
										<a href="{{ route('activity.slug', ['slug'=>$itinerary->slug]) }}">Read More</a>
										</div>
									</div>
								</div>
							</div>
							@empty
								No result found
						@endforelse
					</div>    
				</div>
				<!-- navigation holder -->
				{{ $itineraries->links() }}    
			</div>
		</div>
	</div>
<!-- Modal -->
<div class="modal fade" id="contact-price-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact For Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <form class="itinerary-price-form" action="{{route('priceRequest')}}" method="post">
			@csrf
			<input type="text" id="fname" name="name" placeholder="Your name..">
			@if($errors->has('name'))
				<em class="invalid-feedback">
					{{ $errors->first('name') }}
				</em>
			@endif
			<input type="text" name="email" placeholder="email" >
			@if($errors->has('email'))
				<em class="invalid-feedback">
					{{ $errors->first('email') }}
				</em>
			@endif
			<input type="tel" name="phone" placeholder="phone" >
			@if($errors->has('phone'))
				<em class="invalid-feedback">
					{{ $errors->first('phone') }}
				</em>
			@endif
			<input type="text" name="subject" placeholder="subject" >
			@if($errors->has('subject'))
				<em class="invalid-feedback">
					{{ $errors->first('subject') }}
				</em>
			@endif
			<input type="hidden" name="itinerary_id" value="">
			<textarea id="desc" name="message" placeholder="Description.." style="height:100px"></textarea>
			@if($errors->has('description'))
				<em class="invalid-feedback">
					{{ $errors->first('description') }}
				</em>
			@endif
			<input type="submit" value="Submit" class="btn">
		</form>
      </div>
    </div>
  </div>
</div>
<div class="loader" style="display:none; z-index:9999999999;"><img src="/images/demo_wait.gif"></div>
</section>

<script>
    $( function() {
    var rating_from = '{{$get_rating_from}}';
    var rating_to   = '{{$get_rating_to}}';
    $( "#slider-range" ).slider({
      range: true,
      min: 1,
      max: 4,
      values: [ rating_from, rating_to ],
      slide: function( event, ui ) {
        $( "#rating-from" ).val( ui.values[ 0 ]);
        $( "#rating-to" ).val( ui.values[ 1 ]);
        $( "#rating-label" ).html( ui.values[ 0 ] +'-'+ ui.values[ 1 ] );
        $('.advanced_serch_form').submit();
      }
    });
   
  } );
  
$(document).ready(function () {
	$(".contact-price").click(function(e){
		jQuery.noConflict();
		var itinerary_id = $(this).attr('data-entry-id');
		$('input[name="itinerary_id"]').val(itinerary_id);
		$('#contact-price-modal').modal('show');
		e.preventDefault();
	});

	jQuery('.itinerary-price-form').submit(function(e){
		e.preventDefault();  
		//jQuery.noConflict();
		var form = jQuery(this);
		var data = form.serialize();
		var action = form.attr('action');
		var method = form.attr('method');
		//form validation 
		jQuery('.itinerary-price-form').validate({
			ignore: "",
			rules:{
				name: {
					required : true,
				},
				email: {
					required : true,
					email: true
				},
				phone: {
					required : true,
					number :true,
				},
				subject:{
					required : true,
				},
				message : {
					required : true,
				}
			},
			messages: {
				name : {
					required : 'Please enter your name.',
				},
				email : {
					required : 'Please enter your email',
					email : 'Email must be a valid email.'
				},
				phone : {
					required : 'Please enter your mobile number',
					number   : 'Please enter a valid number.'
				},
				subject : {
					required : 'Please enter a subject.',
				},
				message : {
					required : 'Please enter your message.',
				}
			},
		
		});
		
		/*check if form is valid or not*/
		if (form.valid() === true){
			jQuery('.loader').show();
			jQuery.ajax({
				url: action,
				cache: false,
				data:data,
				type:'POST',
				success: function(result) {
					jQuery('.loader').hide();
					jQuery('#contact-price-modal form')[0].reset();
					if(result.status == 'success'){
						toastr.success(result.message);
					}else{
						toastr.error("Something went wrong.");
					}
					$("#contact-price-modal").modal("hide");
				}
			});
		} 
		
	});
});		
</script>

@endsection