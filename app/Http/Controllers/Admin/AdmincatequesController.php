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
    public function show($admincateques)
    {
        //
        $main_fetch_query = DB::table('admincateques')->where('id',$admincateques)->get();
        // get all ids
        foreach ($main_fetch_query as $key_val) {
            # category id
            $categoty_f_id = $key_val->category_id;
            # question id
            $question_f_id = $key_val->question_id;
            # option_id
            $option_f_id = $key_val->option_id;
            # next question id
            $next_ques_f_id = $key_val->next_ques_id;
        }
        #category fetch
        $query_select0 = DB::table('admincategories')->where('id',$categoty_f_id)->get();
        #question fetch
        $query_select1 = DB::table('adminquestions')->where('id',$question_f_id)->get();
        #option fetch
        $query_select2 = DB::table('adminoptions')->where('id',$option_f_id)->get();
        #question priority fetch
        $query_select3 = DB::table('admincateques')->where('id',$admincateques)->get();
        #question fetch
        $query_select4 = DB::table('adminquestions')->where('id',$next_ques_f_id)->get();


        return view('admin.cateOptions.show',['cate_opt' => $query_select0, 'ques_opt' => $query_select1, 'opt_opt' => $query_select2, 'priority_opt' => $query_select3, 'next_question_opt' => $query_select4]);

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
            $where_con_arr = [
                'category_id' => $category_id,
                'next_ques_id' => $data_id
            ];

            $checking_next_query = DB::table('admincateques')->where($where_con_arr)->count();
            if($checking_next_query == 0)
            {
                $get_data = [
                    'category_id' => $category_id
                ];
                $checking_next_query1 = DB::table('admincateques')->select(['id','question_id','next_ques_id'])->where($get_data)->get();

                $key = array();
                $key[] = $data_id;
                foreach ($checking_next_query1 as $key_val) {
                    $key[] = $key_val->question_id;
                    if($key_val->next_ques_id != ''){
                       $key[] = $key_val->next_ques_id;
                    }
                }
                // $items = array_values ( $key );
                // print_r($items);
                $cate_name = DB::table('adminquestions')->whereNotIn('id', $key)->get();
            }
            else
            {
                $cate_name = DB::table('adminquestions')->where('id','!=',$data_id)->get();
            }
            
        }else{
            $cate_name = "";
        }
        echo  json_encode($cate_name);
    }

    public function catetoques_ajax()
    {
        $cate_id = $_GET['cate_id'];
        $myQitems = array();
        # fetch query on questioncate tbl
        $fetch_qc_datas = DB::table('admincateques')->where('category_id',$cate_id)->get();
        $count_qc_rows = DB::table('admincateques')->where('category_id',$cate_id)->count();

        if($count_qc_rows > 0){
            foreach ($fetch_qc_datas as $key_value) {
                $myQitems[] = $key_value->question_id;
            }
            
            $fetch_q_datas = DB::table('adminquestions')->whereNotIn('id',$myQitems)->get();
        }else{
            $fetch_q_datas = DB::table('adminquestions')->get();
        }
        echo json_encode($fetch_q_datas);
    }
}
