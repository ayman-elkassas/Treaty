<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ColorsDataTable;
use App\model\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use Illuminate\Support\Facades\Storage;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorsDataTable $colors)
    {
        //
	    return $colors->render('admin.colors.index',['title'=>'Colors Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.colors.create',['title'=>'Add Color']);
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
	    	'color'=>'required|string',
	    ],[],[
		    'name_en'=>'Name En',
		    'name_ar'=>'Name Ar',
		    'color'=>'Color',
	    ]);

	    Color::create($data);

	    session()->flash('success',trans('admin.record_added'));
	    return redirect(aurl('colors'));
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
	    $color=Color::find($id);
	    $title=trans('admin.edit');

	    return view('admin.colors.edit',compact('color','title'));
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
            'color'=>'required|string',
        ],[],[
            'name_en'=>'Name En',
            'name_ar'=>'Name Ar',
            'color'=>'Color',
        ]);

//	    return dd(\request('logo'));

	    Color::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('colors'));
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
	    $color=Color::find($id);

	    Storage::delete($color->logo);
        $color->delete();

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('colors'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
		    foreach (\request('item') as $id) {
			    $colors=Color::find($id);
                $colors->delete();
	    	}
	    }
    	else{
            $colors=Color::find(\request('item'));
            $colors->delete();
	    }

    	session()->flash('success',trans('admin.deleted_record'));
    	return redirect(aurl('colors'));
    }
}
