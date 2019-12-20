<?php

namespace App\Http\Controllers\Admin;

use App\model\Country;
use App\model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Data table
use App\DataTables\ProductsDataTable;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $product)
    {
        //
	    return $product->render('admin.products.index',['title'=>'Product Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    $product=Product::create(['title'=>'']);
	    if(!empty($product))
	    {
		    return redirect(aurl('products/'.$product->id.'/edit'));
	    }
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
	    	'logo'=>'required|'.v_image(),
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
			    'upload_type'=>'single',
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
	    $product=Product::find($id);
	    $title=trans('admin.edit');

	    return view('admin.products.product',compact('product','title'));
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

    //for upload files
    public function upload_file($id)
    {
        if(\request()->hasFile('file'))
        {
            $fid= up()->upload([
                'file'=>'file',
                'path'=>'products/'.$id,
                'upload_type'=>'files',
                'file_type'=>'product',
                'relation_id'=>$id
            ]);

            return response(['status'=>true,'id'=>$fid],200);
        }
    }

    //for delete files
    public function delete_file()
    {
        if(\request()->has('id'))
        {
            up()->delete(\request('id'));
        }
    }

    public function update_product_image($id)
    {
        $product= Product::where('id',$id)->update([
            'photo'=>up()->upload([
                'file'=>'file',
                'path'=>'products/'.$id,
                'upload_type'=>'files',
                'delete_file'=>''
            ])
        ]);

        //'photo'=>$product->photo
        return response(['status'=>true],200);
    }

    public function delete_main_image($id)
    {
        $product= Product::find($id);
        Storage::delete('products/'.$product->photo);
        $product->photo=null;
        $product->save();

        //'photo'=>$product->photo
        return response(['status'=>true],200);
    }
}
