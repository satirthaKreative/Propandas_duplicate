@extends('layouts.backendLayouts.app')
@section('content')
<!-- category Show Page -->
<section class="content-header">
    <h1>
        {{ $cateData->category_name }}'s Detail View
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
    	            <h3 class="box-title">View Details</h3> <span class="float-right-btn"><a href="{{ route('admin-category.index') }}" class="btn btn-sm btn-success text-white">Detail View</a></span>
    	        </div>
    	        <div class="box-body">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Category Name:</label>
                            <div class="input-group">
                                <div class="input-group-addon bg-white">
                                    <i class="fa fa-list"></i>
                                </div>
                                <input type="text" class="form-control" name="category_name" value="{{ $cateData->category_name }}"  readonly="readonly" />
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Title:</label>
                            <div class="input-group">
                                <div class="input-group-addon bg-white">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <input type="text" class="form-control" name="category_title" value="{{ $cateData->category_title }}" readonly="readonly"  />
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Description:</label>
                            <div class="input-group">
                                <div class="input-group-addon bg-white">
                                    <i class="fa fa-info"></i>
                                </div>
                                <textarea class="form-control" name="category_description" readonly="readonly"  rows="10">{{ $cateData->category_description }}</textarea>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                        <div class="clearfix">
                            <button class="btn btn-success btn-sm float-right-btn text-white" type="submit">Submit</button>
                        </div>  
    	        </div><!-- /.box-body -->

    	    </div><!-- /.box -->

    	</div><!-- /.col (left) -->
    </div>
</section>
@endsection