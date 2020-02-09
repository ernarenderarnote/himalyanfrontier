@extends('layouts.frontend')
@section('content')
<!-- banner slider -->
<div id="homepage-slider" class="st-slider">
	<div class="images">
		<div class="images-inner">
			<div class="image-slide">
				<div id="overlay"></div>
				<div class="banner-w3ls-1"></div>
			</div>
		</div>
	</div>
</div>
<!-- //banner slider -->
<!-- banner bottom grids -->
<section class="banner-bottom-w3layouts" id="services">
    <form method="get" action="{{route('advanced-search')}}">
	    <div class="sb-bar">
			<div class="sb-destinations-section sb-section">
				<select name="destination" class="form-control">
					<option value="">Where do you want to travel?</option>
					@forelse($destinations as $destination)
						<option value="{{$destination->slug}}"> {{ $destination->title }}</option>
					@empty

					@endforelse
				</select>
			</div>
			<div class="sb-period sb-section">
				<select name="date" class="form-control">
					<option value="">All year</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>   
				
			</div>
			<div class="sb-type sb-section">
				<select name="activity" class="form-control">
					<option value="">What kind of Activity?</option>
					@forelse($activities as $activity)
						<option value="{{$activity->slug}}"> {{ $activity->title }}</option>
					@empty

					@endforelse
				</select>
				<input type="hidden" name="rating_from" value="1">	
                <input type="hidden" name="rating_to" value="4">	
			</div>
			<div class="sb-search sb-section">
				<input type="submit" name="search" value="Search">
			</div>
        </div>
    </form>	
</section>
<!-- <div class="selected">
	<div class="container">
		
   </div>
</div> -->
<!-- //banner bottom grids -->
<!-- about -->
<section>
   <div class="section-1">
   <div class="parallax" data-stellar-background-ratio="0.5" style="background-image: url(&quot;https://www.himalayanfrontiers.com/wp-content/uploads/2014/12/grey-bg.png&quot;);">
      <br>
      <div class="section">
         <br>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="content_wrapper homeab" style="padding-right: 20px; text-align: justify;">
                     <h3 class="heading">Why travel with<br>
                        <span class="red_heading">Himalayan Frontiers</span>
                     </h3>
                     <p>Himalayan Frontiers, Culture &amp; Adventure tours (Pvt. Ltd.) has 22 years of experience to operate adventure and culture holidays to the less explored and frequently traveled destinations.</p>
                     <br>
                     <p>We propose a large array of trips keeping in mind to meet needs and interests of each individual and different age groups of travelers.</p>
                     <br> 
                     <br>									
                  </div>
                  <div class="btn">
                     <button>Read More</button>
                  </div>
               </div>
               <br>
				<div class="col-md-8">
					<div class="row">
                        @forelse($itineraries as $itinerary)
                            <div class="col-md-4">
                                <div class="true-image"> 
                                <a href="{{ route('activity.slug', ['slug'=>$itinerary->slug]) }}" data-post_id="1641" class="hover-effect popup-gallery"><img src="{{ url('/storage/images/itinerary/featureImages/'.$itinerary->feature_img) }}"></a>                              
                                </div>
                                
                                <div class="amet">
                                    <div class="left_r45">
                                <h4 class="yoga">{{$itinerary->title}}</h4>
                                @forelse($itinerary->destinations as $itineraryDestination)
                                        <small>{{$itineraryDestination->title}}</small>
                                        @empty

                                @endforelse                                       
                                <div class="feedback">
                                    <div class="five-stars-container" data-toggle="tooltip" title="Difficulty Level"> 
                                    @if(isset($itinerary->rating))
                                    @for($i=1; $i<5; $i++)
                                        @if ($i <= $itinerary->rating )
                                            <span class="fa fa-star checked"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                        @endif
                                    @endfor       
                                        <span class="review effect">Grade</span>
                                    @endif
                                    </div>
                                </div>
                                <ul class="itinerary-points">
                                    {!! $itinerary->front_activity_points !!}
                                </ul>
                                </div>
                                <div class="read-btn">                                    
                                    <a href="{{ route('activity.slug', ['slug'=>$itinerary->slug]) }}">Read More</a>                                 
                                </div>
                                </div>
                            </div>
                            @empty
                        @endforelse      
					</div>
				</div>
            </div>
         </div>
      </div>
      <br>
   </div>
