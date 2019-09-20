<?php

namespace App\Http\Controllers\Admin;

use App\model\Setting;
use App\Http\Controllers\Controller;

class Settings extends Controller
{
    //

	public function setting()
	{
		return view('admin.settings',['title'=>trans('admins.settings')]);
	}

	public function settings_save()
	{
		$data=$this->validate(\request(),[
			'logo'=>v_image(),
			'icon'=>v_image()
		],[],[
			'logo'=>'Logo',
			'icon'=>'Icon'
		]);

		if(\request()->hasFile('logo'))
		{
//			!empty(\setting()->logo)?Storage::delete(\setting()->logo):'';
//			$data['logo']=\request()->file('logo')->store('public/settings');
			$data['logo']=up()->upload([
				'file'=>'logo',
				'path'=>'settings',
				'upload_type'=>'single',
				'deleted_file'=>\setting()->logo,
			]);
		}

		if(\request()->hasFile('icon'))
		{
			$data['icon']=up()->upload([
				'file'=>'icon',
				'path'=>'settings',
				'upload_type'=>'single',
				'deleted_file'=>\setting()->icon,
			]);
		}

		Setting::orderBy('id','desc')->update($data);

		session()->flash('success',trans('admin.updated_record'));

		return redirect(aurl('settings'));
	}
}
