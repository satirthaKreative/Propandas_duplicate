<?php

namespace App\Http\Controllers\Admin;

use App\adminquestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function update(Request $request, $adminquestion)
    {
        //
        $request->validate([
            'question_type' => 'required',
            'question_name' => 'required',
            'question_description' => 'required'
        ]);
        DB::table('adminquestions')->where('id',$adminquestion)->update(['question_type'=>$request['question_type'], 'question_name'=>$request['question_name'], 'question_description'=>$request['question_description'], 'question_subheading'=>$request['question_subheading']]);
        return redirect()->route('admin-question.index')->with('success','Question Successfully Updated');
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

    public function checking_question_exist()
    {
        $change_on = $_GET['main_id'];
        $change_cate = $_GET['main_name'];

        $selectMyCategory = DB::table('adminquestions')->where('id',$change_on)->first();
        $getMycategory = $selectMyCategory->question_name;

        $get_all_cate = DB::table('adminquestions')->where('question_name','!=',$getMycategory)->get();
        $store_array = array();
        foreach ($get_all_cate as $key_value) {
            $store_array[] = $key_value->question_name;
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
}