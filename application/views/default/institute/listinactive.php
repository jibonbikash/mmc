<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
 $user = User_helper::get_user();
// print_r($user);
//echo 'sdsdsdsdss';
 //echo $user_division = $user->division.'dfdfd';
 //echo $this->config->item('DIVISION_GROUP_ID').'erere';
 //echo $user->user_group_id;
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
    //   $CI->load_view('system_action_buttons');
        ?>
    </div>
    <div id="system_dataTable">
    </div>
    
</div>


<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        var url = "<?php echo $CI->get_encoded_url('institute/Institute/get_listinactive');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'edit_link', type: 'string' },
                { name: 'name', type: 'string' },
                { name: 'email', type: 'string' },
                { name: 'education_type_ids', type: 'string' },
                { name: 'mobile', type: 'string' },
                { name: 'status', type: 'string' }
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#system_dataTable").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                filterable: true,
                sortable: true,
                showfilterrow: true,
                columnsresize: true,
                pagesize:<?php echo $this->config->item('page_size');?>,
                pagesizeoptions: ['10', '20', '30', '50','100','150'],
                selectionmode: 'checkbox',
                altrows: true,
                autoheight: true,

                columns: [
                    { text: '<?php echo $CI->lang->line('SCHOOL_NAME'); ?>', dataField: 'name', width:'25%'},
                    { text: '<?php echo $CI->lang->line('SCHOOL_EMAIL'); ?>', dataField: 'email', width:'25%'},
                    { text: '<?php echo $CI->lang->line('EDUCATION_TYPE'); ?>', dataField: 'education_type_ids', width:'15%'},
                    { text: '<?php echo $CI->lang->line('SCHOOL_MOBILE'); ?>', dataField: 'mobile', width:'18%'},
                    { text: '<?php echo $CI->lang->line('STATUS'); ?>', dataField: 'status', width:'10%'}
                ]
            });
            
        //for Double Click to edit
        $('#system_dataTable').on('rowDoubleClick', function (event)
        {
            var edit_link=$('#system_dataTable').jqxGrid('getrows')[event.args.rowindex].edit_link;

            $.ajax({
                url: edit_link,
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
    });
</script>