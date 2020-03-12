@extends('layouts.backendLayouts.app')
@section('content')
<!-- Question add -->
<section class="content-header">
    <h1>
        Question Edit
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Question Forms</li>
    </ol>
</section>
<section class="content">
    <div class="row">
    	<div class="col-md-6">

    	    <div class="box box-danger">
    	        <div class="box-header">
    	            <h3 class="box-title">Edit Question</h3> <span class="float-right-btn"><a href="{{ route('admin-question.index') }}" class="btn btn-sm btn-success text-white">View Question</a></span>
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
    	            <form action="{{ route('admin-question.update',$cateData->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                         <div class="form-group">
                            <label>Question Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <input type="text" class="form-control" id="ques_ajax_name" onkeyup="checking_question_exist(<?= $cateData->id ?>)" name="question_name" value="{{ $cateData->question_name }}" />
                            </div><!-- /.input group -->
                            <span class="text-danger"></span>
                        </div><!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Question Type:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye"></i>
                                </div>
                                @if( $cateData->question_type == 1)
                                    @php $type_check = "Text"; @endphp
                                @elseif( $cateData->question_type == 2)
                                    @php $type_check = "Radio Button"; @endphp
                                @elseif( $cateData->question_type == 3)
                                    @php $type_check = "Textarea"; @endphp
                                @elseif( $cateData->question_type == 4)
                                    @php $type_check = "Checkbox"; @endphp
                                @elseif( $cateData->question_type == 5)
                                    @php $type_check = "Select"; @endphp
                                @elseif( $cateData->question_type == 6)
                                    @php $type_check = "Multi Select"; @endphp
                                @elseif( $cateData->question_type == 7)
                                    @php $type_check = "Multi Checkbox"; @endphp
                                @endif
                                <select type="text" class="form-control" name="question_type" >
                                    <option>Enter input type</option>
                                    <option value="1" <?php if($cateData->question_type == 1){ ?> selected <?php } ?>>text</option>
                                    <option value="2" <?php if($cateData->question_type == 2){ ?> selected <?php } ?>>radio</option>
                                    <option value="3" <?php if($cateData->question_type == 3){ ?> selected <?php } ?>>textarea</option>
                                    <option value="4" <?php if($cateData->question_type == 4){ ?> selected <?php } ?>>checkbox</option>
                                    <option value="5" <?php if($cateData->question_type == 5){ ?> selected <?php } ?>>select</option>
                                    <option value="6" <?php if($cateData->question_type == 6){ ?> selected <?php } ?>>multiselect</option>
                                    <option value="7" <?php if($cateData->question_type == 7){ ?> selected <?php } ?>>multicheckbox</option>
                                </select>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Question Description:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </div>
                                <textarea class="form-control" name="question_description"  rows="10">{{ $cateData->question_description }}</textarea>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Question Short Heading:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </div>
                                <textarea class="form-control" name="question_subheading"  rows="5">{{ $cateData->question_subheading }}</textarea>
                            </div><!-- /.input group -->
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
@endsection