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
    $(document).ready(function () {
        turn_off_triggers();
        var url = "<?php echo $CI->get_encoded_url('system_setup/module/get_modules');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'edit_link', type: 'string' },
                { name: 'module_name', type: 'string' },
                { name: 'component_name', type: 'string' },
                { name: 'module_icon', type: 'string' },
                { name: 'ordering', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'status_text', type: 'string' }
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
                pagesize:10,
                pagesizeoptions: ['10', '20', '30', '50','100','150'],
                selectionmode: 'checkbox',
                altrows: true,
                autoheight: true,
                columns: [
                    { text: '<?php echo $CI->lang->line('NAME'); ?>', dataField: 'module_name',width:'21%'},
                    { text: '<?php echo $CI->lang->line('COMPONENT_NAME'); ?>', dataField: 'component_name',width:'150'},
                    { text: '<?php echo $CI->lang->line('ICON'); ?>', dataField: 'module_icon',width:'200'},
                    { text: '<?php echo $CI->lang->line('DESCRIPTION'); ?>', dataField: 'description',width:'26%'},
                    { text: '<?php echo $CI->lang->line('ORDERING'); ?>', dataField: 'ordering',cellsalign: 'right',width:'100'},
                    { text: '<?php echo $CI->lang->line('STATUS'); ?>', dataField: 'status_text',cellsalign: 'right',width:'100'}
                ]
            });
        <?php
            if($CI->permissions['edit'])
            {
                ?>
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
                <?php
            }
        ?>
    });
</script>