<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>
    <div id="system_dataTable">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        var url = "<?php echo $CI->get_encoded_url('faq_management/question_create/get_list');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
      //          { name: 'edit_link', type: 'string' },
                { name: 'question', type: 'string' },
                { name: 'question_made_to', type: 'string' },
                { name: 'ans_status', type: 'string' }
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
                    { text: '<?php echo $CI->lang->line('QUESTION'); ?>', dataField: 'question', width:'50%'},
                    { text: '<?php echo $CI->lang->line('QUESTION_MADE_TO'); ?>', dataField: 'question_made_to', width:'20%'},
                    { text: '<?php echo $CI->lang->line('STATUS'); ?>', dataField: 'ans_status', width:'28%'}
                ]
            });
        //for Double Click to edit
        
    });
</script>