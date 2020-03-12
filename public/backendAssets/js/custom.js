setTimeout(function(){ $(".alert-success").hide(); },3000);
setTimeout(function(){ $(".alert-danger").hide(); },3000);
// for category exist or not
function checking_pre_add(main_id)
{
    var main_name = jQuery("#category_name_check").val();
    $.ajax({
        url: '/checking_category_exist',
        type: 'GET',
        data: {main_id:  main_id, main_name: main_name},
        dataType: 'json',
        success:  function(event)
        {
            if(event == false)
            {
                $(':button[type="submit"]').prop('disabled', true);
                $(".text-danger").show();
                $(".text-danger").html("This Category Already Added");
            }
            else if(event == true)
            {
                $(".text-danger").hide();
                $(':button[type="submit"]').prop('disabled', false);
            }
        }
    })
}

// for question added or not
function checking_question_exist(main_id)
{
    var main_name = jQuery("#ques_ajax_name").val();
    $.ajax({
        url: '/checking_question_exist',
        type: 'GET',
        data: {main_id:  main_id, main_name: main_name},
        dataType: 'json',
        success:  function(event)
        {
            if(event == false)
            {
                $(':button[type="submit"]').prop('disabled', true);
                $(".text-danger").show();
                $(".text-danger").html("This Question Already Added");
            }
            else if(event == true)
            {
                $(".text-danger").hide();
                $(':button[type="submit"]').prop('disabled', false);
            }
        }
    })
}

// success modal show always
$(function(){
    $("#succ-modal").modal('hide');
    // new category show
    $.ajax({
        url: '/countAjaxCall',
        type: 'get',
        dataType: 'json',
        success:  function(event)
        {
            var count_flag;
            if(event < 10)
            {
                count_flag = "0"+event;
            }
            else
            {
                count_flag = event;
            }
            jQuery("#dash-cate-count").html(count_flag);
        },
        error: function(event)
        {
            console.log('errors');
        }
    })
    // new questions show
    $.ajax({
        url: '/countAjaxQuesCall',
        type: 'get',
        dataType: 'json',
        success:  function(event)
        {
            var count_flag;
            if(event < 10)
            {
                count_flag = "0"+event;
            }
            else
            {
                count_flag = event;
            }
            jQuery("#dash-ques-count").html(count_flag);
        },
        error: function(event)
        {
            console.log('errors');
        }
    })
    // all category fetch
    $.ajax({
        url: '/ajax_all_category',
        type: 'get',
        dataType: 'json',
        success:  function(event)
        {
            console.log(event);

            var html = '';
            for(var i = 0; i < event.length; i++)
            {
                html += "<option value='"+event[i].id+"'>"+event[i].category_name+"</option>";
            }
            jQuery(".multi-cate").html(html)
        },
        error: function(event)
        {
            console.log('errors');
        }
    })
});



