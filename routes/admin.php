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

	Route::get('login','AdminAuth@login');
	Route::post('login','AdminAuth@dologin');
	Route::get('forget/password','AdminAuth@forget_password');
	Route::post('forget/password','AdminAuth@forget_password_post');

});