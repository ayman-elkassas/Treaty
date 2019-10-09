<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MallsDataTable;
use App\model\malls;
use App\model\Manufacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use Illuminate\Support\Facades\Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDataTable $malls)
    {
        //
	    return $malls->render('admin.malls.index',['title'=>'Malls Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.malls.create',['title'=>'Add Malls']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
	    $data=$this->validate($request,[
	    	'name_en'=>'required',
	    	'name_ar'=>'required',
	    	'country_id'=>'required',
	    	'email'=>'required|email',
	    	'mobile'=>'required|numeric',
	    	'facebook'=>'sometimes|nullable|url',
	    	'twitter'=>'sometimes|nullable|url',
	    	'website'=>'sometimes|nullable|url',
	    	'contact_name'=>'sometimes|nullable|string',
	    	'lat'=>'sometimes|nullable',
	    	'lng'=>'sometimes|nullable',
	    	'logo'=>'sometimes|nullable|'.v_image(),
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
		    'country_id'=>'Country Name',
		    'email'=>'Email',
		    'mobile'=>'Mobile',
		    'facebook'=>'Facebook link',
		    'twitter'=>'Twitter link',
		    'website'=>'Website link',
		    'contact_name'=>'Contact name',
		    'lat'=>'Lat',
		    'lng'=>'Lang',
		    'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'malls',
			    'upload_type'=>'single',
		    ]);
	    }

	    Malls::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('malls'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
	    $malls=Malls::find($id);
	    $title=trans('admin.edit');

	    return view('admin.malls.edit',compact('malls','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
	    $data=$this->validate($request,[
		    'name_en'=>'required',
		    'name_ar'=>'required',
		    'country_id'=>'required',
		    'email'=>'required|email',
		    'mobile'=>'required|numeric',
		    'facebook'=>'sometimes|nullable|url',
		    'twitter'=>'sometimes|nullable|url',
		    'website'=>'sometimes|nullable|url',
		    'contact_name'=>'sometimes|nullable|string',
		    'lat'=>'sometimes|nullable',
		    'lng'=>'sometimes|nullable',
		    'logo'=>'sometimes|nullable|'.v_image(),
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
		    'country_id'=>'Country Name',
		    'email'=>'Email',
		    'mobile'=>'Mobile',
		    'facebook'=>'Facebook link',
		    'twitter'=>'Twitter link',
		    'website'=>'Website link',
		    'contact_name'=>'Contact name',
		    'lat'=>'Lat',
		    'lng'=>'Lang',
		    'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'malls',
			    'deleted_file'=>malls::find($id)->logo,
			    'upload_type'=>'single',
		    ]);
	    }

//	    return dd(\request('logo'));

	    malls::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('malls'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	    $malls=malls::find($id);

	    Storage::delete($malls->logo);
	    $malls->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('malls'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $malls=malls::find($id);
			    Storage::delete($malls->logo);
			    $malls->delete();
	    	}
	    }
    	else{
		    $malls=malls::find(\request('item'));
		    Storage::delete($malls->logo);
		    $malls->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('malls'));
    }
}
