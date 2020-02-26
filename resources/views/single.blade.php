@extends('layouts.frontend')
@section('content')
<div class="single-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="background:#f0f0f0; padding-top:15px; padding-bottom:15px;">
                <div class="entry-title1 custom-heading1">{{$activity->title}}
                    <span class="custom_heading_sub">{{$activity->subtitle}}</span>
                </div>
                @if($activity->feature_img !='' || $activity->gallery_img != '')
                <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
					<!-- Wrapper for slides -->
					<div class='carousel-inner'>
						<div class='carousel-item active'>
							@if($activity->feature_img)
								<img src="{{ url('/storage/images/itinerary/featureImages/'.$activity->feature_img) }}" alt='' />
							@endif
						</div>
						@if($activity->gallery_img)
							@forelse(json_decode($activity->gallery_img) as $key=>$gallery)
								
								<div class='carousel-item'>
									<img src="{{ url('/storage/images/itinerary/galleryImages/'.$gallery) }}" >
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
                    
					<!-- Indicators -->
					@if($activity->gallery_img)
						<ol class='carousel-indicators'>
							<li data-target='#carousel-custom' data-slide-to='0' class="active" ><img src="{{ url('/storage/images/itinerary/featureImages/'.$activity->feature_img) }}" alt='' height="50" width="100"/></li>
							@forelse(json_decode($activity->gallery_img) as $key=>$gallery)
								<li data-target='#carousel-custom' data-slide-to='{{($key +1)}}' ><img src="{{ url('/storage/images/itinerary/galleryImages/'.$gallery) }}" height="50" width="100"></li>
								@empty

							@endforelse
						</ol>
					@endif
                </div>
				@endif
				<div class="adit-low">
				   {!! $activity->description !!}
				</div>
				<!-- Nav tabs -->
				<div class="itinerary-tab-container bg-white">
					<ul class="nav tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#quickLook">Quick Look</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#detailedItinerary">Detailed Itinerary</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#cost">Cost</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#map">Map</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#generalInfo">General Information</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div id="quickLook" class="container tab-pane active"><br>
						    {!! $activity->quick_look !!}
						</div>
						<div id="detailedItinerary" class="container tab-pane fade"><br>
                            {!! $activity->detailed_itinerary !!}
						</div>
						<div id="cost" class="container tab-pane fade"><br>
                            {!! $activity->costs !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cost-section">
                                        <h4>COST INCLUDE</h4>
                                        {!! $activity->front_costs_included !!}
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="cost-section">
                                        <h4>COST EXCLUDE</h4>
                                        {!! $activity->front_costs_excluded !!}
                                    </div>
                                </div>
                            </div>
						</div>
						<div id="map" class="container tab-pane fade"><br>
                            <div class="map-img">
                                @if(isset($activity->map) )
                                    <img id="MapID" class="map-thumbnail" src="{{ url('/storage/images/itinerary/maps/'.$activity->map) }}" alt="Image"><br>
                                @else
                                    <img id="MapID" class="map-thumbnail" src="{{url('images/placeholder.png')}}" alt="Image"><br>
                                @endif
                                
                            </div>
						</div>
						<div id="generalInfo" class="container tab-pane fade"><br>
							<div class="panel-group" id="accordion">
                                @if(isset($activity->general_information) && $activity->general_information !='' )
                                    @foreach(json_decode($activity->general_information) as $key=>$general_info )
                                        <div class="panel panel-default template">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#accordian{{$key}}">
                                                        {{$general_info->title}}
                                                    </a>
                                                </h4>
                                            
                                            </div>
                                            <div id="accordian{{$key}}" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    {{$general_info->description}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
								@endif
							</div>	
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-4">
				<div class="trak-v">
				   <h4>{{$activity->title}}<i class="fa fa-star" aria-hidden="true"></i></h4>
                   <i class="fa fa-map-marker" aria-hidden="true"></i> 
                    @forelse($activity->destinations as $itineraryDestination)
                        <span>{{$itineraryDestination->title}}</span>
                        @empty

                    @endforelse  
                   
                    <ul class="itinerary-points">
                        {!! $activity->front_activity_points !!}
                    </ul>   
				</div>
				<div class="grand-more">
				    <div class="trak">
					   <h4>Highlights</h4>
				    </div>
				    <div class="grand-ore">
						<ul class="itinerary-points">
						    {!! $activity->front_activity_highlights !!}
						</ul>
				    </div>
				</div>
				<br>				
				<div class="grand-more tens">
					<div class="trak">
					   <h4>Available Dates</h4>
				    </div>
					<div id="accordion" class="itinerary-collaspe">
						<div class="card">
							@php
								$format      = 'Y-m-d'; 
								$date_months = array();  
							@endphp
							@forelse($activity->schedule as $schedule)
								@php $date_months[] = \Carbon\Carbon::parse($schedule->from_date)->format('M'); @endphp
							
							@empty
							@endforelse
							@foreach(array_unique($date_months) as $month) 
						
								<div class="card-header" id="heading{{$month}}">
								<h5 class="mb-0">
									<button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$month}}" aria-expanded="true" aria-controls="collapse{{$month}}">
										{{$month}}
									</button>
								</h5>
								</div>
								<div id="collapse{{$month}}" class="collapse" aria-labelledby="heading{{$month}}" data-parent="#accordion">
									<div class="card-body">
										<ul>
											@foreach($activity->schedule as $schedule)
												@php $date_month = \Carbon\Carbon::parse($schedule->from_date)->format('M'); @endphp
												@if($date_month == $month)
													@if($schedule->from_date >= date('Y-m-d'))
														<li>
															<form method="POST" action="{{route('booking')}}">
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
																<input type="hidden" name="activity_id" value="{{$activity->id}}">
																<input type="hidden" name="schedule_id" value="{{$schedule->id}}">		
																<a href="" class="booking-schedule" >
																	{{\Carbon\Carbon::parse($schedule->from_date)->format('M d')}} to {{\Carbon\Carbon::parse($schedule->to_date)->format('M d Y')}}
																</a>
															</form>	
														</li>
													@else
														<li>	
															<a href="" class="booking-schedule disabled" onclick="return false;">
																{{\Carbon\Carbon::parse($schedule->from_date)->format('M d')}} to {{\Carbon\Carbon::parse($schedule->to_date)->format('M d Y')}}
															</a>	
														</li>
													@endif	
												@endif
											@endforeach
										</u>	
									</div>
								</div>
								
							@endforeach
						</div>
					</div>
				   
					<div class="nos">					  
						<div class="tk">							
							<div class="Date-msain">	
								<div class="perm">	
									<p class="pull-left">Per Person</p>
									<p class="pull-right">{{$activity->currency_symbol}} {{ $activity->converted_price }}</p>
								</div>		
							</div>		
							<div class="Date-msain">
								<div class="per">
									<form action="{{route('booking')}}" method="POST">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">	
										<input type="hidden" name="activity_id" value="{{$activity->id}}">	
										<button type="submit">BOOK NOW</button>	
									</form>	
								</div>					
							</div>				
						</div>				
					</div>		
				</div>
				<div class="grand-more">
					<div class="nos">
						<div class="trak-k">
							<h4>CURRENCY SWITTCHER</h4>
						</div>
					</div>
					<div class="custom-select nullo">
						<form action="{{ route('currencySwitcher') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<select class="currency-switcher" name="currency">
								@forelse($currencies as $currency)
									@if(Session::has('selected_currency'))
										<option value="{{$currency->code}}" {{ session()->get('selected_currency') == $currency->code ? 'selected' : '' }}>{{ $currency->code }} {{$currency->symbol}}</option>
									@else
										<option value="{{$currency->code}}" {{ $defaultCurrency->code == $currency->code ? 'selected' : '' }}>{{ $currency->code }} {{$currency->symbol}}</option>
									@endif
									
									@empty

								@endforelse	
							</select>
						</form>
					</div>
				</div>
				<br>
				
				<div class="grand-more">
				   <div class="nos">
						<div class="trak-k">
							<h4>SEND INQUIRY</h4>
						
						<form action="{{route('sendinquery')}}" method="post">
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
							<input type="hidden" name="itinerary_id" value="{{$activity->id}}">
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
				<br>
				<div class="grand-more">
					<div class="nos">
						<div class="trak-k">
							 <h4>SIMILAR TOURS</h4>
						</div>
                    </div>
                    @forelse($similar_tours as $similar_tour)
                        <div class="tim">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="sub">
                                        <img width="64" height="64" src="{{ url('/storage/images/itinerary/featureImages/'.$similar_tour->feature_img) }}" alt='' />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="sub">
                                        <h3>{{$similar_tour->title}}</h3>
                                        <div class="read-more custom_read">
                                            <a class="button btn-small full-width text-center" href="{{ route('activity.slug', ['slug'=>$similar_tour->slug]) }}">Read more</a>
                                        </div>
                                    </div>
                            </div>
                            
                            </div>
                        </div>
                        <br>
                        @empty
                    @endforelse        
				</div>
			</div>
		</div>
	</div>
</div>

@endsection