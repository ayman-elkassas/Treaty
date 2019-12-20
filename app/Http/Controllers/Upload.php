<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\File;

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
			!empty($data['deleted_file']) ? Storage::delete($data['deleted_file']) : '';
			return \request()->file($data['file'])->store('public/'.$data['path']);

		}elseif (\request()->hasFile($data['file']) and $data['upload_type']=='files')
        {
            $file= \request()->file($data['file']);

            $size=$file->getSize();
            $mime_type=$file->getMimeType();
            $name=$file->getClientOriginalName();
            $hashname=$file->hashName();


            $add=File::create([
                'name'=>$name,
                'size'=>$size,
                'file'=>$hashname,
                'path'=>$data['file'],
                'full_file'=>$data['path'].'/'.$hashname,
                'mime_type'=>$mime_type,
                'file_type'=>$data['file_type'],
                'relation_id'=>$data['relation_id']
            ]);

            return $data['path'].$hashname;
        }
	}

	public function delete($id)
    {
        $file=File::find($id);
        if(!empty($file))
        {
            Storage::delete($file->full_file);
            $file->delete();
        }
    }
}
