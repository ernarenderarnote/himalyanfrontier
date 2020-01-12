<?php

Route::get('/','HomeController@Index')->name('home');

Route::group([ 'prefix' => 'activity', "as" => "activity."],function()
{  
    Route::get('/{slug}', [ "as" =>"slug", 'uses' => "HomeController@activity" ]);
}); 

Route::match(['get','post'],'/advanced-search', [ "as" =>"advanced-search", 'uses' => "HomeController@advanedSearch" ]);

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

    Route::delete('destinations/destroy', 'DestinationsController@massDestroy')->name('destinations.massDestroy');
    
    Route::resource('destinations', 'DestinationsController');
    
    Route::delete('activities/destroy', 'ActivitiesController@massDestroy')->name('activities.massDestroy');
    
    Route::resource('activities', 'ActivitiesController');
});
Route::match(['get','post'],'/profile', [ 'as' => 'profile', "uses" => "ProfileController@index"] );
