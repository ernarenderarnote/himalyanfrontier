@extends('layouts.frontend')
@section('content')
<section class="single_product7">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-sm-3">
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
                        <li class="hot_deal"><input type="radio" name="itinerary_type"  value="hot_deal" {{ $get_itinerary == 'hot_deal' ? 'checked' : '' }}>Hot Deal</li>
                        <li class="fixed"><input type="radio" name="itinerary_type"  value="fixed_departure" {{ $get_itinerary == 'fixed_departure' ? 'checked' : '' }}>Fixed Departure</li>
                        <h4 class="date4 destinal">Date</h4>
                        <ul class="radei daate" style="{{ $get_date !='' ? '' : 'display:none'}}">
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
                            <div class="slidecontainer">
                                <input type="hidden" name="rating_from" id="rating-from" value="{{ $get_rating_from != '' ? $get_rating_from : '1' }}">
                                <input type="hidden" name="rating_to" id="rating-to" value="{{ $get_rating_to != '' ? $get_rating_to : '1' }}">
                                <label id="rating-label">{{$get_rating_from}} - {{$get_rating_to}}</label>
                            <div id="slider-range"></div>
                        </div>
                    </ul>
               </form>
            </div>
         </div>
         
         <div class="col-md-9 col-sm-12">
            <!-- navigation holder -->
            {{ $itineraries->links() }}
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
                                    <div class="book_now">
                                    <h4><small>Per Person</small><span class="">{{$itinerary->price}}</span></h4>
                                    <div class="btn_ouer">
                                        <a href="#">Book Now</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
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
                                                <p>Grade</p>
                                            @endif
                                        </p>
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
</script>
@endsection