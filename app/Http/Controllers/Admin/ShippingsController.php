<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ShippingsDataTable;
use App\model\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use Illuminate\Support\Facades\Storage;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingsDataTable $shippings)
    {
        //
	    return $shippings->render('admin.shippings.index',['title'=>'Shippings Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.shippings.create',['title'=>'Add Shippings']);
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
	    	'user_id'=>'required',
	    	'lat'=>'sometimes|nullable',
	    	'lng'=>'sometimes|nullable',
	    	'logo'=>'sometimes|nullable|'.v_image(),
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
		    'user_id'=>'User Name',
		    'lat'=>'Lat',
		    'lng'=>'Lang',
		    'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'shippings',
			    'upload_type'=>'single',
		    ]);
	    }

	    Shipping::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('shippings'));
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
	    $shippings=Shipping::find($id);
	    $title=trans('admin.edit');

	    return view('admin.shippings.edit',compact('shippings','title'));
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
		    'user_id'=>'required',
		    'lat'=>'sometimes|nullable',
		    'lng'=>'sometimes|nullable',
		    'logo'=>'sometimes|nullable|'.v_image(),
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
		    'user_id'=>'User Name',
		    'lat'=>'Lat',
		    'lng'=>'Lang',
		    'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'shippings',
			    'deleted_file'=>Shipping::find($id)->logo,
			    'upload_type'=>'single',
		    ]);
	    }

//	    return dd(\request('logo'));

	    Shipping::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('shippings'));
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
	    $shippings=Shipping::find($id);

	    Storage::delete($shippings->logo);
	    $shippings->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('shippings'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $shippings=Shipping::find($id);
			    Storage::delete($shippings->logo);
			    $shippings->delete();
	    	}
	    }
    	else{
		    $shippings=Shipping::find(\request('item'));
		    Storage::delete($shippings->logo);
		    $shippings->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('$shippings'));
    }
}
