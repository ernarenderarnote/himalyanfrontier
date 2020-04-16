<?php

Route::get('/','HomeController@Index')->name('home');

Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Auth::routes(['register' => false,'login'=>false]);
Route::match(['get','post'],'/login', 'Auth\LoginController@login')->name('login');
//adminlogin    
Route::match(['get'],'/administrator', [ "as" =>"admin", 'uses' => "Auth\LoginController@adminLogin" ]);
Route::group([ 'prefix' => 'auth', "as" => "auth." , "namespace" => "Auth"],function()
{  
    Route::post('/login', [ "as" =>"login", 'uses' => "LoginController@login" ]);
    Route::match(['get','post'],'/login/otp', [ "as" =>"login.otp", 'uses' => "LoginController@loginotp" ]);
    Route::match(['get'],'/login/resendotp', [ "as" =>"login.resendotp", 'uses' => "LoginController@resendOtp" ]);
    Route::match(['post'],'/admin', [ "as" =>"admin", 'uses' => "LoginController@admin" ]);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
});   
//Auth::routes();
//Auth::routes(['register' => false]);
//Auth::routes(['login' => false]);
//Route::match(['get','post'],'/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
Route::group(["namespace" => "Dashboard" , "middleware" => ["auth","info"]], function()
{
	Route::get('/dashboard', [ "as" =>"dashboard", 'uses' => "DashboardController@index" ]);

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    Route::match(['get','post'],'/profile', [ 'as' => 'profile', "uses" => "ProfileController@index"] );

    Route::match(['post'],'/profile/store', [ 'as' => 'profile.store', "uses" => "ProfileController@store"] );

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::match(['get','post'],'/itineraries/filter/', [ 'as' => 'itineraries.type', "uses" => "ItinerariesController@index"] );
    
    Route::delete('itineraries/destroy', 'ItinerariesController@massDestroy')->name('itineraries.massDestroy');

    Route::resource('itineraries', 'ItinerariesController');


    Route::delete('itinerarySchedule/destory/', 'ItinerariesController@scheduleDestroy')->name('itineraries.scheduleDestroy');

    Route::delete('destinations/destroy', 'DestinationsController@massDestroy')->name('destinations.massDestroy');
    
    Route::resource('destinations', 'DestinationsController');
    
    Route::delete('activities/destroy', 'ActivitiesController@massDestroy')->name('activities.massDestroy');
    
    Route::resource('activities', 'ActivitiesController');

    Route::delete('currencies/destroy', 'CurrenciesController@massDestroy')->name('currencies.massDestroy');
    
    Route::match(['post'],'/currencies/default/{id}', [ 'as' => 'currencies.default', "uses" => "CurrenciesController@setDefault"] );
    
    Route::resource('currencies', 'CurrenciesController');

    Route::delete('blogs/destroy', 'BlogsController@massDestroy')->name('blogs.massDestroy');

    Route::resource('blogs', 'BlogsController');

    Route::delete('testimonials/destroy', 'TestimonialsController@massDestroy')->name('testimonials.massDestroy');

    Route::resource('testimonials', 'TestimonialsController');

    Route::delete('booking/destroy', 'BookingController@massDestroy')->name('booking.massDestroy');
    
    Route::resource('booking', 'BookingController');

    Route::match(['get','post'],'/booking-show/{booking_id}/{notification_id}', [ 'as' => 'booking.display', "uses" => "BookingController@display"] );
    
    Route::delete('transections/destroy', 'TransectionsController@massDestroy')->name('transections.massDestroy');
    
    Route::resource('transections', 'TransectionsController');

    Route::delete('inqueries/destroy', 'InqueriesController@massDestroy')->name('inqueries.massDestroy');
    
    Route::resource('inqueries', 'InqueriesController');

    Route::match(['get','post'],'/inquery-show/{id}/{notification_id}', [ 'as' => 'inquery.display', "uses" => "InqueriesController@display"] );

    Route::delete('contact-us/destroy', 'ContactUsController@massDestroy')->name('contact_us.massDestroy');
    
    Route::resource('contact-us', 'ContactUsController');

    Route::match(['get','post'],'/contact-us-show/{id}/{notification_id}', [ 'as' => 'contactUs.display', "uses" => "ContactUsController@display"] );

    Route::match(['get','post'],'/payment_settings', [ 'as' => 'paymentSettings', "uses" => "PaymentSettingsController@index"] );

    Route::match(['get','post'],'/payment_settings/store', [ 'as' => 'paymentSettings.store', "uses" => "PaymentSettingsController@store"] );
    
    Route::delete('slides/destroy', 'SliderController@massDestroy')->name('slides.massDestroy');
    
    Route::resource('slides', 'SliderController');
    
    Route::match(['post'],'/slides/default/{id}', [ 'as' => 'slides.default', "uses" => "SliderController@setDefault"] );

    Route::delete('youtube-slider/destroy', 'YoutubeSliderController@massDestroy')->name('youtube-slider.massDestroy');
    
    Route::resource('youtube-slider', 'YoutubeSliderController');

    Route::delete('invoices/destroy', 'InvoiceController@massDestroy')->name('invoices.massDestroy');
    
    Route::resource('invoices', 'InvoiceController');

    Route::match(['post'],'/invoices/calculate-price', [ 'as' => 'invoices.calculatePrice', "uses" => "InvoiceController@CalculatePrice" ] );

    Route::match(['get'],'/invoices/downloadPDF/{id}', [ 'as' => 'invoices.downloadPdf', "uses" => "InvoiceController@downloadPDF" ] );

    
});

