//jquery scripts for frontend 
$(document).ready(function(){
	//form Submit
    $('#login-form').on("submit", function(e){
        e.preventDefault(); 
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
                    number   : 'Please enter a vlid number.'
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
						$('input[name="mobile_number"]').after(error);	
					}else{
						$('.bg-light').remove();
					    $('.dynamic-container').html(result);
					}
					
                }
            });
        } 
          
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
                    var error  = '<div class="alert alert-danger">';
                        error  += '<strong>'+result.msg+'</strong>';
                        error  += '</div>';
                        $('.card').before(error);
                }else{
                    var message  = '<div class="alert alert-success">';
                        message  += '<strong>'+result.msg+'</strong>';
                        message  += '</div>';
                        $('.card').before(message);
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
    $('input[name="destination"]').on('change', function(){
        $('input[name="itinerary_type"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    $('input[name="activity"]').on('change', function(){
        $('input[name="itinerary_type"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    $('input[name="itinerary_type"]').on('change', function(){
        $('input[name="activity"]:checked').removeAttr('checked');
        $('input[name="destination"]:checked').removeAttr('checked');
        $('input[name="date"]:checked').removeAttr('checked');
        $('.advanced_serch_form').submit();
    });
    $('input[name="s"]').on('focusout', function(){
        $('.advanced_serch_form').submit();
    });
    $('.daate input[name="date"]').on('change', function(){
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
        var payment_option = $('select[name="payment_percentage"]').attr('value');
        if(payment_option  == ''){
            payment_option = 'full_payment';
        }
        var activity_price = $('input[name="activity_price"]').val();
        $('.participant-number').html(participant_count);
        if( payment_option == 'partial'  ){
            var price = calculatePrice(participant_count, activity_price);
            $('.price-total').html(price.partial_price);
            $('.activity-price').html(price.total_price_per);
        }else{
            $('.activity-price').html(activity_price);
            $('.price-total').html(participant_count * activity_price);
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
            $('.activity-price').html(price.total_price_per);
            $('.price-total').html(price.partial_price);
        }else{
            $('.activity-price').html(activity_price);
            $('.price-total').html(participant_count * activity_price);
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

});

$(document).ready(function() {   
    
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

function calculatePrice(participant, activity_price){
    var total_price     = participant * activity_price;
    var partial_price   = (total_price/100)*20;
    var total_price_per = (activity_price/100)*20;
    return {
        'partial_price'  : partial_price,
        'total_price_per' : total_price_per
    };
}