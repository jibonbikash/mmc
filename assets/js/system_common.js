//system_redirect_url for redirect page
//page url to set current page link
//system_content for replace views
//system_message to display a message
//system_page_title for title of the page
//system_style for setting style for elements
//system_redirect_url will redirect page

//$("#system_save_new_status") mandatory for save buttons as form input field
//for browse buttons data-preview-container and data-preview-height for image display
//system_loading will show on ajaxstart and hide on ajaxcomplete
//data-form attribute contains form name for save,save and new, clear buttons

$(document).ready(function()
{
    $(document).ajaxStart(function()
    {
        $("#system_loading").show();

    });
    $(document).ajaxStop(function ()
    {

    });
    $(document).ajaxSuccess(function(event,xhr,options)
    {
        if(xhr.responseJSON)
        {
            if(xhr.responseJSON.system_content)
            {
                load_template(xhr.responseJSON.system_content);
            }
            if(xhr.responseJSON.system_style)
            {
                load_style(xhr.responseJSON.system_style);
            }

        }
    });
    $(document).ajaxComplete(function(event,xhr,options)
    {
        if(xhr.responseJSON)
        {
            if(xhr.responseJSON.system_redirect_url)
            {
                window.location.replace(xhr.responseJSON.system_redirect_url);

                //window.history.pushState(null, "Search Results",xhr.responseJSON.page_url);
                //window.history.replaceState(null, "Search Results",xhr.responseJSON.system_page_url);
            }
            if(xhr.responseJSON.system_page_url)
            {
                //window.history.pushState(null, "Search Results",xhr.responseJSON.system_page_url);
                window.history.replaceState(null, "Search Results",xhr.responseJSON.system_page_url);
            }

            //$("#loading").hide();
            $("#system_loading").hide();
            if(xhr.responseJSON.system_message)
            {
                animate_message(xhr.responseJSON.system_message);
            }
            if(xhr.responseJSON.system_page_title)
            {
                $('title').html(xhr.responseJSON.system_page_title);
            }

        }
    });
    $(document).ajaxError(function(event,xhr,options)
    {

        $("#system_loading").hide();
        animate_message("Request Error");

    });
    //binds form submission with ajax
    $(document).on("submit", "form", function(event)
    {
        if($(this).is('[class*="report_form"]'))
        {
            window.open('','form_popup','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=500,left = 10,top = 10,scrollbars=yes');
            this.target = 'form_popup';
            return true;
        }

        if($(this).is('[class*="external"]'))
        {
            return true;
        }
        event.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data, status)
            {

            },
            error: function (xhr, desc, err)
            {


            }
        });
    });
    //bind any anchor tag to ajax request
    $(document).on("click", "a", function(event)
    {

        if(($(this).is('[class*="jqx"]'))||($(this).is('[class*="dropdown"]'))||($(this).is('[class*="external"]'))||($(this).is('[class*="ui-corner-all"]')))
        {
            return;
        }
        event.preventDefault();
        $.ajax({
            url: $(this).attr("href"),
            type: 'POST',
            dataType: "JSON",
            success: function (data, status)
            {

            },
            error: function (xhr, desc, err)
            {
                console.log("error");

            }
        });

    });
    $(document).on("click", "#button_action_clear", function(event)
    {

        $($(this).attr('data-form')).trigger('reset');

    });
    $(document).on("click", "#button_action_save", function(event)
    {
        $("#system_save_new_status").val(0);
        $($(this).attr('data-form')).submit();

    });
    $(document).on("click", "#button_action_save_new", function(event)
    {
        $("#system_save_new_status").val(1);
        $($(this).attr('data-form')).submit();

    });
    $(document).on("click", ".button_action_batch", function(event)
    {
        if($(this).attr('id')=='button_action_delete')
        {

            var sure = confirm(DELETE_CONFIRM);
            if(!sure)
            {
                return;
            }
        }
        var jqxgrdi_id=$(this).attr('data-jqxgrid');

        var selected_rows = $(jqxgrdi_id).jqxGrid('getselectedrowindexes');
        var selectedcount = selected_rows.length;
        if (selectedcount > 0)
        {
            var data=$(jqxgrdi_id).jqxGrid('getrows');
            var ids=[];
            for (var i = 0; i < selectedcount; i++)
            {
                ids.push(data[selected_rows[i]].id);
            }

            $.ajax({
                url: $(this).attr('data-action-link'),
                type: 'POST',
                dataType: "JSON",
                data:{'selected_ids':ids},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");

                }
            });


        }
        else
        {
            alert(SELCET_ONE_ITEM);
        }

    });

    //load the current page content
    load_current_content();
    // binds form submission and fields to the validation engine
    $(document).on("change", ":file", function(event)
    {
        if(($(this).is('[class*="file_external"]')))
        {
            return;
        }
        var container=$(this).attr('data-preview-container');
        if(container)
        {
            if(this.files && this.files[0])
            {
                var file_type=this.files[0].type;
                if(file_type && file_type.substr(0,5)=="image")
                {
                    var preview_height=200;
                    if($(this).attr('data-preview-height'))
                    {
                        preview_height=$(this).attr('data-preview-height');
                    }
                    var reader = new FileReader();

                    reader.onload = function (e)
                    {
                        var img_tag='<img height="'+preview_height+'" src="'+ e.target.result+'" >';
                        $(container).html(img_tag);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
                else
                {
                    $(container).html(this.files[0].name);
                }
            }
        }
        else
        {
            console.log('no container');
        }

    });

});
function load_current_content()
{
    $.ajax({
        url: location,
        type: 'POST',
        dataType: "JSON",
        success: function (data, status)
        {

        },
        error: function (xhr, desc, err)
        {
            console.log("error");

        }
    });
}
function load_template(content)
{
    for(var i=0;i<content.length;i++)
    {
        $(content[i].id).html(content[i].html);

    }
}
function load_style(content)
{
    for(var i=0;i<content.length;i++)
    {
        if(content[i].style)
        {
            $(content[i].id).attr('style',content[i].style);
        }
        if(content[i].display)
        {
            $(content[i].id).show();
        }
        else
        {
            $(content[i].id).hide();
        }
    }
}
function animate_message(message)
{
    $("#system_message").hide();
    $("#system_message").html(message);
    $('#system_message').slideToggle("slow").delay(3000).slideToggle("slow");
    //$('#message').toggle("slide",{direction:"right"},500);

}

