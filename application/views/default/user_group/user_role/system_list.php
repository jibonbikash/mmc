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
    <div id="system_dataTable">    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        turn_off_triggers();
        var url = "<?php echo $CI->get_encoded_url('user_group/user_role/get_roles_info');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'edit_link', type: 'string' },
                { name: 'group_name', type: 'string' },
                { name: 'total_component', type: 'int' },
                { name: 'total_module', type: 'int' },
                { name: 'total_task', type: 'int' },
                { name: 'last_modified', type: 'dateTime' }
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        // create jqxgrid.
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
                autoheight:true,
                autorowheight:true,
                columns: [
                    { text: '<?php echo $CI->lang->line('NAME'); ?>', dataField: 'group_name'},
                    { text: '<?php echo $CI->lang->line('TOTAL_COMPONENT'); ?>', dataField: 'total_component',cellsalign: 'right',width:'200'},
                    { text: '<?php echo $CI->lang->line('TOTAL_MODULE'); ?>', dataField: 'total_module',cellsalign: 'right',width:'200'},
                    { text: '<?php echo $CI->lang->line('TOTAL_TASKS'); ?>', dataField: 'total_task',cellsalign: 'right',width:'200'},
                    { text: '<?php echo $CI->lang->line('LAST_MODIFIED'); ?>', dataField: 'last_modified',cellsalign: 'right',width:'200'}
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