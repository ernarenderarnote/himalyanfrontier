@extends('layouts.frontend')
@section('content')
<div class="single-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="background:#f0f0f0; padding-top:15px; padding-bottom:15px;">
                <div class="entry-title1 custom-heading1">{{$activity->title}}
                    <span class="custom_heading_sub">{{$activity->subtitle}}</span>
                </div>
                
                <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
					<!-- Wrapper for slides -->
					<div class='carousel-inner'>
						<div class='carousel-item active'>
							<img src="{{ url('/storage/images/itinerary/featureImages/'.$activity->feature_img) }}" alt='' />
						</div>
						@forelse(json_decode($activity->gallery_img) as $key=>$gallery)
							
							<div class='carousel-item'>
								<img src="{{ url('/storage/images/itinerary/galleryImages/'.$gallery) }}" >
							</div>
							@empty

						@endforelse
						<!-- Controls -->
						<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
							<span class='glyphicon glyphicon-chevron-left'></span>
						</a>
						<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
							<span class='glyphicon glyphicon-chevron-right'></span>
						</a>
						
					</div>
                    
                    <!-- Indicators -->
                    <ol class='carousel-indicators'>
                        <li data-target='#carousel-custom' data-slide-to='0' class="active" ><img src="{{ url('/storage/images/itinerary/featureImages/'.$activity->feature_img) }}" alt='' height="50" width="100"/></li>
                        @forelse(json_decode($activity->gallery_img) as $key=>$gallery)
                            <li data-target='#carousel-custom' data-slide-to='{{($key +1)}}' ><img src="{{ url('/storage/images/itinerary/galleryImages/'.$gallery) }}" height="50" width="100"></li>
                            @empty

                        @endforelse
                    </ol>
                </div>
			
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
                                        {!! $activity->cost_include !!}
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="cost-section">
                                        <h4>COST EXCLUDE</h4>
                                        {!! $activity->cost_exclude !!}
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
							{!! $activity->general_information !!}
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
                       {!! $activity->activity_points !!}
                    </ul>   
				</div>
				<div class="grand-more">
				    <div class="trak">
					   <h4>Highlights</h4>
				    </div>
				    <div class="grand-ore">
						<ul class="itinerary-points">
                            {!! $activity->highlights !!}									                               
						</ul>
				    </div>
				</div>
				<br>				
				<div class="grand-more tens">				   
					<div class="nos">					  
						<div class="tk">							
							<div class="Date-msain">	
								<div class="perm">	
									<p class="pull-left">Per Person</p>
									<p class="pull-right">$ 1,298.40</p>
								</div>		
							</div>		
							<div class="Date-msain">
								<div class="per">		
									<button>BOOK NOW</button>	
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
						<select>
							<option value="0">EUR,C</option>
							<option value="1">Audi</option>
							<option value="2">BMW</option>
							<option value="3">Citroen</option>
							<option value="4">Ford</option>
							<option value="5">Honda</option>
							<option value="6">Jaguar</option>
							<option value="7">Land Rover</option>
							<option value="8">Mercedes</option>
							<option value="9">Mini</option>
							<option value="10">Nissan</option>
							<option value="11">Toyota</option>
							<option value="12">Volvo</option>
						</select>
					</div>
				</div>
				<br>
				<!--div class="grand-more">
					<div class="tect">
						<h4>Deprature Dates</h4>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
				</div>
				<BR-->
				<div class="grand-more">
				   <div class="nos">
						<div class="trak-k">
							<h4>SEND INQUIRY</h4>
						</div>
						<form action="/action_page.php">
							<input type="text" id="fname" name="firstname" placeholder="Your name..">
							<input type="email" name="emailaddress" placeholder="email" >
							<input type="tel" name="phone" placeholder="phone" >
							<textarea id="subject" name="subject" placeholder="Description.." style="height:100px"></textarea>
							<input type="submit" value="Submit">
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