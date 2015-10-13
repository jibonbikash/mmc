<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">

</div>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        //$CI->load_view('system_action_buttons');
        ?>
    </div>
    <div id="system_dataTable">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        turn_off_triggers();

        var url = "<?php echo $CI->get_encoded_url('admin/find_suggestion/get_suggestions');?>";
        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'edit_link', type: 'string' },
                { name: 'uisc_name', type: 'string' },
                { name: 'uisc_email', type: 'string' },
                { name: 'uisc_mobile', type: 'string' },
                { name: 'suggestion', type: 'string' }
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
                autoheight: true,
                columns: [
                    { text: '<?php echo $CI->lang->line('UISC_NAME'); ?>', dataField: 'uisc_name',width:'30%'},
                    { text: '<?php echo $CI->lang->line('EMAIL'); ?>', dataField: 'uisc_email',width:'17%'},
                    { text: '<?php echo $CI->lang->line('MOBILE'); ?>', dataField: 'uisc_mobile',width:'15%'},
                    { text: '<?php echo $CI->lang->line('SUGGESTION'); ?>', dataField: 'suggestion',width:'35%'}
                ]
            });
        <?php
            if($CI->permissions['edit'])
            {
                ?>
                $('#system_dataTable').on('rowDoubleClick', function (event)
                {
                    $(".popContainer").show();
                    $(".modal_data").html('');
                    $("#bgBlack").show();

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