<?php

namespace App\Http\Controllers\Admin;

use App\model\Country;
use App\model\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return view('admin.departments.index',['title'=>'List Departments']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.departments.create',['title'=>'Add Department']);
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
	    	'dep_name_en'=>'required',
	    	'dep_name_ar'=>'required',
		    'parent_id'=>'sometimes|nullable|numeric',
		    'icon'=>'sometimes|nullable|'.v_image(),
		    'description'=>'sometimes|nullable',
		    'keyword'=>'sometimes|nullable'
	    ],[],[
	    	'dep_name_en'=>'Department name Arabic',
	    	'dep_name_ar'=>'Department name Arabic',
	    	'parent_id'=>'Department Upon',
	    	'icon'=>'Icon',
	    	'description'=>'Description',
	    	'keyword'=>'Keyword',
	    ]);

	    if(\request()->hasFile('icon'))
	    {
		    $data['icon']=up()->upload([
			    'file'=>'icon',
			    'path'=>'departments',
			    'deleted_file'=>'',
			    'upload_type'=>'single',
		    ]);
	    }

	    Department::create($data);

	    session()->flash('success',trans('admin.record_added'));

	    return redirect(aurl('departments'));

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
	    $dep=Department::find($id);
	    $title=trans('admin.edit');

	    return view('admin.departments.edit',compact('dep','title'));
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
		    'dep_name_en'=>'required',
		    'dep_name_ar'=>'required',
		    'parent_id'=>'sometimes|nullable|numeric',
		    'icon'=>'sometimes|nullable|'.v_image(),
		    'description'=>'sometimes|nullable',
		    'keyword'=>'sometimes|nullable'
	    ],[],[
		    'dep_name_en'=>'Department name Arabic',
		    'dep_name_ar'=>'Department name Arabic',
		    'parent_id'=>'Department Upon',
		    'icon'=>'Icon',
		    'description'=>'Description',
		    'keyword'=>'Keyword',
	    ]);

	    if(\request()->hasFile('icon'))
	    {
		    $data['icon']=up()->upload([
			    'file'=>'icon',
			    'path'=>'departments',
			    'deleted_file'=>Department::find($id)->icon,
			    'upload_type'=>'single',
		    ]);
	    }

	    Department::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));
	    return redirect(aurl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	//call recursion method
	    self::delete_parent($id);

	    session()->flash('success',trans('admin.deleted_record'));
	    return redirect(aurl('departments'));
    }

    //recursion method for delete node and their child node
    public function delete_parent($id)
    {
    	//get all deps that parent_id equal to $id of parent
    	$dep_parent=Department::where('parent_id',$id)->get();

    	if(!empty($dep_parent))
	    {
		    foreach ($dep_parent as $sub) {
			    self::delete_parent($sub->id);

			    if(!empty($sub->icon))
			    {
			    	Storage::has($sub->icon)?Storage::delete($sub->icon):'';
			    }
			    $sub_dep=Department::find($sub->id);

			    if(!empty($sub_dep))
			    {
				    $sub_dep->delete();
			    }
    	    }

		    $parent_dep=Department::find($id);
		    if(!empty($parent_dep->icon))
		    {
			    Storage::has($parent_dep->icon)?Storage::delete($parent_dep->icon):'';
		    }
		    $parent_dep->delete();
	    }
    }
}
