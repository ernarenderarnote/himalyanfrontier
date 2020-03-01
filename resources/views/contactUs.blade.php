@extends('layouts.frontend')
@section('content')
<section class="banner_contact">
     <div class="map_outer">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13498.168740284682!2d77.186926!3d32.2434914!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5877272449ef7faa!2sHimalayan%20Frontiers!5e0!3m2!1sen!2sin!4v1582653255830!5m2!1sen!2sin" width="" height="" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
    
</section>
    <section class="about_us grey_outer8">
        <div class="container">
         <div class="headiny56"><h4>Contact us</h4></div>      
                
        <div class="row">
        
        <div class="col-md-5 col-sm-5">
            <div class="addre">
                <div class="inner_hm">
                <p><b>Address</b></br>
    152/4, SECOND FLOOR, MODEL TOWN, NEW <br>	MANALI, DISTT KULLU 175131 (HP) INDIA</p>
                </div>
                <div class="inner_hm">
                <p><b>Phone</b></br>
    LOCAL: 91 1902 250384 <br>MOBILE: +91 94183 44988</p>
                </div>
                <div class="inner_hm">
                <p><b>Email</b></br>
    INFO@HIMALAYANFRONTIERS.COM <br>WWW.HIMALAYANFRONTIERS.COM</p>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-7">
            <div class="custom_form45">
                <form action="{{route('ContactUs.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" name="name" class="form-control" id="" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </em>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email:</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <em class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </em>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                        @if($errors->has('subject'))
                            <em class="invalid-feedback">
                                {{ $errors->first('subject') }}
                            </em>
                        @endif
                    </div>
                        <div class="form-group">
                        <label for="message">Your Message:</label>
                        <textarea id="w3mission" name="message" rows="4" cols="50">{{ old('message') }}</textarea>
                        @if($errors->has('message'))
                            <em class="invalid-feedback">
                                {{ $errors->first('message') }}
                            </em>
                        @endif
                    </div>
                    <div class="custom_btn"><button type="submit" class="btn btn-default">Send</button><div>
                </form>
            </div>
        </div>
        </div>
        </div> 
    </section>
@endsection