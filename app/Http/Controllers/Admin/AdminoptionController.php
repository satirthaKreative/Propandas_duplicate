<?php

namespace App\Http\Controllers\Admin;

use App\adminoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryData = DB::table('adminoptions')
            ->join('adminquestions', 'adminoptions.ques_id', '=', 'adminquestions.id')
            ->select(['*','adminoptions.id as mainID'])
            ->latest('adminoptions.created_at','DESC')
            ->paginate(5);
        return view('admin.option.view',compact('categoryData'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $adminquestions = DB::table('adminquestions')->get();
        return view('admin.option.add', ['ques' => $adminquestions]);
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
        for ($i = 0; $i < count($request->Options_description); $i++) {
            $answers[] = [
                'ques_id' => $request->Options_type,
                'option_label' => $request->Options_description[$i]
            ];
        }
        adminoption::insert($answers);
        return redirect()->route('admin-option.create')->with('success','Options Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\adminoption  $adminoption
     * @return \Illuminate\Http\Response
     */
    public function show($adminoption)
    {
        $mainCateData = DB::table('adminquestions')->get();
        //  
        $cateData = DB::table('adminoptions')
            ->join('adminquestions', 'adminoptions.ques_id', '=', 'adminquestions.id')
            ->where('adminoptions.id','=',$adminoption)
            ->select(['*','adminoptions.id as mainID'])
            ->get();
            //print_r($cateData);
        return view('admin.option.show',['cate1' => $cateData, 'mainCd' => $mainCateData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\adminoption  $adminoption
     * @return \Illuminate\Http\Response
     */
    public function edit($adminoption)
    {
        $mainCateData = DB::table('adminquestions')->get();
        //  
        $cateData = DB::table('adminoptions')
            ->RightJoin('adminquestions', 'adminoptions.ques_id', '=', 'adminquestions.id')
            ->where('adminoptions.id','=',$adminoption)
            ->select(['*','adminoptions.id as mainID'])
            ->get();
            //print_r($cateData);
        return view('admin.option.edit',['cate1' => $cateData, 'mainCd' => $mainCateData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\adminoption  $adminoption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $adminoption)
    {
        //
        $request->validate([
            'question_description' => 'required'
        ]);
        DB::table('adminoptions')->where('id',$adminoption)->update(['option_label' => $request['question_description'], 'ques_id' => $request['question_type']]);
        return redirect()->route('admin-option.index')->with('success','option Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\adminoption  $adminoption
     * @return \Illuminate\Http\Response
     */
    public function destroy($adminoption)
    {
        $post = adminoption::where('id',$adminoption)->first();
        
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin-option.index')->with('success','Successfully deleted those data');
        }
        return redirect()->route('admin-option.index')->with('danger','Wrong id requested');

    }
    // option type checking ajax data 
    public function option_type_ajax()
    {
        $q_type_id = $_GET['q_type'];

        $fetch_qData = DB::table('adminquestions')->where('id',$q_type_id)->get();

        foreach ($fetch_qData as $key_value) {
            $main_type_id = $key_value->question_type; 
        }

        if($main_type_id == 1 || $main_type_id == 3)
        {
            $no_error['main_data'] = true;
            if($main_type_id == 1){
                $no_error['main_sec_msg'] = "This Question Option Having A Text Type";
            }else if($main_type_id == 3){
                $no_error['main_sec_msg'] = "This Question Option Having A Textarea Type";
            }
        }else{
            $no_error['main_data'] = false;
        }
        echo  json_encode( $no_error );
    }
}
