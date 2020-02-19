<?php

namespace App\Http\Controllers\Admin;

use App\adminquestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminquestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryData = adminquestion::latest()->paginate(5);
        return view('admin.question.view',compact('categoryData'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.question.add');
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
            'question_type' => 'required',
            'question_name' => 'required',
            'question_description' => 'required'
        ]);
        adminquestion::create($request->all());
        return redirect()->route('admin-question.create')->with('success','Question Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\adminquestion  $adminquestion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cateData = adminquestion::find($id);
        return view('admin.question.show',compact('cateData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\adminquestion  $adminquestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cateData = adminquestion::find($id);
        return view('admin.question.edit',compact('cateData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\adminquestion  $adminquestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminquestion $adminquestion)
    {
        //
        $request->validate([
            'question_type' => 'required',
            'question_name' => 'required',
            'question_description' => 'required'
        ]);
        adminquestion::create($request->all());
        return redirect()->route('admin-question.create')->with('success','Question Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\adminquestion  $adminquestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($adminquestion)
    {
        //
        adminquestion::find($adminquestion)->delete();
        return redirect()->route('admin-question.index')->with('success','Successfully deleted those data');
    }
}