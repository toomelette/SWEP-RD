<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});




/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {


	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');


	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


	/** MENU **/
	Route::resource('menu', 'MenuController');


	/** SUGAR ORDER OF PAYMENT **/
	Route::resource('sugar_order_of_payment', 'SugarOrderOfPaymentController');
	Route::get('/sugar_order_of_payment/print/{slug}', 'SugarOrderOfPaymentController@print')->name('sugar_order_of_payment.print');


	/** SUGAR ANALYSIS **/
	Route::get('/sugar_analysis/report', 'SugarAnalysisController@report')->name('sugar_analysis.report');
	Route::get('/sugar_analysis/report_generate', 'SugarAnalysisController@report_generate')->name('sugar_analysis.report_generate');
	Route::get('/sugar_analysis', 'SugarAnalysisController@index')->name('sugar_analysis.index');
	Route::get('/sugar_analysis/{slug}/edit', 'SugarAnalysisController@edit')->name('sugar_analysis.edit');
	Route::put('/sugar_analysis/update/{slug}', 'SugarAnalysisController@update')->name('sugar_analysis.update');
	Route::get('/sugar_analysis/{slug}', 'SugarAnalysisController@show')->name('sugar_analysis.show');
	Route::get('/sugar_analysis/print/{slug}', 'SugarAnalysisController@print')->name('sugar_analysis.print');


	/** MILLS **/
	Route::resource('mill', 'MillController');


	/** SUGAR LABORATORY SERVICES **/
	Route::resource('sugar_service', 'SugarServiceController');


	/** SUGAR SAMPLES **/
	Route::resource('sugar_sample', 'SugarSampleController');


	/** CANE JUICE ANALYSIS **/
	Route::resource('cane_juice_analysis', 'CaneJuiceAnalysisController');


	
});






/** Testing **/
Route::get('/dashboard/test', function(){

	return dd(Illuminate\Support\Str::random(16));
	//dd(__dataType::num_to_words(1023.127));

});

