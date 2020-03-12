$(function(){
    jQuery("#upload_docx").hide();
    // ckeditor on textarea
    CKEDITOR.replace( 'docx-show-details' );
    function updateDiv(){
        var editorText = CKEDITOR.instances.editor1.getData();
        $('#trackingDiv').html(editorText);
    }
})
function docx_download_check()
{
    if(jQuery("#docx_download").prop('checked') == true)
    {
        $("#upload_docx").show();
        $("#docx_download").val(1);
    }
    else
    {
        jQuery("#upload_docx").hide();
        $("#docx_download").val(0);
    }
}