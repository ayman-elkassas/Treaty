<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\admin;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller
{
    //
	public function login()
	{
		return view('admin.login');
	}

	public function dologin()
	{
		$rememberme=\request('rememberme') == 1 ? true:false;
		if(admin()->attempt(['email'=>\request('email'),
			'password'=>\request('password')],$rememberme))
		{
			return redirect('admin');
		}
		else
		{
			session()->flash('error',trans('admin.incorrect_info_login'));
			return back();
		}
	}
	public function logout()
	{
		auth()->guard('admin')->logout();
		return redirect(aurl('login'));
	}

	public function forget_password()
	{
		return view('admin.forget');
	}

	public function forget_password_post()
	{
		$admin=\App\Admin::where('email',\request('email'))->first();

		if(!empty($admin))
		{
			$token=app('auth.password.broker')->createToken($admin);

			$data=DB::table('password_resets')->insert([
				'email'=>$admin->email,
				'token'=>$token,
				'created_at'=>Carbon::now()
			]);

			Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
			session()->flash('success',trans('admin.the_link_reset_sent'));
		}

		return back();
	}
}
