@extends('layouts.backendLayouts.app')
@section('content')
<!-- Question Show Page -->
<section class="content-header">
    <h1>
        {{ $cateData->question_name }}'s Detail View
        <small>preview of detail view</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript: ;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript: ;">Tables</a></li>
        <li class="active">Detail View</li>
    </ol>
</section>
<section class="content">
    <div class="row">
    	<div class="col-md-6">

    	    <div class="box box-danger">
    	        <div class="box-header">
    	            <h3 class="box-title">View Details</h3> <span class="float-right-btn"><a href="{{ route('admin-question.index') }}" class="btn btn-sm btn-success text-white">Detail View</a></span>
    	        </div>
    	        <div class="box-body">
                        <div class="form-group">
                            <label>Question Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                </div>
                                <input type="text" class="form-control" readonly="readonly" name="question_name" value="{{ $cateData->question_name }}" />
                            </div><!-- /.input group -->
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
                                <select type="text" class="form-control" name="question_type" readonly="readonly">
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
                                <textarea class="form-control" name="question_description" readonly="readonly" rows="10">{{ $cateData->question_description }}</textarea>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Question Short Heading:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-info"></i>
                                </div>
                                <textarea class="form-control" name="question_subheading" readonly="readonly" rows="5">{{ $cateData->question_subheading }}</textarea>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                        <!-- <div class="clearfix">
                            <button class="btn btn-success btn-sm float-right-btn text-white" type="submit">Submit</button>
                        </div> -->  
    	        </div><!-- /.box-body -->

    	    </div><!-- /.box -->

    	</div><!-- /.col (left) -->
    </div>
</section>
@endsection