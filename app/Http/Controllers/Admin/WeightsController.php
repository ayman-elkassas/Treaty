<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\weightsDataTable;
use App\model\Weight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use Illuminate\Support\Facades\Storage;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightsDataTable $weight)
    {
        //
	    return $weight->render('admin.weights.index',['title'=>'weights Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.weights.create',['title'=>'Add Weight']);
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
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
	    ]);

	    Weight::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('weights'));
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
	    $weight=Weight::find($id);
	    $title=trans('admin.edit');

	    return view('admin.weights.edit',compact('weight','title'));
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
        ],[],[
            'name_en'=>'Name En',
            'name_ar'=>'Name Ar',
        ]);

//	    return dd(\request('logo'));

	    Weight::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('weights'));
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
	    $Weight=Weight::find($id);

	    Storage::delete($Weight->logo);
        $Weight->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('weights'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $weights=Weight::find($id);
                $weights->delete();
	    	}
	    }
    	else{
            $weights=Weight::find(\request('item'));
            $weights->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('weights'));
    }
}
