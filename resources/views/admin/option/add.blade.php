@extends('layouts.backendLayouts.app')
@section('content')
<!-- Options add -->
<section class="content-header">
    <h1>
        Options Add
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Options Forms</li>
    </ol>
</section>
<section class="content">
    <div class="row">
    	<div class="col-md-6">

    	    <div class="box box-danger">
    	        <div class="box-header">
    	            <h3 class="box-title">Input Options</h3> <span class="float-right-btn"><a href="{{ route('admin-option.index') }}" class="btn btn-sm btn-success text-white">View Options</a></span>
    	        </div>
    	        <div class="box-body">
                    <div class="alert alert-danger" style="display: none;">
                        <strong id="main-msgbox"></strong>
                    </div>
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
                    @if($message1 = Session::get('danger'))
                        <div class="alert alert-danger">
                            <strong>{{ $message1 }}</strong>
                        </div>
                    @endif
    	            <form action="{{ route('admin-option.store') }}" method="post">
                        @csrf

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Questions:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <select class="form-control" id="Options_type" name="Options_type" onchange="checking_input_type()" />
                                    <option>Choose Question</option>
                                    @foreach($ques as $q_opt)
                                        <option value="{{ $q_opt->id }}">{{ $q_opt->question_name }}</option>
                                    @endforeach
                                </select>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group" id="option_label_checking">
                            <label>Options Label:</label>
                            <div class="option-label-section" id="qls1">
                                <div class="main-contain-class">
                                    <span><a href="javascript:;" onclick="add_more(1)"><i class="fa fa-plus"></i></a> </span>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input class="form-control" name="Options_description[]" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.form group -->
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
    function checking_input_type()
    {
        var q_type = jQuery("#Options_type").val();
        $.ajax({
            url: "/option_type_ajax",
            type: "get",
            data: {q_type:  q_type},
            dataType: "json",
            success: function(resp){
                if(resp.main_data == true){
                    // hide
                    jQuery("#option_label_checking").hide();
                    jQuery("#main-msgbox").html(resp.main_sec_msg);
                    $(".alert-danger").show();
                }else{
                    // show
                    jQuery("#option_label_checking").show();
                    $(".alert-danger").hide();
                }
            }, error:  function(resp){

            }
        })
    }
</script>
@endsection