function StringHasUpperCase(str)
{
    if(/[A-Z]/.test(str))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function StringHasLowerCase(str)
{
    if(/[a-z]/.test(str))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function StringHasNumber(str)
{
    if(/[0-9]/.test(str))
    {
        return true;
    }
    else
    {
        return false;
    }
}

$(document).on("keyup", ".OnlyNumber", function()
{
    this.value = this.value.replace(/[^0-9\.]/g,'');
});

function turn_off_triggers()
{
    $(document).off("change", "#component_options");
    $(document).off("click", "#checked");
    $(document).off("click", ".system_add_more_button");
    $(document).off("click", ".system_add_more_delete");
    $(document).off("click", ".system_add_more_edu_button");
    $(document).off("click", ".system_add_more_edu_delete");
    $(document).off("click", ".system_add_more_experience_button");
    $(document).off("click", ".system_add_more_experience_delete");
    $(document).off("click", ".task_name");
    $(document).off("click", ".module_name");
    $(document).off("click", ".component_name");
    $(document).off("change", "#education_units");
    $(document).off("change", "#user_type");
    $(document).off("change", "#user_list");
    $(document).off("change", "#teacher_resume");
    $(document).off("change", "#teacher_picture");
    $(document).off("change", "#select_all_subject");
    $(document).off("change", "#faculty_options");
    $(document).off("change", "#department_options");
    $(document).off("change", "#teacher_options");
    $(document).off("click", ".dueDates");

    // G.O. Location
    $(document).off("change", "#user_group_id");
    $(document).off("change", "#user_division_id");
    $(document).off("change", "#user_zilla_id");
    $(document).off("change", "#user_upazila_id");
    $(document).off("change", "#user_citycorporation_id");
    $(document).off("change", "#user_municipal_id");
    $(document).off("click", "#upload_button");
    $(document).off("change", ".user_group");
}
