<?php

namespace App\Http\Controllers\Admin;

use App\admincategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdmincategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryData = admincategory::latest()->paginate(5);
        return view('admin.category.category-view',compact('categoryData'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.category-add');
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
        $request->validate([
            'category_name' => 'required',
            'category_title' => 'required',
            'category_description' => 'required'
        ]);
        admincategory::create($request->all());
        return redirect()->route('admin-category.create')->with('success','Category Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\admincategory  $admincategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cateData = admincategory::find($id);
        return view('admin.category.category-show',compact('cateData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admincategory  $admincategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cateData = admincategory::find($id);
        return view('admin.category.category-edit',compact('cateData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admincategory  $admincategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$newCate)
    {
        //
        $request->validate([
            'category_name' => 'required',
            'category_title' => 'required',
            'category_description' => 'required'
        ]);

        $update_cate_name = $request['category_name'];
        $update_cate_title = $request['category_title'];
        $update_cate_description = $request['category_description'];
        $update_id = $newCate;

        # get all the category except current one
        $store_array = array();
        $get_all_cate = DB::table('admincategories')->where('category_name','!=',$update_cate_name)->get();
        foreach ($get_all_cate as $key_value) {
            $store_array[] = $key_value->category_name;
        }
        // echo "<pre>";
        // print_r($store_array);
        // die();
        # end of store array
        DB::table('admincategories')->where('id',$update_id)->update(['category_name'=>$update_cate_name,'category_title'=>$update_cate_title,'category_description'=>$update_cate_description]);
            $msg_type = 'success';
            $msg = 'Category Successfully Updated';
        // $newCate->update($request->all());
        return redirect()->route('admin-category.index')->with($msg_type,$msg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\admincategory  $admincategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($admincategory)
    {
        //
        admincategory::find($admincategory)->delete();
        return redirect()->route('admin-category.index')->with('success','Successfully deleted those data');
    }

    public function checking_category_exist()
    {
        $change_on = $_GET['main_id'];
        $change_cate = $_GET['main_name'];

        $selectMyCategory = DB::table('admincategories')->where('id',$change_on)->first();
        $getMycategory = $selectMyCategory->category_name;

        $get_all_cate = DB::table('admincategories')->where('category_name','!=',$getMycategory)->get();
        $store_array = array();
        foreach ($get_all_cate as $key_value) {
            $store_array[] = $key_value->category_name;
        }
        if(in_array($change_cate, $store_array))
        {
            $cur_status = false;
        }
        else
        {
            $cur_status = true;
        }
        echo json_encode($cur_status);
    }

    // all category fetch ajax
    public function ajax_all_category()
    {
        $fetch_all_cate = DB::table('admincategories')->get();
        echo json_encode($fetch_all_cate);
    }
}
