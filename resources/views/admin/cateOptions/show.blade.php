@extends('layouts.backendLayouts.app')
@section('content')
<!-- Category Options add -->
<section class="content-header">
    <h1>
        Category Options Edit
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
                                @foreach($cate_opt as $fetch_cate)
                                    <input type="text" class="form-control" readonly="readonly" value="{{ $fetch_cate->category_name }}">
                                @endforeach
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                        <div class="form-group">
                            <label>Category Questions Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                @foreach($ques_opt as $fetch_ques)
                                    <input type="text" class="form-control" readonly="readonly" value="{{  $fetch_ques->question_name  }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group" id="opt_name_main_div" style="display: none;">
                            <label>Options Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                @foreach($opt_opt as $fetch_option)
                                    <input type="text" class="form-control" readonly="readonly" value="{{  $fetch_option->option_label  }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group" id="priority_number_id">
                            <label>Priority Number: <b class="text-danger">(*like 1,2,..)</b></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                @foreach($priority_opt as $fetch_priority)
                                    <input type="text" class="form-control" readonly="readonly" value="{{  $fetch_priority->ques_priority  }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group" id="next_ques_id">
                            <label>Next Question:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                @foreach($next_question_opt as $fetch_next_id)
                                    <input type="text" class="form-control" readonly="readonly" value="{{  $fetch_next_id->question_name  }}">
                                @endforeach
                            </div>
                        </div>   
                    </form>
                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div><!-- /.col (left) -->
    </div>
</section>
@endsection