@extends('layouts.backendLayouts.app')
@section('content')
<!-- Question Table -->
<section class="content-header">
    <h1>
        Question View
        <small>preview of Question table</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript: ;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript: ;">Tables</a></li>
        <li class="active">Question</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
    	<div class="col-md-12">
    	    <div class="box">
    	        <div class="box-header">
    	            <h3 class="box-title">Question Table</h3> <span class="float-right-btn"><a href="{{ route('admin-question.create') }}" class="btn btn-sm btn-success text-white">Add Question</a></span>
    	        </div><!-- /.box-header -->
    	        <div class="box-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
    	            <table class="table table-bordered table-striped table-reponsive">
    	                <tr>
    	                    <th style="width: 10px">#</th>
    	                    <th>Question Name</th>
    	                    <th>Question Type</th>
                            <th class="w30">Question Subheading</th>
    	                    <th class="w30">Description</th>
    	                    <th>Action</th>
    	                    <!-- <th style="width: 40px">Label</th> -->
    	                </tr>
                        @if(count($categoryData)>0)
                            @foreach($categoryData as $cateData)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $cateData->question_name }}</td>
                                <td>
                                    @if( $cateData->question_type == 1)
                                        {{ "Text" }}
                                    @elseif( $cateData->question_type == 2)
                                        {{ "Radio Button" }}
                                    @elseif( $cateData->question_type == 3)
                                        {{ "Textarea" }}
                                    @elseif( $cateData->question_type == 4)
                                        {{ "Checkbox" }}
                                    @elseif( $cateData->question_type == 5)
                                        {{ "Select" }}
                                    @elseif( $cateData->question_type == 6)
                                        {{ "Multi Select" }}
                                    @elseif( $cateData->question_type == 7)
                                        {{ "Multi Checkbox" }}
                                    @endif
                                </td>
                                <td>
                                    @if(strlen($cateData->question_subheading)>100)
                                        {{ substr($cateData->question_subheading,0,100)."..." }}
                                        @else
                                            {{ $cateData->question_subheading }}
                                    @endif
                                </td>
                                <td>
                                    @if(strlen($cateData->question_description)>100)
                                        {{ substr($cateData->question_description,0,100)."..." }}
                                        @else
                                            {{ $cateData->question_description }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin-question.destroy',$cateData->id) }}" method="post">
                                        <a href="{{ route('admin-question.show',$cateData->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="{{ route('admin-question.edit',$cateData->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-warning"><center><i class="fa fa-times"></i> No Question inserted yet!</center></td>
                            </tr>
                        @endif
    	            </table>
    	        </div><!-- /.box-body -->
                <div class="box-footer clearfix padding0">
                    <div class="float-right ">
                        {{ $categoryData->links() }}
                    </div>
                </div>
    	        <!-- <div class="box-footer clearfix">
    	            <ul class="pagination pagination-sm no-margin pull-right">
    	                <li><a href="#">&laquo;</a></li>
    	                <li><a href="#">1</a></li>
    	                <li><a href="#">2</a></li>
    	                <li><a href="#">3</a></li>
    	                <li><a href="#">&raquo;</a></li>
    	            </ul>
    	        </div> -->
    	    </div><!-- /.box -->

    	</div><!-- /.col -->
    </div>
</section>
@endsection