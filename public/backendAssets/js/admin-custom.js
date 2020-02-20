function add_more(i_value)
{
	var i = i_value+1;
	$(".option-label-section").append('<div class="main-contain-class"  id="qls'+i+'"><span><a href="javascript:;" onclick="add_more('+i+')"><i class="fa fa-plus"></i></a> <a href="javascript:;" onclick="less_more('+i+')"><i class="fa fa-minus"></i></a></span><div class="input-group"><div class="input-group-addon"><i class="fa fa-info"></i></div><input class="form-control" name="Options_description[]" /></div></div>');
}

function less_more(i_value)
{
	$("#qls"+i_value).remove();
}