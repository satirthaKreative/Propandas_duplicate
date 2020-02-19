@extends('layouts.backendLayouts.app')
@section('content')
<!-- Question add -->
<section class="content-header">
    <h1>
        Question Add
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
    	            <h3 class="box-title">Input Question</h3> <span class="float-right-btn"><a href="{{ route('admin-question.index') }}" class="btn btn-sm btn-success text-white">View Question</a></span>
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
    	            <form action="{{ route('admin-question.store') }}" method="post">
                        @csrf
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Question Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <input type="text" class="form-control" name="question_name" />
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Question Type:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <select type="text" class="form-control" name="question_type" />
                                    <option>Enter input type</option>
                                    <option value="1">text</option>
                                    <option value="2">radio</option>
                                    <option value="3">textarea</option>
                                    <option value="4">checkbox</option>
                                    <option value="5">select</option>
                                    <option value="6">multiselect</option>
                                    <option value="7">multicheckbox</option>
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
                                <textarea class="form-control" name="question_description" rows="10"></textarea>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Question Short Heading:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </div>
                                <textarea class="form-control" name="question_subheading" rows="5"></textarea>
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