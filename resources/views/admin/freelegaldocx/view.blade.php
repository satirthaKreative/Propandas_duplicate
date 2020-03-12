@extends('layouts.backendLayouts.app')
@section('content')
<!-- category Table -->
<section class="content-header">
    <h1>
        Category View
        <small>preview of category table</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript: ;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript: ;">Tables</a></li>
        <li class="active">Category</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
    	<div class="col-md-9">
    	    <div class="box">
    	        <div class="box-header">
    	            <h3 class="box-title">Category Table</h3> <span class="float-right-btn"><a href="{{ route('admin-category.create') }}" class="btn btn-sm btn-success text-white">Add Category</a></span>
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
    	                    <th>Category Name</th>
    	                    <th>Title</th>
    	                    <th class="w40">Description</th>
    	                    <th>Action</th>
    	                    <!-- <th style="width: 40px">Label</th> -->
    	                </tr>
                        @if(count($categoryData)>0)
                            @foreach($categoryData as $cateData)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $cateData->category_name }}</td>
                                <td>{{ $cateData->category_title }}</td>
                                <td>
                                    @if(strlen($cateData->category_description)>100)
                                        {{ substr($cateData->category_description,0,100)."..." }}
                                        @else
                                            {{ $cateData->category_description }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin-category.destroy',$cateData->id) }}" method="post">
                                        <a href="{{ route('admin-category.show',$cateData->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="{{ route('admin-category.edit',$cateData->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-warning"><center><i class="fa fa-times"></i> No category registered yet!</center></td>
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