<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManufactsDataTable;
use App\model\Manufacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use Illuminate\Support\Facades\Storage;

class ManufactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufactsDataTable $manufacts)
    {
        //
	    return $manufacts->render('admin.manufacts.index',['title'=>'Manufacts Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.manufacts.create',['title'=>'Add Manufacts']);
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
			    'path'=>'manufacts',
			    'upload_type'=>'single',
		    ]);
	    }

	    Manufacts::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('manufacts'));
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
	    $manufacts=Manufacts::find($id);
	    $title=trans('admin.edit');

	    return view('admin.manufacts.edit',compact('manufacts','title'));
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
			    'path'=>'settings',
			    'deleted_file'=>Manufacts::find($id)->logo,
			    'upload_type'=>'single',
		    ]);
	    }

//	    return dd(\request('logo'));

	    Manufacts::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('manufacts'));
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
	    $manufacts=Manufacts::find($id);

	    Storage::delete($manufacts->logo);
	    $manufacts->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('manufacts'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $manufacts=Manufacts::find($id);
			    Storage::delete($manufacts->logo);
			    $manufacts->delete();
	    	}
	    }
    	else{
		    $manufacts=Manufacts::find(\request('item'));
		    Storage::delete($manufacts->logo);
		    $manufacts->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('manufacts'));
    }
}
