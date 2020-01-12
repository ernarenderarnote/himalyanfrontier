
    <div class="card bg-light">
        <article  class="card-body mx-auto" style="width: 400px;">
            <p class="text-center otp-msg">Enter the otp sent to your mobile {{ isset($mobile_number) ? $mobile_number : ''}}</p>
            <form class="otp-form" method="POST" action="{{ route('auth.login.otp') }}">
                {{ csrf_field() }}
                <div class="form-group input-group {{ $errors->has('otp') ? 'has-error' : '' }}" >
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="otp" class="form-control input-field" placeholder="Enter Otp" type="text">
                    @if($errors->has('otp'))
                        <em class="invalid-feedback">
                            {{ $errors->first('otp') }}
                        </em>
                    @endif
                </div> <!-- form-group// -->
                <div class="form-group input-group {{ $errors->has('otp') ? 'has-error' : '' }}" >
                    <a href="{{ route('auth.login.resendotp') }}" class="resend-otp">Resend Otp</a>
                </div> <!-- form-group// -->                                    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Submit </button>
                </div> <!-- form-group// -->      
                                                                            
            </form>
        </article>
    </div> <!-- card.// -->

 
