<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Upload extends Controller
{

	/*$file,$path,$uplaod_type='single',$delete_file=null,$new_name=null,$crud_type=[]*/

	public function upload($data=[])
	{
		if(in_array('new_name',$data))
		{
			$new_name=($data['new_name']===null?time():$data['new_name']);
		}

		if(\request()->hasFile($data['file']) and $data['upload_type']=='single')
		{
			!empty($data['deleted_file'] ) ? Storage::delete($data['deleted_file']) : '';
			return \request()->file($data['file'])->store('public/'.$data['path']);
		}
	}
}
