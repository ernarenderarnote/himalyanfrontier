@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Payment Settings
    </div>
    <div class="card-body">
        <!-- Text input-->
        <form method="POST" action="{{route('admin.paymentSettings.store')}}" name="account_info_form" enctype="multipart/form-data" class="js-account-info-form" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <label class="col-md-4 control-label" for="bank-charges">Bank Charges(In %)</label>  
                <div class="col-md-6">
                    <input id="bank-charges" name="bank_charges" type="text" placeholder="Please enter bank charges " class="form-control input-md" value="{{ old('bank_charges', isset($paymentSettings) ? $paymentSettings->bank_charges : '') }}" >
                    @if($errors->has('bank_charges'))
                        <em class="invalid-feedback">
                            {{ $errors->first('bank_charges') }}
                        </em>
                    @endif  
                </div>
            </div>

            <!-- Prepended text-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="partial-payment">Partial Payment (In %)</label>  
                <div class="col-md-6">
                    <input id="bank-charges" name="partial_payment" type="text" placeholder="Please enter partial payment  " class="form-control input-md" value="{{ old('partial_payment', isset($paymentSettings) ? $paymentSettings->partial_payment : '') }}">
                    @if($errors->has('partial_payment'))
                        <em class="invalid-feedback">
                            {{ $errors->first('partial_payment') }}
                        </em>
                    @endif   
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <input  type="submit" value="Save Settings" class="btn btn-info">
            
                </div>
            </div>
        </form>    
    </div>
</div>
@endsection