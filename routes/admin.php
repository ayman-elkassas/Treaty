<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function()
{

	//middleware (name of middleware : your guard)
	Route::group(['middleware'=>'admin:admin'],function()
	{
		Route::get('/',function (){
			return view('admin.home');
		});

		Route::any('logout','AdminAuth@logout');
	});

	//login
	Route::get('login','AdminAuth@login');
	Route::post('login','AdminAuth@dologin');

	//reset password
	Route::get('forget/password','AdminAuth@forget_password');
	Route::post('forget/password','AdminAuth@forget_password_post');
	Route::get('reset/password/{token}','AdminAuth@reset_password');
	Route::post('reset/password/{token}','AdminAuth@reset_password_post');

});