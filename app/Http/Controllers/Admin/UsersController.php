<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use App\DataTables\UsersDataTable;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $admin)
    {
        //
	    return $admin->render('admin.users.index',['title'=>'Users Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    return view('admin.users.create',['title'=>trans('admin.create_admin')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	    $data=$this->validate($request,[
	    	'name'=>'required',
	    	'level'=>'required|in:user,vendor,company',
	    	'email'=>'required|email|unique:users',
	    	'password'=>'required|min:6',
	    ],[],[
	    	'name'=>trans('admin.name'),
	    	'level'=>'Level',
	    	'email'=>trans('admin.email'),
	    	'password'=>trans('admin.password'),
	    ]);

	    $data['password']=bcrypt($request->get('password'));
	    User::create($data);

	    session()->flash('success',trans('admin.user_record_added'));

	    return redirect(aurl('users'));

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
	    $admin=User::find($id);
	    $title=trans('admin.edit');

	    return view('admin.users.edit',compact('admin','title'));
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
		    'name'=>'required',
		    'level'=>'required|in:user,vendor,company',
		    //to update and skip current email from
		    //list compared uniqueness if not update email
		    'email'=>'required|email|unique:users,email,'.$id,
		    'password'=>'sometimes|nullable|min:6',
	    ],[],[
		    'name'=>trans('admin.name'),
		    'level'=>'Level',
		    'email'=>trans('admin.email'),
		    'password'=>trans('admin.password'),
	    ]);

	    if($request->has('password'))
	    {
		    $data['password']=bcrypt($request->get('password'));
	    }

	    User::where('id',$id)->update($data);

	    session()->flash('success',trans('admin.recorded_updated'));

	    return redirect(aurl('users'));
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
	    User::find($id)->delete();

	    session()->flash('success',trans('admin.user_deleted_record'));
	    return redirect(aurl('users'));

    }

    public function multi_delete()
    {
    	if(is_array(\request('item')))
	    {
	    	User::destroy(\request('item'));
	    }
    	else{
		    User::find(\request('item'))->delete();
	    }

    	session()->flash('success',trans('admin.user_deleted_record'));
    	return redirect(aurl('users'));
    }
}
