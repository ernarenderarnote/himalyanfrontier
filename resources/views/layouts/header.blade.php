<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet"> 


<!-- top-bar -->
<div class="top-bar py-2 bg-li">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 top-social-w3pvt-am mt-lg-1 mb-md-0 mb-1 text-lg-left text-center">
            </div>
            <div class="col-xl-8 col-lg-7 top-social-w3pvt-am mt-lg-0 mt-2">
                <div class="row">
                <div class="col-9 top-w3layouts" style="text-align: right;">
                    <p class="team-row">
                        <a href="#"> Online Payment</a> |
                        <a href="{{route('ourTeam')}}"> Our Team</a> | 
                        <a href="{{route('blogs')}}"> Blog </a>  |  
                        <a href="{{route('testimonials')}}"> Testimonial </a> 
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
                    <form action="{{route('advanced-search')}}" method="post" class="search-bottom-wthree d-flex my-md-0 my-2">
                        @csrf
                        <input class="search col" name='s' type="search" placeholder="Search Here...">
                        <button class="form-control btn col-2" type="submit"><span class="fa fa-search"></span></button>
                    </form>
                </div>
                </div>
                <div class="col-md-4">
                <div class="contacts desktop_view">
                    <span class="expert">TALK TO AN EXPERT</span>
                    <div class="headerPhoneNumber">
                        <a class="displayByWETGDestination isWEAU" href="tel:+91- 9816043615" onclick="ga('send', 'event', 'Top Header', 'Call - Expert', 'Talk to an Expert - Call', 20);" title="9780135414">+91- 9816043615</a>       
                    </div>
                    <span class="email"> <a class="btn-email-us" href="javascript:;" data-toggle="modal" data-target="#askAnExpertModal" onclick="ga('send', 'event', 'Top Header', 'Click', 'Talk to an Expert - Email', 10);" title="Email Us">EMAIL US</a></span> 
                </div>
                  <div class="contacts mobile_view3">
                    <span class="expert">TALK TO AN EXPERT</span>
                    <span class="headerPhoneNumber">
                        <a class="displayByWETGDestination isWEAU" href="tel:+91- 9816043615" onclick="ga('send', 'event', 'Top Header', 'Call - Expert', 'Talk to an Expert - Call', 20);" title="9780135414">+91- 9816043615</a>       
                    </span>
                    <span class="email"> <a class="btn-email-us" href="javascript:;" data-toggle="modal" data-target="#askAnExpertModal" onclick="ga('send', 'event', 'Top Header', 'Click', 'Talk to an Expert - Email', 10);" title="Email Us">EMAIL US</a></span> 
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-row custom_header">
<div class="navbar navbar-light bg-light navbar-static-top navbar-expand-md">
    <div class="container">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">☰</button>
             
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                
               <li class="dropdown menu-large nav-item"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Activities</a>
                    <ul class="dropdown-menu megamenu">
                        <div class="row">
                            @foreach($menus->activities() as $key=>$value)
                                @if(strtolower($key) == 'india')
                                    <li class="col-md-6 dropdown-item">
                                        <ul>
                                            
                                            <li class="dropdown-header">{{$key}}</li>
                                            <div class="row">
                                                @foreach($value as $k=>$v)
                                                    <div class="col-md-6">
                                                        <li class="activity-menu"><a href="{{url('advanced-search?s=&destination='.strtolower($key).'&activity='.$v.'&rating_from=1&rating_to=4')}}">{{ $k }}</a></li> 
                                                    </div>
                                                    
                                                @endforeach
                                            </div>
                                                
                                            <li class="divider"></li>
                                            
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                            <li class="col-md-6 dropdown-item">
                                @foreach($menus->activities() as $key=>$value)
                                    @if(strtolower($key) != 'india')
                                        <ul> 
                                            <li class="dropdown-header">{{$key}}</li>
                                            
                                                @foreach($value as $k=>$v)
                                                    <li class="activity-menu"><a href="{{url('advanced-search?s=&destination='.strtolower($key).'&activity='.$v.'&rating_from=1&rating_to=4')}}">{{ $k }}</a></li>
                                                @endforeach
                                                
                                            <li class="divider"></li>
                                            
                                        </ul>
                                    @endif
                                @endforeach
                            </li>
                        </div>
                    </ul>
                </li>
                <li class="dropdown menu-large nav-item"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Fixed Departures</a>
                    <ul class="dropdown-menu megamenu">
                        <!-- <div class="row"> -->
                            <!-- <li class="col-md-12 dropdown-item"> -->
                                <ul>
                                    <li class="dropdown-header">Fixed Departure Programs</li>
                                    <div class="custom-drop-menu">
                                            @foreach($menus->fixedDeparture() as $diparture)
                                                <li class="col-md-4"><a href="{{ route('activity.slug', ['slug'=>$diparture->slug]) }}">{{ $diparture->title }}</a>
                                            @endforeach    
                                        </li>
                                    </div>
                                </ul>
                        <!--  </li> -->
                        <!-- </div> -->
                    </ul>
                </li>
                <li class="dropdown menu-large nav-item"> <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Hot Deals</a>
                    <ul class="dropdown-menu megamenu">
                        <!-- <div class="row"> -->
                            <!-- <li class="col-md-12 dropdown-item"> -->
                                <ul>
                                    <li class="dropdown-header">Hot Deals</li>
                                    <div class="custom-drop-menu">
                                            @foreach($menus->hotDeals() as $hotDeal)
                                                <li class="col-md-4"><a href="{{ route('activity.slug', ['slug'=>$hotDeal->slug]) }}">{{ $hotDeal->title }}</a>
                                            @endforeach    
                                        </li>
                                    </div>
                                </ul>
                        <!--  </li> -->
                        <!-- </div> -->
                    </ul>
                </li>
                </li>
                  <li class="nav-item"><a href="{{route('aboutUs')}}" class="nav-link">About Us</a>
                </li>
                  <li class="nav-item"><a href="{{route('ContactUs')}}" class="nav-link">Contact Us</a></li>
                  
                    @if (Route::has('login'))
                            
                        @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello,{{Auth::user()->full_name}} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('bookingHistory')}}">Booking History</a></li>
                                <li><a href="{{route('transectionsHistory')}}">Transection History</a></li>
                                <li><a href="">My Profile</a></li>
                                <li><a href="" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></li>   
                                </ul>
                            </li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a>
                        @endauth
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
</div>