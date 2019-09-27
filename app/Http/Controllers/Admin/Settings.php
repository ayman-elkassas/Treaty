<?php

namespace App\Http\Controllers\Admin;

use App\model\Setting;
use App\Http\Controllers\Controller;

class Settings extends Controller
{
    //

	public function setting()
	{
		return view('admin.settings',['title'=>trans('admin.settings')]);
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

		$data=\request()->except('_token');

		if(\request()->hasFile('logo'))
		{
//			!empty(\setting()->logo)?Storage::delete(\setting()->logo):'';
//			$data['logo']=\request()->file('logo')->store('public/settings');
			$data['logo']=up()->upload([
				'file'=>'logo',
				'path'=>'settings',
				'deleted_file'=>\setting()->logo,
				'upload_type'=>'single',
			]);
		}

		if(\request()->hasFile('icon'))
		{
			$data['icon']=up()->upload([
				'file'=>'icon',
				'path'=>'settings',
				'deleted_file'=>\setting()->icon,
				'upload_type'=>'single',
			]);
		}

		Setting::orderBy('id','desc')->update($data);

		session()->flash('success',trans('admin.updated_record'));

		return redirect(aurl('settings'));
	}
}
