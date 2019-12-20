<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\model\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use App\DataTables\CountriesDataTable;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTable $country)
    {
        //
	    return $country->render('admin.countries.index',['title'=>'Countries Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.countries.create',['title'=>'Add Country']);
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
	    	'country_name_en'=>'required',
	    	'country_name_ar'=>'required',
	    	'mob'=>'required',
	    	'code'=>'required',
	    	'currency'=>'required',
	    	'logo'=>'required|'.v_image(),
	    ],[],[
	    	'country_name_en'=>'Country name Arabic',
	    	'country_name_ar'=>'Country name Arabic',
	    	'mob'=>'Mob',
	    	'code'=>'Code',
	    	'currency'=>'Currency',
	    	'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'settings',
			    'upload_type'=>'single',
                'delete_file'=>''
		    ]);
	    }

	    Country::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('countries'));
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
	    $country=Country::find($id);
	    $title=trans('admin.edit');

	    return view('admin.countries.edit',compact('country','title'));
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
		    'country_name_en'=>'required',
		    'country_name_ar'=>'required',
		    'mob'=>'required',
		    'code'=>'required',
		    'logo'=>'required',
	    ],[],[
		    'country_name_en'=>'Country name Arabic',
		    'country_name_ar'=>'Country name Arabic',
		    'mob'=>'Mob',
		    'code'=>'Code',
		    'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'settings',
			    'deleted_file'=>Country::find($id)->logo,
			    'upload_type'=>'single',
		    ]);
	    }

//	    return dd(\request('logo'));

	    Country::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('countries'));
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
	    $countries=Country::find($id);

	    Storage::delete($countries->logo);
	    $countries->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('countries'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $countries=Country::find($id);
			    Storage::delete($countries->logo);
			    $countries->delete();
	    	}
	    }
    	else{
		    $countries=Country::find(\request('item'));
		    Storage::delete($countries->logo);
		    $countries->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('countries'));
    }
}
