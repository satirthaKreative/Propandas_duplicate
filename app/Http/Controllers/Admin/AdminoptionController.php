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
    public function edit(adminoption $adminoption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\adminoption  $adminoption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminoption $adminoption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\adminoption  $adminoption
     * @return \Illuminate\Http\Response
     */
    public function destroy($adminoption)
    {
        $post =adminoption::where('id',$adminoption)->first();
        
        if ($post != null) {
            $post->delete();
            return redirect()->route('admin-option.index')->with('success','Successfully deleted those data');
        }
        return redirect()->route('admin-option.index')->with('danger','Wrong id requested');

    }
}
