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

		//Route admin datatable
		Route::resource('admin','AdminController');
		//Route admin destroy all
		Route::delete('admin/destroy/all','AdminController@multi_delete');

		//Route users datatable
		Route::resource('users','UsersController');
		//Route users destroy all
		Route::delete('users/destroy/all','UsersController@multi_delete');

		//Route countries datatable
		Route::resource('countries','CountriesController');
		//Route countries destroy all
		Route::delete('countries/destroy/all','CountriesController@multi_delete');

		//Route countries datatable
		Route::resource('cities','CitiesController');
		//Route countries destroy all
		Route::delete('cities/destroy/all','CitiesController@multi_delete');

		//Route countries datatable
		Route::resource('states','StatesController');
		//Route countries destroy all
		Route::delete('states/destroy/all','StatesController@multi_delete');

		//Route deps datatable
		Route::resource('departments','DepartmentsController');

		//Route trademarks datatable
		Route::resource('trademarks','TradeMarkController');
		//Route trademarks destroy all
		Route::delete('trademarks/destroy/all','TradeMarkController@multi_delete');

		//Route manufacts datatable
		Route::resource('manufacts','ManufactController');
		//Route countries destroy all
		Route::delete('manufacts/destroy/all','ManufactController@multi_delete');

		//Settings
		Route::get('settings','Settings@setting');
		Route::post('settings','Settings@settings_save');

	});

	//login
	Route::get('login','AdminAuth@login');
	Route::post('login','AdminAuth@dologin');

	//reset password
	Route::get('forget/password','AdminAuth@forget_password');
	Route::post('forget/password','AdminAuth@forget_password_post');
	Route::get('reset/password/{token}','AdminAuth@reset_password');
	Route::post('reset/password/{token}','AdminAuth@reset_password_post');

	//datatable
//	Route::get('datatable/lang',function ()
//	{
//		$langJson=[
//			'sProcessing'=>trans('admin.sProcessing'),
//			'sLengthMenu'=>trans('admin.sLengthMenu'),
//			'sZeroRecords'=>trans('admin.sZeroRecords'),
//			'sEmptyTable'=>trans('admin.sEmptyTable'),
//			'sInfo'=>trans('admin.sInfo'),
//			'sInfoEmpty'=>trans('admin.sInfoEmpty'),
//			'sInfoFiltered'=>trans('admin.sInfoFiltered'),
//			'sInfoPostFix'=>trans('admin.sInfoPostFix'),
//			'sSearch'=>trans('admin.sSearch'),
//			'sUrl'=>trans('admin.sUrl'),
//			'sInfoThousands'=>trans('admin.sInfoThousands'),
//			'sLoadingRecords'=>trans('admin.sLoadingRecords'),
//			'oPaginate'=>[
//				'sFirst'=>trans('admin.sFirst'),
//				'sLast'=>trans('admin.sLast'),
//				'sNext'=>trans('admin.sNext'),
//				'sPrevious'=>trans('admin.sPrevious'),
//			],
//			'oAria'=>[
//				'sSortAscending'=>trans('admin.sSortAscending'),
//				'sSortDescending'=>trans('admin.sSortDescending'),
//			],
//
//		];
//
//		return response()->json($langJson);
//	});

    //Language
    Route::get('lang/{lang}',function ($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang=='ar'?session()->put('lang','ar'):session()->put('lang','en');
        return back();
    });

});