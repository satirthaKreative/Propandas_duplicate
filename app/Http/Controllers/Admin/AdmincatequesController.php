<?php

namespace App\Http\Controllers\Admin;

use App\admincateques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdmincatequesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryData = DB::table('admincateques')
                        ->join('adminoptions','adminoptions.id','admincateques.option_id')
                        ->join('admincategories','admincategories.id','admincateques.category_id')
                        ->join('adminquestions','adminquestions.id','admincateques.question_id')
                        ->paginate(5);
        return view('admin.cateOptions.view',compact('categoryData'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category_result = DB::table('admincategories')->get();
        $question_result = DB::table('adminquestions')->get();
        return view('admin.cateOptions.add',['cate_id' => $category_result, 'ques_id' => $question_result]);
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
            'category_id' => 'required',
            'question_id' => 'required',
            'option_id' => 'required',
            'ques_priority' => 'required',
        ]);
        admincateques::create($request->all());
        return redirect()->route('admin-cateques.create')->with('success','Question Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\admincateques  $admincateques
     * @return \Illuminate\Http\Response
     */
    public function show(admincateques $admincateques)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admincateques  $admincateques
     * @return \Illuminate\Http\Response
     */
    public function edit(admincateques $admincateques)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admincateques  $admincateques
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admincateques $admincateques)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\admincateques  $admincateques
     * @return \Illuminate\Http\Response
     */
    public function destroy(admincateques $admincateques)
    {
        //
    }


    public function quesCate_ajaxcall()
    {
        $data_id = $_GET['quescatechoose'];
        $data_ques_load = DB::table('adminoptions')->where('ques_id',$data_id)->get();
        echo json_encode($data_ques_load);
    }

    public function ques_ajax()
    {
        $data_id = $_GET['question_id'];
        $category_id = $_GET['category_id'];

        $where_arr = [
            'category_id' => $category_id,
            'question_id' => $data_id,
        ];

        $result_set = DB::table('admincateques')->where($where_arr)->count();
        if($result_set == 0){
            $cate_name = DB::table('adminquestions')->where('id','!=',$data_id)->get();
        }else{
            $cate_name = "";
        }
        echo  json_encode($cate_name);
    }
}
