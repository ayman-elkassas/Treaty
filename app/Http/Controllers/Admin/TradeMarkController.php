<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\model\Country;
use App\model\TradeMark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use App\DataTables\TradeMarkDataTable;
use Illuminate\Support\Facades\Storage;

class TradeMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarkDataTable $tradeMark)
    {
        //
	    return $tradeMark->render('admin.trademarks.index',['title'=>'Trademark Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.trademarks.create',['title'=>'Add Trademark']);
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
	    	'logo'=>'required|'.v_image(),
	    ],[],[
	    	'name_en'=>'Trademark name En',
	    	'country_name_ar'=>'Trademark name Ar',
	    	'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'trademarks',
			    'upload_type'=>'single',
		    ]);
	    }

	    TradeMark::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('trademarks'));
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
	    $trademark=TradeMark::find($id);
	    $title=trans('admin.edit');

	    return view('admin.trademarks.edit',compact('trademark','title'));
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
		    'logo'=>'required|'.v_image(),
	    ],[],[
		    'name_en'=>'Trademark name En',
		    'country_name_ar'=>'Trademark name Ar',
		    'logo'=>'Logo',
	    ]);

	    if(\request()->hasFile('logo'))
	    {
		    $data['logo']=up()->upload([
			    'file'=>'logo',
			    'path'=>'settings',
			    'deleted_file'=>TradeMark::find($id)->logo,
			    'upload_type'=>'single',
		    ]);
	    }

//	    return dd(\request('logo'));

	    TradeMark::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('trademarks'));
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
	    $trademarks=TradeMark::find($id);

	    Storage::delete($trademarks->logo);
	    $trademarks->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('trademarks'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $trademarks=TradeMark::find($id);
			    Storage::delete($trademarks->logo);
			    $trademarks->delete();
	    	}
	    }
    	else{
		    $trademarks=TradeMark::find(\request('item'));
		    Storage::delete($trademarks->logo);
		    $trademarks->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('trademarks'));
    }
}