Route::match(['get','post'],'/profile', [ 'as' => 'profile', "uses" => "ProfileController@index",  'middleware' => ['auth'] ] );

Route::match(['post'],'/profile/store', [ 'as' => 'profile.store', "uses" => "ProfileController@store", 'middleware' => ['auth']] );

Route::match(['post'],'/currencySwitcher', [ 'as' => 'currencySwitcher', "uses" => "HomeController@currencySwitcher"] );

Route::group([ 'prefix' => 'activity', "as" => "activity."],function()
{  
    Route::get('/{slug}', [ "as" =>"slug", 'uses' => "HomeController@activity" ]);
}); 

Route::match(['get','post'],'/advanced-search', [ "as" =>"advanced-search", 'uses' => "HomeController@advanedSearch" ]);

Route::match(['get','post'],'/booking', [ "as" =>"booking", 'uses' => "BookingController@index", 'middleware' => ['auth']]);

Route::match(['get','post'],'/booking/online-payment', [ "as" =>"onlinepayment", 'uses' => "BookingController@onlinePayment", 'middleware' => ['auth']]);

Route::get('get-state-list','BookingController@getStateList');

Route::match(['post'],'/makePayment', [ "as" =>"makePayment", 'uses' => "BookingController@makePayment", 'middleware' => ['auth']]);

Route::match(['post'],'/sendinquery', [ "as" =>"sendinquery", 'uses' => "InqueryController@store"]);

Route::match(['get','post'],'/payment_success/{id}/{itinerary_id}/{payment_mode}/{participant}/{order_status}', [ "as" =>"successPayment", 'uses' => "BookingController@paymentSuccess"]);

Route::match(['get','post'],'/payment_failed/{id}/{itinerary_id}/{payment_mode}', [ "as" =>"failedPayment", 'uses' => "BookingController@paymentFailed"]);

Route::match(['get','post'],'/booking-history', [ "as" =>"bookingHistory", 'middleware' => ['auth'],'uses' => "BookingHistoryController@index"]);

Route::match(['get','post'],'/booking-details/{order_id}', [ "as" =>"bookingDetails", 'middleware' => ['auth'],'uses' => "BookingHistoryController@bookingDetails"]);

Route::match(['post'],'/direct-payment', [ "as" =>"directPayment", 'middleware' => ['auth'],'uses' => "BookingController@storeDirectPayment"]);

Route::match(['get','post'],'/complete-payment/{order_id}', [ "as" =>"completePayment", 'middleware' => ['auth'],'uses' => "BookingController@completePayment"]);

Route::match(['post'],'/cancelorder/{order_id}', [ "as" =>"cancelOrder", 'middleware' => ['auth'],'uses' => "BookingController@cancelOrder"]);

Route::match(['get','post'],'/transection-history', [ "as" =>"transectionsHistory", 'middleware' => ['auth'],'uses' => "BookingHistoryController@transectionHistory"]);

Route::match(['get','post'],'/blogs', [ "as" =>"blogs", 'uses' => "BlogsController@index"]);

Route::match(['get','post'],'/blogs/{slug}', [ "as" =>"singleblogs", 'uses' => "BlogsController@blogDetails"]);

Route::match(['get','post'],'/about-us', [ "as" =>"aboutUs", 'uses' => "AboutUsController@index"]);

Route::match(['get','post'],'/our-team', [ "as" =>"ourTeam", 'uses' => "OurTeamController@index"]);

Route::match(['get','post'],'/privacy-policy', [ "as" =>"PrivacyPolicy", 'uses' => "PrivacyPolicyController@index"]);

Route::match(['get','post'],'/testimonials', [ "as" =>"testimonials", 'uses' => "TestimonialController@index"]);

Route::match(['get','post'],'/terms-and-conditions', [ "as" =>"termsConditions", 'uses' => "TermsConditions@index"]);

Route::match(['get','post'],'/modification-of-prices', [ "as" =>"modificationOfPrices", 'uses' => "ModificationOfPricesController@index"]);

Route::match(['get','post'],'/payment-methods', [ "as" =>"PaymentMethods", 'uses' => "PaymentMethodsController@index"]);

Route::match(['get','post'],'/contact-us', [ "as" =>"ContactUs", 'uses' => "ContactUsController@index"]);

Route::match(['get','post'],'/contact-us/store', [ "as" =>"ContactUs.store", 'uses' => "ContactUsController@store"]);

Route::match(['get','post'],'/payment-success/{payment_mode}/{order_status}', [ "as" =>"successDirectPayment", 'uses' => "BookingController@directPaymentSuccess"]);

Route::match(['get','post'],'/payment-failed/{payment_mode}', [ "as" =>"failedDirectPayment", 'uses' => "BookingController@directPaymentFailed"]);

Route::match(['get','post'],'/auto-search', [ "as" =>"auto-search", 'uses' => "HomeController@autoSearchData" ]);
