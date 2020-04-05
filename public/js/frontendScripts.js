//jquery scripts for frontend 
$(document).ready(function(){
	//form Submit
    $('#login-form').on("submit", function(e){
        
        var form = $(this);
        var data = form.serialize();
        var action = form.attr('action');
		var method = form.attr('method');
        //form validation 
        form.validate({
			ignore: "",
            rules:{
                mobile_number: {
					required : true,
					number   : true,
				},
            },
            messages: {
                mobile_number : {
                    required : 'Please enter mobile number.',
                    number   : 'Please enter a valid number.'
                },
            },
            errorPlacement: function (error, element) {
                $('.custom-error').html('');
                error.appendTo('.custom-error');
            },
       
        });
        
        /*check if form is valid or not*/
        if (form.valid() === true){
            $('.loader').show();
			$.ajax({
                url: action,
                cache: false,
                data:data,
                type:'POST',
                success: function(result) {
                    $('.loader').hide();
                    if(result.error == true){
						var error  = '<div class="invalid-feedback">';
							error  += result.msg;
							error  += '</div>';
						$('.custom-error').html(error);	
					}else{
						$('.bg-light').remove();
					    $('.dynamic-container').html(result);
					}
					
                }
            });
        } 
        e.preventDefault();  
	});	
	$('input[name="mobile_number"]').blur(function() {
        var mbobileNumber = $(this).val();
        $('input[name="full_number"]').val(mbobileNumber);
    });
	//otpForm
	$(document).on("submit", ".otp-form", function(e){
        e.preventDefault(); 
        var form = $(this);
        var data = form.serialize();
        var action = form.attr('action');
		var method = form.attr('method');
        //form validation 
        form.validate({
			ignore: "",
            rules:{
                otp: {
					required : true,
					number   : true,
				},
            },
            messages: {
                otp : {
                    required : 'Please enter otp.',
                    number   : 'Please enter a vlid otp.'
                },
            },
       
        });
        
        /*check if form is valid or not*/
        if (form.valid() === true){
            $('.loader').show();
			$.ajax({
                url: action,
                cache: false,
                data:data,
                type:'POST',
                success: function(result) {
                    $('.loader').hide();
					if(result.error == true){
						var error  = '<div class="invalid-feedback">';
							error  += result.msg;
							error  += '</div>';
                       // $('input[name="otp"]').next('.invalid-feedback').remove();
						$('input[name="otp"]').after(error);	
					}else{
                        $('.loader').show();
						window.location.href = result.redirect_url;
					}
                }
            });
        } 
          
	});	

    //resendotp
	$(document).on("click", ".resend-otp", function(e){
       var action = $(this).attr('href');
       $('.loader').show();
        $.ajax({
            url: action,
            cache: false,
            type:'GET',
            success: function(result) {
                $('.loader').hide();
                if(result.error == true){
                    $('input[name="otp"]').after(result.msg);
                }else{
                   $('input[name="otp"]').after(result.msg);
                }
            }
        });
        e.preventDefault(); 
    });	
    //auto alert dismess
    $(".alert").delay(4000).slideUp(200, function() {
        $(this).alert('close');
    });   

    $('.destinal').on('click',function(){
        $(this).next('.radei').slideToggle();
    });

});

