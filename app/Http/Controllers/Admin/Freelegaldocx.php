<?php

namespace App\Http\Controllers\admin;

use App\adminfreelegaldocx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Freelegaldocx extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $docData = DB::table('adminfreelegaldocxes')
                        ->join('admincategories','admincategories.id','adminfreelegaldocxes.cate_id')
                        ->select('*','adminfreelegaldocxes.id as main_id')
                        ->orderBy('adminfreelegaldocxes.id','desc')
                        ->paginate(20);
        return view('admin.freelegaldocx.view',compact('docData'))->with('i',(request()->input('page',1)-1)*20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.freelegaldocx.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'docx_details' => 'required'
        ]);
        $data_msg = 3;
        $is_uploaded = $request->docx_download;
        if($is_uploaded == 1)
        {
            $file = $request->file('upload');
            $file_name = $file->getClientOriginalName();
            $file_type = $file->getClientOriginalExtension();
            $enc_type = $file->getClientOriginalExtension();
            if($enc_type == 'docx' || $enc_type == 'doc' || $enc_type == 'pdf' || $enc_type == 'jpeg' || $enc_type == 'jpg' || $enc_type == 'webp' || $enc_type == 'png' || $enc_type == 'gif')
            {
                $real_path = $file->getRealPath();
                $file_size = $file->getSize();
                $meme_type = $file->getMimeType();
                $destinationPath = 'uploads';
                $file->move($destinationPath,$file->getClientOriginalName());

                $myActualPath = $destinationPath.'/'.$file_name;
                
            }
            else
            {
                $myActualPath = "";
                $is_uploaded = '0';
                $file_type = "";
            }
        }
        else
        {
           $myActualPath = "";
           $is_uploaded = '0';
           $file_type = "";
        }

        for($i=0;$i<count($request->category_name);$i++)
        {
            $category_id = $request->category_name[$i];

            // conditions
            
            $uploaded_text = $request->docx_details;
            
            DB::table('adminfreelegaldocxes')->insert([
                ['cate_id' => $category_id, 'is_upload' => $is_uploaded, 'uploaded_path' => $myActualPath, 'uploaded_text' => $uploaded_text, 'uploaded_type' => $file_type]
            ]);
            $data_msg = 4;
        }

        if($data_msg == 4)
        { 
            return redirect()->route('admin-freelegaldoc.index')->with('success','Category Successfully Added');
        }
        else
        {
            return redirect()->route('admin-freelegaldoc.create')->with('success',"Doesn't added");
        }

        

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
    }
}
