<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminResetPassword;
use Carbon\Carbon;
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

//        return dd(admin()->attempt(['email'=>\request('email'),
//            'password'=>\request('password')],$rememberme));

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

			DB::table('password_resets')->insert([
				'email'=>$admin->email,
				'token'=>$token,
				'created_at'=>Carbon::now()
			]);

			Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
			session()->flash('success',trans('admin.the_link_reset_sent'));
		}

		return back();
	}

	public function reset_password($token)
	{
		// data > for make sure generating reset token Never pass them 2 hours
		$check_token=DB::table('password_resets')->where('token',$token)
			->where('created_at','>',Carbon::now()->subHours(2))->first();

		if(!empty($check_token))
		{
			return view('admin.reset_password',['data'=>$check_token]);
		}
		else{
			return redirect(aurl('forget/password'));
		}
	}

	public function reset_password_post($token)
	{
//		return dd(\request());
		//'required|confirmed' confirmed for make matching with confirmed_password
		$this->validate(\request(),[
			'password'=>'required',
			'confirm_password'=>'required'
		],[],[
			'password'=>'Password',
			'confirm_password'=>'Confirmation Password'
		]);

		//check from reset pass token
		$check_token=DB::table('password_resets')->where('token',$token)
			->where('created_at','>',Carbon::now()->subHours(2))->first();

		if(!empty($check_token))
		{
			\App\Admin::where('email',$check_token->email)
				->update(['email'=>$check_token->email,
					'password'=>bcrypt(\request('password'))]);

			DB::table('password_resets')->where('email',\request('email'))->delete();

			//make login and redirect admin account
			admin()->attempt(['email'=>\request('email'),
				'password'=>\request('password')],true);

			//redirect on dashboard main page
			return redirect(aurl());
		}
		else
		{
			return redirect(aurl('forget/password'));
		}
	}
}
