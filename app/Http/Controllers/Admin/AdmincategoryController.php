<?php

namespace App\Http\Controllers\Admin;

use App\admincategory;
use Illuminate\Http\Request;
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
    public function update(Request $request, admincategory $newCate)
    {
        //
        $request->validate([
            'category_name' => 'required',
            'category_title' => 'required',
            'category_description' => 'required'
        ]);

        $newCate->update($request->all());
        return redirect()->route('admin-category.index')->with('success','Category Successfully Edited');

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
}
