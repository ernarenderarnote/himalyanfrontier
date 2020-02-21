<?php

Route::get('/','HomeController@Index')->name('home');

Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

//adminlogin
Route::match(['get'],'/administrator', [ "as" =>"admin", 'uses' => "Auth\LoginController@adminLogin" ]);
Route::group([ 'prefix' => 'auth', "as" => "auth." , "namespace" => "Auth"],function()
{  
    Route::post('/login', [ "as" =>"login", 'uses' => "LoginController@login" ]);
    Route::match(['get','post'],'/login/otp', [ "as" =>"login.otp", 'uses' => "LoginController@loginotp" ]);
    Route::match(['get'],'/login/resendotp', [ "as" =>"login.resendotp", 'uses' => "LoginController@resendOtp" ]);
    Route::match(['post'],'/admin', [ "as" =>"admin", 'uses' => "LoginController@admin" ]);
});   
//Auth::routes();
Auth::routes(['register' => false]);

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

    Route::match(['get','post'],'/inqueries', [ 'as' => 'inqueries', "uses" => "InqueriesController@index"] );

    Route::match(['get','post'],'/payment_settings', [ 'as' => 'paymentSettings', "uses" => "PaymentSettingsController@index"] );

    Route::match(['get','post'],'/payment_settings/store', [ 'as' => 'paymentSettings.store', "uses" => "PaymentSettingsController@store"] );
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

Route::match(['post'],'/makePayment', [ "as" =>"makePayment", 'uses' => "BookingController@makePayment", 'middleware' => ['auth']]);

Route::match(['post'],'/sendinquery', [ "as" =>"sendinquery", 'uses' => "InqueryController@store"]);

Route::match(['get','post'],'/payment_success/{id}/{itinerary_id}/{payment_mode}/{participant}/{order_status}', [ "as" =>"successPayment", 'uses' => "BookingController@paymentSuccess"]);

Route::match(['get','post'],'/payment_failed/{id}/{itinerary_id}/{payment_mode}', [ "as" =>"failedPayment", 'uses' => "BookingController@paymentFailed"]);

Route::match(['get','post'],'/booking_history', [ "as" =>"bookingHistory", 'middleware' => ['auth'],'uses' => "BookingHistoryController@index"]);

Route::match(['get','post'],'/booking_details/{order_id}', [ "as" =>"bookingDetails", 'middleware' => ['auth'],'uses' => "BookingHistoryController@bookingDetails"]);

Route::match(['get','post'],'/complete_payment/{order_id}', [ "as" =>"completePayment", 'middleware' => ['auth'],'uses' => "BookingController@completePayment"]);

Route::match(['get','post'],'/transection_history', [ "as" =>"transectionsHistory", 'middleware' => ['auth'],'uses' => "BookingHistoryController@transectionHistory"]);

Route::match(['get','post'],'/blogs', [ "as" =>"blogs", 'uses' => "BlogsController@index"]);

Route::match(['get','post'],'/blogs/{slug}', [ "as" =>"singleblogs", 'uses' => "BlogsController@blogDetails"]);

Route::match(['get','post'],'/about_us', [ "as" =>"aboutUs", 'uses' => "AboutUsController@index"]);

Route::match(['get','post'],'/our_team', [ "as" =>"ourTeam", 'uses' => "OurTeamController@index"]);

Route::match(['get','post'],'/privacy_policy', [ "as" =>"PrivacyPolicy", 'uses' => "PrivacyPolicyController@index"]);