//search filter script
$('document').ready(function(){
    $('.advanced_serch_form input[name="destination"]').on('change', function(){
        $('input[name="itinerary_type"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    $('.advanced_serch_form input[name="activity"]').on('change', function(){
        $('input[name="itinerary_type"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    $('.advanced_serch_form input[name="itinerary_type"]').on('change', function(){
        $('input[name="activity"]:checked').removeAttr('checked');
        $('input[name="destination"]:checked').removeAttr('checked');
        $('input[name="date"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    $('.advanced_serch_form input[name="s"]').on('focusout', function(){
        $('.advanced_serch_form').submit();
    });
    $('.advanced_serch_form input[name="date"]').on('change', function(){
        $('input[name="itinerary_type"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    //currency swither
    $('.currency-switcher').on('change',function(){
        $(this).closest('form').submit();
    });

    //booking form
    $('.booking-schedule').on('click',function(e){
        $(this).closest('form').submit();
        e.preventDefault();
    });

    //booking participant add form
    $('select[name="additional_user"]').on('change',function(){
        $('.end-participants').html('');
        var numCopies = $(this).val();
        if(numCopies == ''){
            numCopies = 0;
        }
        var participant_count = parseInt(numCopies) + 1;
        var e = $('.personal-details-data:first');
        var $clone;
        var contacts =[];
        for (var i = 1; i <= numCopies; i++) {
            $clone = e.clone();
            $clone.find('.participant-h').html('Participant -'+i);
            $clone.find("input").each(function(){
                $(this).val('');
                var oldName   = $(this).attr('name');
                var breakname = oldName.split('[');
                var newName   = breakname[0]+'['+i+']';
                $(this).attr('name',newName);  
            });
            $clone.find("select").each(function(){
                $(this).val('');
                var oldName   = $(this).attr('name');
                var breakname = oldName.split('[');
                var newName   = breakname[0]+'['+i+']';
                $(this).attr('name',newName);  
            });
            $clone.find('.clear:last').after('<hr/>');
            $('.end-participants').append($clone);
            customValidation();
        }
        var payment_option = $('.payment_method option:selected').attr('value');
        if(payment_option  == ''){
            payment_option = 'full_payment';
        }
        var activity_price = $('input[name="activity_price"]').val();
        $('.participant-number').html(participant_count);
        if( payment_option == 'partial'  ){
            var price = calculatePrice(participant_count, activity_price);
            var total_incl_tax = parseFloat(price.partial_price) + parseFloat(price.tax_price);
            $('.activity-price').html(parseFloat(price.total_price_per).toFixed(2));
            $('.price-total').html((price.partial_price).toFixed(2)); 
            $('.amount-including-tax').html(price.tax_price);
            $('.total_incl_tax').html(total_incl_tax.toFixed(2));
        }else{
            var total_price    = participant_count * activity_price;
            var bank_charges   = (total_price/100)*3.07;
            var total_incl_tax = parseFloat(total_price) + parseFloat(bank_charges);
            $('.activity-price').html(parseFloat(activity_price).toFixed(2));
            $('.price-total').html( total_price.toFixed(2) );    
            $('.amount-including-tax').html(parseFloat(bank_charges).toFixed(2)) ;
            $('.total_incl_tax').html(total_incl_tax.toFixed(2));
        }

    });
    
    $('select[name="payment_percentage"]').change(function(){
        var participant_count = $('select[name="additional_user"]').val();
        if(participant_count == ''){
            participant_count = 0;
        }
        participant_count = parseInt(participant_count) + 1;
        if( participant_count == 'undefined' || participant_count == ''){
            participant_count = 1;
        }
        var payment_option    = $(this).val();
        var activity_price = $('input[name="activity_price"]').val();
        if( payment_option == 'partial'  ){
            var price = calculatePrice(participant_count, activity_price);
            var total_incl_tax = parseFloat(price.partial_price) + parseFloat(price.tax_price);
            $('.activity-price').html(parseFloat(price.total_price_per).toFixed(2));
            $('.price-total').html((price.partial_price).toFixed(2)); 
            $('.amount-including-tax').html(price.tax_price);
            $('.total_incl_tax').html(total_incl_tax.toFixed(2));
        }else{
            var total_price    = participant_count * activity_price;
            var bank_charges   = (total_price/100)*3.07;
            var total_incl_tax = parseFloat(total_price) + parseFloat(bank_charges);
            $('.activity-price').html(parseFloat(activity_price).toFixed(2));
            $('.price-total').html( total_price.toFixed(2) );    
            $('.amount-including-tax').html(parseFloat(bank_charges).toFixed(2));
            $('.total_incl_tax').html(total_incl_tax.toFixed(2));
        }

    });
});    
/* when document is ready */
$(function(){
     /* initiate lazyload defining a custom event to trigger image loading  */
     $(".img_outer img").lazyload({
        event : "turnPage",
        effect : "fadeIn"
    });
    /* initiate the plugin */       
    $("div.holder").jPages({
        containerID  : "itemContainer",
        perPage      : 10,
        startPage    : 1,
        startRange   : 1,
        midRange     : 5,
        endRange     : 1,
        minHeight : false,
        minWidth : false,
        callback    : function( pages,items ){
            $(".legend1").html("Page " + pages.current + " of " + pages.count);
                /* lazy load current images */
            items.showing.find(".img_outer img").trigger("turnPage");
            /* lazy load next page images */
            items.oncoming.find(".img_outer img").trigger("turnPage");
        }
    });
    //phone number flag script
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      //allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
       hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
        preferredCountries: ['in', 'us'],
        separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
     //mobile code selected.
     var selectedCountryCode = $('.iti__active').attr('data-dial-code');
     $('.iti__country').on('click',function(){
        selectedCountryCode = $(this).attr('data-dial-code');
        $('input[name="country_code"]').val(selectedCountryCode);
     });
     $('input[name="country_code"]').val(selectedCountryCode);
});

$(document).ready(function() {   
	$('.rvs-container').rvslider();
	
    $("#payment-form").validate({
      ignore: "",
      rules: {
        booking_date:{
          required:true,
        },
        "name[0]": {
          required: true
        },
        "email[0]":{
          required:true,
          email:true
        },
        "mobile[0]":{
          required:true
        },
        "age[0]":{
          required:true,
          digits:true
        },
        "gender[0]":{
          required:true
        },
        "height[0]":{
          required:true,
          digits:true
        },
        "weight[0]":{
          required:true,
          digits:true
        },
        address:{
          required:true
        },
        state:{
          required:true
        },
        city:{
          required:true
        },
        pin_code:{
          required:true,
          digits:true
        },
        source:{
          required:true
        },
        travelexperiance:{
          required:true
        },
        agree : {
           required : true
        },
        payment_percentage: {
            required : true
        },
     },   
      messages: { 
        booking_date:{
          required:"Please select schedule"
        },
       "name[0]": {
          required: "Please enter name"
        },
        "email[0]":{
          required:"Please enter email",
          email:"Please enter valid email",
        },
        "mobile[0]":{
          required:"Please enter mobile number"
        },
        "age[0]":{
          required:"Please enter age"
        },
        "gender[0]":{
          required:"Please select gender"
        },
        height:{
          required:"Please enter height"
        },
        weight:{
          required:"Please enter weight"
        },
        address:{
          required:"Please enter address"
        },
        state:{
          required:"Please enter state"
        },
        city:{
          required:"Please enter city"
        },
        pin_code:{
          required:"Please enter pin"
        },
        source:{
          required:"Please select option"
        },
        travelexperiance:{
          required:"Please select option"
        },
       
        agree:{
          required:"Please check term & conditions"
        },
        payment_percentage: {
            required :"Please select payment mode"
         },
      },
      
    }); 
    
    //sildebar fix script
    var leftHeight = $('.left_side').offset().top;
    $(window).scroll(function () {   
   
        if($(window).scrollTop() > leftHeight) {
           $('.left_side').css('position','fixed');
           $('.left_side').css('top','0'); 
           $('.left_side h3').css('padding','18px');
        }
       
        else if ($(window).scrollTop() <= leftHeight) {
           $('.left_side').css('position','');
           $('.left_side').css('top','');
           $('.left_side h3').css('padding','');
        }  
           if ($('.left_side').offset().top + $(".left_side").height() > $(".footer").offset().top) {
               $('.left_side').css('top',-($(".left_side").offset().top + $(".left_side").height() - $(".footer").offset().top));
           }
       });

});

function customValidation () {
    $('.part-name').each(function() {
        $(this).rules('add', {
        required: true,
        messages: {
            required: "Please enter name",
        },
        });
    });
    $('.part-email').each(function() {
        $(this).rules('add', {
        required: true,
        email:true,
        messages: {
            required: "Please enter email",
        },
        });
    });
    $('.part-mobile').each(function() {
        $(this).rules('add', {
        required: true,
        digits:true,
        messages: {
            required: "Please enter mobile",
        },
        });
    });
    $('.part-age').each(function() {
        $(this).rules('add', {
        required: true,
        digits:true,
        messages: {
            required: "Please enter age",
        },
        });
    });
    $('.part-gender').each(function() {
        $(this).rules('add', {
        required: true,
        messages: {
            required: "Please select gender",
        },
        });
    });
    $('.part-height').each(function() {
        $(this).rules('add', {
        required: true,
        digits:true,
        messages: {
            required: "Please enter height",
        },
        });
    });
    $('.part-weight').each(function() {
        $(this).rules('add', {
        required: true,
        digits:true,
        messages: {
            required: "Please enter weight",
        },
        });
    });

   
} 
$(window).bind("pageshow", function() {
   $('select[name="payment_percentage"], select[name="additional_user"]').val('');
});
function calculatePrice(participant, activity_price){
    var bank_charges      = $('.bank-charges').val(); 
    var partial_payment   = $('.partial-payment').val();
    var remaining_payment = $('.remaining-payment').val();
    if( bank_charges == 'undefined' || bank_charges == '' ){
        bank_charges = 3.07;
    }
    if( partial_payment == 'undefined' || partial_payment == '' ){
        partial_payment = 20;
    }
    if( remaining_payment == 'undefined' || remaining_payment == '' ){
        remaining_payment = 80;
    }
    var total_price     = participant * activity_price;
    var partial_price   = (total_price/100) * partial_payment;
    var tax_partial_price = (partial_price/100) * bank_charges;
    var total_price_per = (activity_price/100) * partial_payment;
    return {
        'partial_price'   : partial_price,
        'total_price_per' : total_price_per,
        'tax_price'       : tax_partial_price.toFixed(2)
    };
}

//autocomplete search
// AJAX call for autocomplete 
$(document).ready(function(){
	$(".search").keyup(function(){
        
       var _token  = $('meta[name="csrf-token"]').attr('content');
       var _appurl = $('meta[name="app-url"]').attr('content');
       var _loader = _appurl+'/images/LoaderIcon.gif';
       
        if($(this).val().length >= 3 ){
            $.ajax({
                headers: {'x-csrf-token': _token},
                type: "POST",
                url: "/auto-search",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                    $(".search").css("background","#FFF url("+_loader+") no-repeat 260px");
                },
                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $(".search").css("background","#FFF");
                }
            });
        }
	});
});
//To select country name
function selectResult(val) {
    $(".search").val(val);
    $("#suggesstion-box").hide();
}
