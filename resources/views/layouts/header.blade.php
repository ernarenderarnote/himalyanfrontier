<!-- top-bar -->
<div class="top-bar py-2 bg-li">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 top-social-w3pvt-am mt-lg-1 mb-md-0 mb-1 text-lg-left text-center">
            </div>
            <div class="col-xl-8 col-lg-7 top-social-w3pvt-am mt-lg-0 mt-2">
                <div class="row">
                <div class="col-9 top-w3layouts" style="text-align: right;">
                    <p class="team-row">Online Payment | Our Team |  Blog  |  Testimonial | 
                    @if (Route::has('login'))
                        
                        @auth
                            
                        @else
                        
                            <a href="{{ route('login') }}">Login</a>
                        @endauth
                    @endif

                    </p>
                </div>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <div class="col-3 border-left mt-lg-1 socila-brek text-md-right text-center">
                    <!-- social icons -->
                    <ul class="top-right-info">
                        <li class="mr-1 soci-effe facebook">
                            <a href="#">
                            <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="mr-1 soci-effe twitter">
                            <a href="#">
                            <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li class="mr-1 soci-effe google-plus">
                            <a href="#">
                            <i class="fa fa-youtube-play"></i>
                            </a>
                        </li>
                        <li class="soci-effe dribbble">
                            <a href="#">
                            <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- //social icons -->
                </div>
                </div>
            </div>
        </div>
        <div class="main-top">
            <!-- logo -->
            <div class="row">
                <div class="col-md-4">
                <h1 class="logo-style-res float-left">
                    <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{url('images/himalayn_frontiers_logo_vector2017__1_-pdf_720.png')}}" alt="" class="img-fluid logo-img mt-1">
                    </a>
                </h1>
                </div>
                <div class="col-md-4">
                <div class="search-w3layouts" style="margin-right:-190px; float: right; width: 100%;">
                    <form action="#" method="post" class="search-bottom-wthree d-flex my-md-0 my-2">
                        <input class="search col" type="search" placeholder="Search Here..."
                            required="">
                        <button class="form-control btn col-2" type="submit"><span
                            class="fa fa-search"></span></button>
                    </form>
                </div>
                </div>
                <div class="col-md-4">
                <div class="contacts">
                    <span class="expert">TALK TO AN EXPERT</span>
                    <div class="headerPhoneNumber">
                        <a class="displayByWETGDestination isWEAU" href="tel:+91- 9816043615" onclick="ga('send', 'event', 'Top Header', 'Call - Expert', 'Talk to an Expert - Call', 20);" title="9780135414">+91- 9816043615</a>       
                    </div>
                    <span class="email"> <a class="btn-email-us" href="javascript:;" data-toggle="modal" data-target="#askAnExpertModal" onclick="ga('send', 'event', 'Top Header', 'Click', 'Talk to an Expert - Email', 10);" title="Email Us">EMAIL US</a></span> 
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- nav -->
				<div class="nav_w3ls mx-lg-auto">
					<nav class="custom_nav">
						<label for="drop" class="toggle">Menu</label>
						<input type="checkbox" id="drop" />
						<ul class="menu mx-lg-auto">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Destinations <span class="caret"></span></a>
								<ul class="dropdown-menu">
								   @foreach($destinations as $destination)
								    <li><a href="{{url('advanced-search?destination='.$destination->slug)}}">{{ $destination->title }}</a></li>
								   @endforeach
								</ul>
							</li>
							<li class="dropdown">
								<a href="#about" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Activities <span class="caret"></span></a>
								<ul class="dropdown-menu">
								   @foreach($activities as $activity)
								    <li><a href="{{url('advanced-search?activity='.$activity->slug)}}">{{ $activity->title }}</a></li>
								   @endforeach
								</ul>
							</li>
                            <li><a href="{{url('advanced-search?itinerary_type=fixed_departure')}}">Fixed Departures</a></li>
                            <li><a href="{{url('advanced-search?itinerary_type=hot_deal')}}">Hot Deals</a></li>
							<li><a href="#gallery">About Us</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                            @if (Route::has('login'))
                        
                                @auth
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello,{{Auth::user()->full_name}} <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                        <li><a href="">Dashboard</a></li>
                                        <li><a href="{{route('bookingHistory')}}">Booking History</a></li>
                                        <li><a href="{{route('transectionsHistory')}}">Transection History</a></li>
                                        <li><a href="">My Profile</a></li>
                                        <li><a href="" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></li>   
                                        </ul>
                                    </li>
                                @endauth
                            @endif
						</ul>
					</nav>
				</div>
				<!-- //nav -->
			</div>
		</div>
	</div>
</div>