<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StatesDataTable;
use App\model\City;
use App\model\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDataTable $state)
    {
        //
	    return $state->render('admin.states.index',['title'=>'State Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    if(\request()->ajax())
	    {
	    	if(\request()->has('country_id'))
		    {
		    	$select=\request()->has('select')?\request('select'):'';
		    	return \Form::select('city_id',City::where('country_id',\request('country_id'))->pluck('city_name_en','id')
				    ,$select, ['class'=>'form-control','placeholder'=>'.....']);
		    }
	    }
	    return view('admin.states.create',['title'=>'Add State']);
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
	    	'state_name_en'=>'required',
	    	'state_name_ar'=>'required',
		    'country_id'=>'required|numeric',
		    'city_id'=>'required|numeric'
	    ],[],[
	    	'state_name_en'=>'State name Arabic',
	    	'state_name_ar'=>'State name Arabic',
	    	'country_id'=>'Country Upon',
		    'city_id'=>'City Upon'
	    ]);

	    State::create($data);

	    session()->flash('success',trans('admin.record_added'));

	    return redirect(aurl('states'));

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
	    $state=State::find($id);
	    $title=trans('admin.edit');

	    return view('admin.states.edit',compact('state','title'));
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
		    'state_name_en'=>'required',
		    'state_name_ar'=>'required',
		    'country_id'=>'required|numeric',
		    'city_id'=>'required|numeric'
	    ],[],[
		    'state_name_en'=>'State name Arabic',
		    'state_name_ar'=>'State name Arabic',
		    'country_id'=>'Country Upon',
		    'city_id'=>'City Upon'
	    ]);

	    State::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('states'));
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
	    State::find($id)->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('states'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    State::find($id)->delete();
		    }
	    }
    	else{
		    State::find(\request('item'))->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('states'));
    }
}
