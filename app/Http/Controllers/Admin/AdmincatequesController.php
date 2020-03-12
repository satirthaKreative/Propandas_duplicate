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
        $category_id = $request->input('category_id');
        $question_id = $request->input('question_id');
        $priority_avail = $request->input('priority_avail');
        $option_id = $request->input('option_id');
        $ques_priority = $request->input('ques_priority');
        $next_ques_id = $request->input('next_ques_id');
        if($ques_priority != '')
        {
            $myOpt =  $ques_priority;
        }
        else
        {
            $myOpt =  0;
        }
        admincateques::create([
            'category_id' => $category_id,
            'question_id' => $question_id,
            'option_id' => $option_id,
            'check_yn' => $priority_avail,
            'ques_priority' => $myOpt,
            'next_ques_id' => $next_ques_id,
        ]);
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
        $main_fetch_query = DB::table('admincateques')->where('id',$admincateques)->first();
        // get all ids
       
            # category id
            $categoty_f_id = $main_fetch_query->category_id;
            # question id
            $question_f_id = $main_fetch_query->question_id;
            # option_id
            $option_f_id = $main_fetch_query->option_id;
            # next question id
            $next_ques_f_id = $main_fetch_query->next_ques_id;
       
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

        // print_r($query_select0);

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
        $count_options = DB::table('adminoptions')->where('ques_id',$data_id)->count();
        if($count_options > 0){
            $data_ques_load = DB::table('adminoptions')->where('ques_id',$data_id)->get();
        }else{
            $data_ques_load = "";
        }
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
                
                $cate_name = DB::table('adminquestions')->whereNotIn('id', $key)->get();
            }
            else
            {
                $fetchQc = DB::table('admincateques')->where(['next_ques_id' => $data_id, 'category_id' => $category_id])->get();
                $countQc = DB::table('admincateques')->where(['next_ques_id' => $data_id, 'category_id' => $category_id])->count();

                if($countQc){
                    $key =  array();
                    $key[] = $data_id;
                    foreach ($fetchQc as $key_value) {
                        $key[] = $key_value->question_id;
                    }
                    $cate_name = DB::table('adminquestions')->whereNotIn('id', $key)->get();
                }else{
                    $cate_name = DB::table('adminquestions')->where('id','!=',$data_id)->get();
                }
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

                $checking_count_ques = DB::table('admincateques')->where('question_id',$key_value->question_id)->count();
                $checking_count_main_qOptions = DB::table('adminoptions')->where('ques_id',$key_value->question_id)->count();
                if($checking_count_ques >= $checking_count_main_qOptions){
                    $myQitems[] = $key_value->question_id;
                }
            }
            
            $fetch_q_datas = DB::table('adminquestions')->whereNotIn('id',$myQitems)->get();
        }else{
            $fetch_q_datas = DB::table('adminquestions')->get();
        }

        echo json_encode($fetch_q_datas);
    }

    public function ques_opt_ajax()
    {
        $ques_ne_id = $_GET['ques_id'];
        $count_rows = DB::table('adminoptions')->where('ques_id',$ques_ne_id)->count();
        echo json_encode($count_rows);
    }

    public function checking_priority_with_count()
    {
        $question_id = $_GET['ques_id'];
        $category_id = $_GET['cat_id'];

        $condition1 = array(
            'question_id' => $question_id,
            'category_id' => $category_id,
        );
        $count_array = array();

        $countPriority = DB::table('admincateques')->where($condition1)->count();
        if($countPriority > 0){
            $getPriority = DB::table('admincateques')->where($condition1)->get();
            

            foreach ($getPriority as $key_value) {
                $count_array[] = $key_value->ques_priority; 
            }

            echo json_encode($count_array);

        }else{
            echo json_encode($count_array);
        }

    }

    public function category_priority()
    {
        $data_id = $_GET['quescatechoose'];
        $cate_id = $_GET['category_pid'];

        $condition1 = array(
            'question_id' => $data_id,
            'category_id' => $cate_id,
        );

        $data_ques_load = DB::table('admincateques')->where($condition1)->get();
        $count_array = array();

            foreach ($data_ques_load as $key_value) {
                $count_array[] = $key_value->option_id; 
            }
        echo json_encode($count_array);
    }

    public function optionchange_method_ajax()
    {
        $cate_id = $_GET['cat_id'];
        $opt_id = $_GET['opt_id'];
        $ques_id = $_GET['ques_id'];

        $condition1 = array(
            'category_id' => $cate_id,
            'option_id' => $opt_id,
            'question_id' => $ques_id
        );
        $myQitems = array();
        # fetch query on questioncate tbl
        $main_count = DB::table('admincateques')->where($condition1)->count();
        if($main_count == 0)
        {
            $where_con_arr = [
                'category_id' => $cate_id,
                'next_ques_id' => $ques_id
            ];
          
            $checking_next_query = DB::table('admincateques')->where($where_con_arr)->count();
            if($checking_next_query == 0)
            {
                $get_data = [
                    'category_id' => $cate_id
                ];
                $checking_next_query1 = DB::table('admincateques')->select(['id','question_id','next_ques_id'])->where($get_data)->get();

                $key = array();
                $key[] = $ques_id;
                foreach ($checking_next_query1 as $key_val) {
                    $key[] = $key_val->question_id;
                    if($key_val->next_ques_id != ''){
                       $key[] = $key_val->next_ques_id;
                    }
                }
              
                $cate_name = DB::table('adminquestions')->whereNotIn('id', $key)->get();
            }
            else
            {
                $cate_name = DB::table('adminquestions')->where('id','!=',$data_id)->get();
            }
            
        }
        else
        {
            $cate_name = "";
        }

        echo json_encode($cate_name);

    }
}
