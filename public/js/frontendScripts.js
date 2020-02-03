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
    
});