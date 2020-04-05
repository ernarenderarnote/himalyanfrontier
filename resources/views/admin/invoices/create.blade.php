@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">Edit Invoice</div>
    <div class="card-body">
        <section class="create_invoice">
            <div class="container">
                <form action="{{ route("admin.invoices.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="heading5_outer8">
                        <h4>Create Invoice</h4>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                        <!--p><b>Invoice No : DEM91906578542</b></!p-->
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="left562">
                                    <p>Customer/Traveller Name* </p>
                                    <input type="text" name="customer_name" value="{{ old('customer_name', isset($invoice) ? $invoice->customer_name : '') }}" placeholder="Enter the Customer Name">
                                    @if($errors->has('customer_name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('customer_name') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="left562">
                                    <p>Customer/Email Id* </p>
                                    <input name="email" type="Email" value="{{ old('email', isset($invoice) ? $invoice->email : '') }}" placeholder="Enter the Customer Email Id">
                                    @if($errors->has('email'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </em>
                                    @endif
                                
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="left562">
                                    <p>Invoice Due Date </p>
                                    <input name="invoice_due_date" value="{{ old('invoice_due_date', isset($invoice) ? $invoice->invoice_due_date : '') }}" class="datepicker" type="text" placeholder="Select Due date">
                                    @if($errors->has('invoice_due_date'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('invoice_due_date') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="left562">
                                    <p>Booking Handled By </p>
                                    <input type="text" name="booking_handled_by" value="{{ old('booking_handled_by', isset($invoice) ? $invoice->booking_handled_by : '') }}">
                                    @if($errors->has('booking_handled_by'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('booking_handled_by') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="left562">
                                    <p>Travel Date </p>
                                    <input type="text" class="datepicker" value="{{ old('travel_name', isset($invoice) ? $invoice->travel_name : '') }}" name="travel_date" placeholder="Select Due travel date">
                                    @if($errors->has('travel_name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('travel_name') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="left562">
                                    <p>Customer/Traveller contact number* </p>
                                    <input type="text" value="{{ old('contact_number', isset($invoice) ? $invoice->contact_number : '') }}" name="contact_number" placeholder="Enter the Customer Contact Number">
                                    @if($errors->has('contact_number'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('contact_number') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="left562">
                                    <p>Customer/Tax Details (Optional) </p>
                                    <input type="text" value="{{ old('tax_details', isset($invoice) ? $invoice->tax_details : '') }}" name="tax_details" placeholder="Enter the Customer Email Id">
                    
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="left562">
                                    <p>Travel Location</p>
                                    <input type="text" value="{{ old('travel_location', isset($invoice) ? $invoice->travel_location : '') }}" name="travel_location" placeholder="Select Due date">
                                    @if($errors->has('travel_location'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('travel_location') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-3">
                                <div class="left562">
                                    <p>Currency</p>
                                    <select id="currency" name="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->code}}" {{ old('currency') == $currency->code ? 'selected' : '' }}>{{$currency->code}}</option>
                                        @endforeach   
                                    </select>
                                    @if($errors->has('currency'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('currency') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="second_sec5">
                        <div class="heading5_outer8">
                            <h4>Price Details</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                        </div>
                        <table class="table table-bordered invoice_table">
                            <thead>
                            <tr>
                            
                                <th scope="col">Description</th>
                                <th scope="col">No of Person</th>
                                <th scope="col">Per Person Price</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Amount</th>
                                <!-- <th scope="col"></th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                    
                                <td>
                                    <input value="" name="service_name" type="text" placeholder="Enter Service Name">
                                    @if($errors->has('service_name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('service_name') }}
                                        </em>
                                    @endif
                                </td>
                                <td>
                                    <input value="" name="no_of_persons" class="invoice_data" type="text" placeholder="">
                                    @if($errors->has('no_of_persons'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('no_of_persons') }}
                                        </em>
                                    @endif
                                </td>
                                <td>
                                    <input value="" name="per_person_price" class="invoice_data" type="text" placeholder="">
                                    @if($errors->has('per_person_price'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('per_person_price') }}
                                        </em>
                                    @endif
                                </td>
                                <td>
                                    <input value="" name="tax" class="invoice_data" type="text" placeholder="">%
                                    @if($errors->has('tax'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('tax') }}
                                        </em>
                                    @endif
                                    
                                    </td>
                                <td><span class="invoice_currency_symbol"></span>  <span class="invoice_amount"></span></td>
                                <!-- <td><i class="fa fa-plus-circle" aria-hidden="true"></i></td> -->
                            </tr>
                            <tr class="pay56">
                                <td class="payab6" colspan="4">Total Payable</td>
                                <td colspan="3"><span class="invoice_currency_symbol"></span> <span class="total_payable"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="second_sec5">
                        <div class="heading5_outer8">
                            <h4>Tour Itinery</h4>
                            <div class="text_ares">
                                <textarea name="tour_itinerary" class="summernote" id="w3mission" rows="4" cols="50" placeholder="">
                                    {{ old('tour_itinerary', isset($invoice) ? $invoice->tour_itinerary : '') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="heading5_outer8">
                            <h4>Inclusion</h4>
                            </div>
                            <div class="text_ares">
                                <textarea name="inclusion" class="summernote" id="w3mission" rows="4" cols="50" placeholder="">
                                    {{ old('inclusion', isset($invoice) ? $invoice->inclusion : '') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="heading5_outer8">
                            <h4>Exclusion</h4>
                            </div>
                            <div class="text_ares">
                                <textarea name="exclusion" class="summernote" id="exclusion" rows="4" cols="50" placeholder="">
                                    {{ old('exclusion', isset($invoice) ? $invoice->exclusion : '') }}
                                </textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <input type="submit" value="Create Invoice" class="btn btn-info" disabled>
                        </div>
                    </div>
                </form>    
            </div>
        </section>
    </div>
</div>
<div class="loader" style="display:none;"><img src="/images/demo_wait.gif"></div>
@section('scripts')
@parent
<script>
    $('.invoice_data').on('focusout',function(e){
        var per_person_price = $('input[name="per_person_price"]').val();
        var persons = $('input[name="no_of_persons"]').val();
        var tax     = $('input[name="tax"]').val();
        var _token  = '<?php echo csrf_token() ?>';
        if(tax == '' || tax =='undefined'){
            tax = '';
        }
        if(per_person_price !=='' && persons !==''){ 
            $('.loader').show();
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
               url: "{{ route('admin.invoices.calculatePrice') }}",
               data: {
                    'per_person_price' : per_person_price,
                    'persons' : persons,
                    'tax' : tax,
                },
                success:function(data) {
                    $('.loader').hide();
                   if(data.msg == 'success'){
                       $('.invoice_amount').html(data.amount);
                       $('.total_payable').html(data.total_price);
                       $('.invoice_currency_symbol').html($( "#currency option:selected" ).val());
                       $('input[type="submit"]').prop('disabled',false);
                   }
                }
            });  
        }
    });
    $( "#currency" ).on('change',function(){
        $('.invoice_currency_symbol').html($( "#currency option:selected" ).val());
    });
    $(".datepicker").datepicker({
     // 'dateFormat': 'dd-mm-yy',
    });
</script>
@endsection
@endsection