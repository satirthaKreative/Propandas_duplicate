@extends('layouts.backendLayouts.app')
@section('content')
<!-- Category Options add -->
<section class="content-header">
    <h1>
        Category Options Add
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Category Options Forms</li>
    </ol>
</section>
<section class="content">
    <div class="row">
    	<div class="col-md-6">

    	    <div class="box box-danger">
    	        <div class="box-header">
    	            <h3 class="box-title">Input Category Options</h3> <span class="float-right-btn"><a href="{{ route('admin-cateques.index') }}" class="btn btn-sm btn-success text-white">View Category Options</a></span>
    	        </div>
    	        <div class="box-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
    	            <form action="{{ route('admin-cateques.store') }}" method="post">
                        @csrf
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Category Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <select class="form-control" id="quescate_choosen" name="category_id" onchange="cateChangeQues()">
                                    <option>Choose a category</option>
                                    @if(count($cate_id))
                                        @foreach($cate_id as $cate_name)
                                            <option value="{{ $cate_name->id }}">{{ $cate_name->category_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                        <div class="form-group">
                            <label>Category Questions Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <select class="form-control" id="ques_choosen" name="question_id" onchange="quesCateChange()">
                                    <!-- <option>Choose a Question</option>
                                    @if(count($ques_id))
                                        @foreach($ques_id as $ques_name)
                                            <option value="{{ $ques_name->id }}">{{ $ques_name->question_name }}</option>
                                        @endforeach
                                    @endif -->
                                    <option>choose a category first</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="opt_priority_check" >
                            <label>Options Priority Available:
                                <input type="checkbox" name="priority_avail" id="priority_avail" onclick="checked_priority_func()" checked="checked" value="1" />
                            </label>
                        </div>
                        <div class="form-group" id="opt_name_main_div" style="display: none;">
                            <label>Options Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <select class="form-control" id="opt_choosen" name="option_id" onchange="optionChange_method()">
                                    <option value="0">Choose a options</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="priority_number_id">
                            <label>Priority Number: <b class="text-danger">(*like 1,2,..)</b></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <select class="form-control" id="priority_no" min="1" name="ques_priority">

                                </select>
                                <!-- <input type="number" class="form-control" id="priority_no" min="1" name="ques_priority" placeholder="Example: min: 1 | max: 10" -->
                            </div>
                        </div>
                        <div class="form-group" id="next_ques_id">
                            <label>Next Question:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <select class="form-control" id="next_question_id" name="next_ques_id">
                                    <option>Choose a next question</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-success btn-sm float-right-btn text-white" type="submit">Submit</button>
                        </div>   
                    </form>
    	        </div><!-- /.box-body -->

    	    </div><!-- /.box -->

    	</div><!-- /.col (left) -->
    </div>
</section>
<script>
    // question wish option list change 21.02.2020
    function quesCateChange()
    {
        var quescatechoose = $("#ques_choosen").val();
        var category_pid = $("#quescate_choosen").val();
        // console.log(quescatechoose);
        $.ajax({
            url: '/quesCateajaxcall',
            type: 'GET',
            data: {quescatechoose: quescatechoose},
            dataType: "json",
            success: function(resp){
                if(resp.length>0)
                {
                    $.ajax({
                        url: '/category_priority',
                        type: 'GET',
                        data: {quescatechoose: quescatechoose, category_pid: category_pid},
                        dataType: 'json',
                        success: function(response){
                            var html = '';
                            html += '<option>Choose a options</option>';
                            for(var i=0;i< resp.length;i++)
                            {
                                if(jQuery.inArray((i+1),response) !== -1){
                                    var dataTCheck = "disabled";
                                }else{
                                    var dataTCheck = "";
                                }
                                html += '<option value="'+resp[i].id+'" '+dataTCheck+'>'+resp[i].option_label+'</option>';
                                $("#opt_name_main_div").show();
                                $("#priority_number_id").show(); 
                                $("#opt_choosen").html(html);
                                $("#opt_priority_check").show();
                                $("#priority_avail").val(1);
                                checking_how_many_options();
                                next_question_ajax();
                            }
                        }, error:  function(response){

                        }
                    }) 
                }
                else
                {
                    $("#priority_number_id").hide(); 
                    $("#opt_name_main_div").hide();
                    $("#opt_priority_check").hide();
                    $("#priority_avail").val(0);
                    next_question_ajax();
                }
            }, error: function(resp){
                console.log("error massage come!!!");
            }
        })
    }
    //  next question id's set  22.02.2020
    function next_question_ajax()
    {
        var category_id = $("#quescate_choosen").val();
        var question_id = $("#ques_choosen").val();
        $.ajax({
            url: '/ques_ajax',
            type: 'GET',
            data: {question_id: question_id, category_id: category_id},
            dataType: 'json',
            success: function(event){
                var html_new = '';
                html_new += "<option>Choose your next question</option>";
                for(var i=0; i<event.length; i++){
                    html_new += '<option value="'+event[i].id+'">'+event[i].question_name+'</option>';
                }
                $("#next_question_id").html(html_new);
            }, error: function(event){
                 console.log("error message come!!!");
            }
        })
    }
    // category wish question set change 24.02.2020
    function cateChangeQues()
    {
        var cat_id = $("#quescate_choosen").val();
        $.ajax({
            url: "/catetoques_ajax",
            type: "GET",
            data: {cate_id:  cat_id},
            dataType: "json",
            success:  function(response){
                var html_new = '';
                html_new += "<option>Choose your questions</option>";
                for(var i=0; i<response.length; i++){
                    html_new += '<option value="'+response[i].id+'">'+response[i].question_name+'</option>';
                }
                $("#ques_choosen").html(html_new);
            }, error: function(response){
                console.log("error message come!!!");
            }  
        })
    } 

    // checked priority available or not
    function checked_priority_func()
    {
        if ($("#priority_avail").prop('checked')==true){ 
            $("#priority_avail").val(1);
            $("#priority_number_id").show(); 
        }else{
            $("#priority_avail").val(0);
            $("#priority_number_id").hide();
        }
    }

    // counting 
    function checking_how_many_options()
    {
        var ques_id = $("#ques_choosen").val();
        var cat_id = $("#quescate_choosen").val();
        $.ajax({
            url: "/ques_opt_ajax",
            type: "get",
            data: {ques_id: ques_id},
            dataType: "json",
            success:  function(response){
                $.ajax({
                    url: '/checking_priority_with_count',
                    type: 'GET',
                    data: {ques_id: ques_id, cat_id:  cat_id},
                    dataType: "json",
                    success: function(resp){
                        console.log(resp);
                        var html_new = "";
                        html_new += "<option>Choose your priority</option>";
                        for(var i=1; i<=response; i++){
                            if(jQuery.inArray(i,resp) !== -1){
                                var dataTCheck = "disabled";
                            }else{
                                var dataTCheck = "";
                            }
                            html_new += '<option value="'+i+'" '+dataTCheck+'>'+i+'</option>';
                        }
                        $("#priority_no").html(html_new);
                    }, error: function(resp){

                    }
                }); 
                
            }, error: function(response){
                console.log("error message come!!!");
            }  
        })
    }
    // option wish question select
    function optionChange_method()
    {
        var opt_id = $("#opt_choosen").val();
        var ques_id = $("#ques_choosen").val();
        var cat_id = $("#quescate_choosen").val();

        $.ajax({
            url: '/optionchange_method_ajax',
            type: 'GET',
            data: {opt_id:  opt_id, ques_id:  ques_id, cat_id:  cat_id},
            dataType: "json",
            success: function(event){
                var html_new = '';
                html_new += "<option>Choose your next question</option>";
                for(var i=0; i<event.length; i++){
                    html_new += '<option value="'+event[i].id+'">'+event[i].question_name+'</option>';
                }
                $("#next_question_id").html(html_new);
            }, error: function(event){
                console.log("Error page show !!!");
            }
        })
    }

</script>
@endsection