</section>
<!-- //about -->
<div class="deprature bg-secondary">
    <div class="container">
        <h2 class="fixed">Fixed Departure Programs</h2>
        <div class="row">
            @forelse($fixedPrograms as $fixedProgram)
                <div class="col-md-4 mb-5">
                    <div class="programs-again">
                        <div class="true-image">
                            <a href="#" data-post_id="1641" class="hover-effect popup-gallery">
                                <img src="{{ url('/storage/images/itinerary/featureImages/'.$fixedProgram->feature_img) }}">
                            </a>
                        </div>
                        <div class="amet">
                            <div class="left_r45">
                            <h4>{{$fixedProgram->title}}</h4>
                            <ul class="features check">
                                {!! $fixedProgram->activity_points !!}
                            </ul>
                            <div class="feedback">
                                <div class="five-stars-container" data-toggle="tooltip" title="Difficulty Level"> 
                                    @if(isset($fixedProgram->rating))
                                    @for($i=1; $i<5; $i++)
                                        @if ($i <= $fixedProgram->rating )
                                            <span class="fa fa-star checked"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                        @endif
                                    @endfor       
                                        <span class="review effect">Grade</span>
                                    @endif
                                    </div>
                            </div>
                            <div class="read-btn">
                                <a href="{{ route('activity.slug', ['slug'=>$fixedProgram->slug]) }}">Read More</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                
            @endforelse    
		</div>
    </div>
</div>
<div class="travels">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <h3 class="say">What travelers <br>say about</h3>
         </div>
         <div class="col-md-8">
            <p>					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 					ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 					laboris nisi ut aliquip ex ea commodo consequat.					</p>
            <p>					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 					ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 					laboris nisi ut aliquip ex ea commodo consequat.					</p>
            <div class="read-our">							<button>Read More</button>					</div>
            <!--<img src="images/trip.png" class="responsive">-->
         </div>
      </div>
   </div>
</div>
<div class="programs">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="nature" style="padding:30px 0px;">Upcoming Programs</h3>
            <section id="demos">
               <div class="row">
                  <div class="large-12 columns">
                     <div class="owl-carousel owl-theme">
                        <div class="item">
                           <img src="images/armenia-sevanavank-monastery.jpg">
                           <div class="markha">
                              <h4>Lorem Ipsum</h4>
                              <p class="dummy-mail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                              </p>
                              <button class="theme">View More</button>
                           </div>
                        </div>
                        <div class="item">
                           <img src="images/25-1521269446.jpg">
                           <div class="markha">
                              <h4>Lorem Ipsum</h4>
                              <p class="dummy-mail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                              </p>
                              <button class="theme">View More</button>
                           </div>
                        </div>
                        <div class="item">
                           <img src="images/lighthouse-reef-atoll_480.jpg">
                           <div class="markha">
                              <h4>Lorem Ipsum</h4>
                              <p class="dummy-mail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                              </p>
                              <button class="theme">View More</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <div class="galleri">
         <div class="row">
            <div class="col-md-12">
               <section id="demos">
                  <div class="row">
                     <div class="large-12 columns">
                        <div class="owl-carousel owl-theme">
                           <div class="item">
                              <img src="images/armenia-sevanavank-monastery.jpg">									 
                              <div class="markha">
                                 <h4>Lorem Ipsum</h4>
                                 <p class="dummy-mail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 									 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                 <button class="theme">View More</button>								  
                              </div>
                           </div>
                           <div class="item">
                              <img src="images/25-1521269446.jpg">									 
                              <div class="markha">
                                 <h4>Lorem Ipsum</h4>
                                 <p class="dummy-mail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 									 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                 <button class="theme">View More</button>								  
                              </div>
                           </div>
                           <div class="item">
                              <img src="images/lighthouse-reef-atoll_480.jpg">									 
                              <div class="markha">
                                 <h4>Lorem Ipsum</h4>
                                 <p class="dummy-mail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 									 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                 <button class="theme">View More</button>								  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="programs-main">
   <div class="container">
      <h3 class="videos">Around the trip: Blog & Videos</h3>
      <p class="dummy">Lorem Ipsum is simply dummy text of the printing</p>
      <div class="row">
         <div class="col-md-4">
            <img src="images/Quand partir sri lanka.jpg" class="normal">
            <p class="dummy-simply">Lorem Ipsum is simply dummy text of the printing and
               typesetting industry. Lorem Ipsum has been the industry's standard.
               <br>
            <div class="read-btn-ipsum">
               <button>Read More</button>
            </div>
         </div>
         <div class="col-md-8">
            <div class="standars">
               <iframe width="100%" height="70%" src="https://www.youtube.com/embed/tgbNymZ7vqY">
               </iframe>
            </div>
         </div>
      </div>
   </div>
</div>
   
@endsection