<?php
//for singleton creation for aurl function
if(!function_exists('aurl'))
{
	function aurl($url=null)
	{
		return url('admin/'.$url);
	}
}

if(!function_exists('admin'))
{
	function admin()
	{
		return auth()->guard('admin');
	}
}

if(!function_exists('lang'))
{
    function lang(){
        if(session()->has('lang'))
        {
            return session('lang');
        }
        else
        {
            return setting()->main_lang;
        }
    }
}

if(!function_exists('direction'))
{
    function direction(){
        if(session()->has('lang'))
        {
            if(session('lang')=='ar') return 'rlt';
            else return 'ltr';
        }
        else
        {
            return 'ltr';
        }
    }
}

if(!function_exists('active_menu'))
{
	function active_menu($link)
	{
		if(preg_match('/'.$link.'/i',Request::segment(2)))
		{
			return ['menu-open','display:block'];
		}
		else
		{
			return ['',''];
		}
	}
}

//settings
if(!function_exists('setting'))
{
	function setting()
	{
		return \App\model\Setting::orderBy('id','desc')->first();
	}
}

//validation helper function///
if(!function_exists('v_image'))
{
	function v_image($ext=null)
	{
		if($ext===null)
		{
			return 'image|mimes:jpg,jpeg,png,gif,bmp';
		}
		else
		{
			return 'image|mimes:'.$ext;
		}
	}
}

//Upload instance
if(!function_exists('up'))
{
	function up()
	{
		return new \App\Http\Controllers\Upload();
	}

}