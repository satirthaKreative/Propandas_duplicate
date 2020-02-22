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
                                <select class="form-control" id="quescate_choosen" name="category_id">
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
                                    <option>Choose a Question</option>
                                    @if(count($ques_id))
                                        @foreach($ques_id as $ques_name)
                                            <option value="{{ $ques_name->id }}">{{ $ques_name->question_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="opt_name_main_div" style="display: none;">
                            <label>Options Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <select class="form-control" id="opt_choosen" name="option_id">
                                    <option>Choose a options</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="priority_number_id">
                            <label>Priority Number: <b class="text-danger">(*like 1,2,..)</b></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <input type="number" class="form-control" id="priority_no" name="ques_priority" placeholder="Example: min: 1 | max: 10">
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
    function quesCateChange()
    {
        var quescatechoose = $("#ques_choosen").val();
        // console.log(quescatechoose);
        $.ajax({
            url: '/quesCateajaxcall',
            type: 'GET',
            data: {quescatechoose: quescatechoose},
            dataType: "json",
            success: function(resp){
                if(resp.length>0)
                {
                    html = '';
                    html += '<option>Choose a options</option>';
                    for(var i=0;i<resp.length;i++)
                    {
                        html += '<option value="'+resp[i].id+'">'+resp[i].option_label+'</option>';
                    }
                    $("#opt_name_main_div").show();
                    $("#opt_choosen").html(html);
                    next_question_ajax();
                }
                else
                {
                    $("#opt_name_main_div").hide();
                }
            }, error: function(resp){
                console.log("error massage come!!!");
            }
        })
    }
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
                console.log(event);
                var html_new = '';
                html_new += "<option>Choose your next question</option>";
                for(var i=0; i<event.length; i++){
                    html_new += '<option value="'+event[i].id+'">'+event[i].question_name+'</option>';
                }
                $("#next_question_id").html(html_new);
            }, error: function(event){
                 console.log("error massage come!!!");
            }
        })
    }
</script>
@endsection