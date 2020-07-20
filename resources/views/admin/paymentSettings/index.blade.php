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
                    <input id="banks-charges" name="partial_payment" type="text" placeholder="Please enter partial payment  " class="form-control input-md" value="{{ old('partial_payment', isset($paymentSettings) ? $paymentSettings->partial_payment : '') }}">
                    @if($errors->has('partial_payment'))
                        <em class="invalid-feedback">
                            {{ $errors->first('partial_payment') }}
                        </em>
                    @endif   
                </div>
            </div>
            @if(isset($paymentSettings) && isset($paymentSettings->additional_fields) )
                @if($paymentSettings->additional_fields != '')
                    @foreach(json_decode($paymentSettings->additional_fields) as $value)
                        <div class="form-group additional-added">
                            <label class="col-md-4 control-label">{{$value->field_name}} (In %)</label> 
                            <div class="entry input-group col-md-6">
                                <input type="hidden" name="field_name[]" class="form-control" value="{{$value->field_name}}" id="field-name" placeholder="Field Name">  
                                <input class="form-control" name="field_value[]" type="text" value="{{$value->field_value}}">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger btn-add" type="button">
                                        <span class="fa fa-remove added-remove"></span>
                                    </button>
                                </span>
                            </div>
                        </div>    
                    @endforeach
                @endif    
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div data-role="dynamic-fields">
                        <div class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="field-name">Field Name</label>
                                <input type="text" name="field_name[]" class="form-control" id="field-name" placeholder="Field Name">
                            </div>
                            <span>-</span>
                            <div class="form-group">
                                <label class="sr-only" for="field-value">Field Value</label>
                                <input type="text" name="field_value[]" class="form-control" id="field-value" placeholder="Enter Field Value in %">
                            </div>
                            <button class="btn btn-danger" data-role="remove">
                                <span class="fa fa-remove"></span>
                            </button>
                            <button class="btn btn-primary" data-role="add">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div> 
                    </div> 
                </div> 
            </div>
            </br>  
            <div class="form-group">
                <div class="col-md-6">
                    <input  type="submit" value="Save Settings" class="btn btn-info">
                </div>
            </div>
        </form>    
    </div>
</div>
@section('scripts')
@parent
<script>  
 $(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function(){
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
    $('.added-remove').on('click',function(e){
        $(this).parents('.additional-added').remove();
        e.preventDefault();
    });
});
</script>
@endsection
@endsection