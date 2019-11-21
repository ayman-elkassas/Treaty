<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SizesDataTable;
use App\model\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use Illuminate\Support\Facades\Storage;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizesDataTable $sizes)
    {
        //
	    return $sizes->render('admin.sizes.index',['title'=>'Size Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.sizes.create',['title'=>'Add Size']);
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
	    	'is_public'=>'required|in:yes,no',
	    	'dept_id'=>'required|string',
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
		    'is_public'=>'Is Public',
		    'Size'=>'Size',
	    ]);

	    Size::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('sizes'));
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
	    $size=Size::find($id);
	    $title=trans('admin.edit');

	    return view('admin.sizes.edit',compact('size','title'));
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
            'is_public'=>'required|in:yes,no',
            'dept_id'=>'required|string',
        ],[],[
            'name_en'=>'Name En',
            'name_ar'=>'Name Ar',
            'is_public'=>'Is Public',
            'Size'=>'Size',
        ]);

//	    return dd(\request('logo'));

	    Size::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('sizes'));
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
        $size=Size::find($id);

        $size->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('sizes'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $sizes=Size::find($id);
                $sizes->delete();
	    	}
	    }
    	else{
            $sizes=Size::find(\request('item'));
            $sizes->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('sizes'));
    }
}
