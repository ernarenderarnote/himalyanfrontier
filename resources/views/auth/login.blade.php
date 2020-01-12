@extends('layouts.frontend')
@section('content')
<div class="dynamic-container">
    <div class="card bg-light">
        <article class="card-body mx-auto {{ isset($otp) ? 'd-none' : '' }}" style="width: 400px;">
            <h4 class="card-title mt-3 text-center">Himalayan Frontiers</h4>
            <p class="text-center">Login With Mobile Number</p>
            <form method="POST" action="{{ route('login') }}" id="login-form">
                {{ csrf_field() }}
                <div class="form-group input-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}" >
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-mobile"></i> </span>
                    </div>
                    <input name="mobile_number" class="form-control input-field" placeholder="Enter Mobile Number" type="text">
                    @if($errors->has('mobile_number'))
                        <em class="invalid-feedback">
                            {{ $errors->first('mobile_number') }}
                        </em>
                    @endif
                </div> <!-- form-group// -->
                                                    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Submit </button>
                </div> <!-- form-group// -->      
                                                                            
            </form>
            <p class="divider-text">
                <span class="bg-light">OR</span>
            </p>
            <p>
                <a href="{{ url('login/google') }}" class="btn btn-block btn-google"> <i class="fa fa-google"></i>Sign in with google</a>
            </p>
            
        </article>
        
    </div> <!-- card.// -->

</div>
<div class="loader" style="display:none;"><img src="/images/demo_wait.gif"></div>

@endsection