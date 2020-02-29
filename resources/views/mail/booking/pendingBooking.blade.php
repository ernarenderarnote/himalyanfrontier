<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mail Format</title>
<style>
body { margin: 0; padding: 0px; background-color: #ececec; }
* { box-sizing: border-box; }
.mail-formatsection { background-color: #ffffff; box-shadow: 0 0 2px #000000; height: auto; margin: 20px auto 0; max-width: 100%; padding: 8px 20px 20px; width: 100%; }
.mail-formatsection p { font-size: 20px; }
.mail-formatsection a { font-size: 20px; }
.logo { text-align: center; }
</style>
</head>

<body>
<div class="mail-formatsection">
  <div class="logo"><a href="#"><img src="{{url('images/himalayn_frontiers_logo_vector2017__1_-pdf_720.png')}}"></a></div>
  	@php
        $booker_name    = json_decode($booking->name);
        $booker_email   = json_decode($booking->email);
        $booker_contact = json_decode($booking->mobile);
        $booker_age     = json_decode($booking->age);
        $booker_gender  = json_decode($booking->gender);
        $booker_city    = $booking->city;
    @endphp
  <p>New order for Activity({{$booking->itinerary->title}}) with pending payments.</p>
  <br/>
  	<div class="booker_details">
        <p><span><b>Booker Name:</b> </span>{{$booker_name[0]}}</p>
        <p><span><b>Email ID:</b></span> {{$booker_email[0]}}</p>
        <p><span><b>Contact:</b> </span> {{$booker_contact[0]}}</p>
        <p><span><b>City:</b> </span> {{$booker_city}}</p>
    </div>
    <br/>
    <div class="itinerary_details">
        <h3>Activity Details</h3>
        <p><span><b>Actvity Name:</b> </span>{{$booking->itinerary->title}}</p>
        <p><span><b>Start From:</b></span> {{$booking->activity_from_date}}</p>
        <p><span><b>End From:</b> </span> {{$booking->activity_to_date}}</p>
    </div>
    @if($booking->no_of_participants > 1)
            <div class="Prcening_details participants_details">
                <h4>Additional Details</h4>
                <p>Additional Participants Details (Excluded Booker )</p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                    @for($i=1; $i < count($booker_name); $i++)
                        <tr>
                            <td>{{ $booker_name[$i] }}</td>
                            <td>{{ $booker_email[$i] }}</td>
                            <td>{{ $booker_contact[$i] }}</td>
                            <td>{{ $booker_age[$i] }}</td>
                            <td>{{ $booker_gender[$i] }}</td>
                        </tr>
                    @endfor    
                    </tbody>
                </table>
            </div>
        @endif    
        
  <p>Regards,</p>

  <p>Himalayan Frontiers Culture & Adventure Tours Pvt. Ltd.</p>
  <br/><br/>
  <a href="">© 2020 Himalayan Frontiers Culture & Adventure Tours Pvt. Ltd.. All rights reserved.</a> </div>
</body>
</html>
