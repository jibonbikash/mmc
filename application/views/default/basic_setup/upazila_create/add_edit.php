<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

if($UpazilaInfo['id']>0)
{
    $display_zilla='none';
}
else
{
    $display_zilla='none';
}
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <?php
    //print_r($UpazilaInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('basic_setup/upazila_create/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($UpazilaInfo['id'])){echo $UpazilaInfo['id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row show-grid " >
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="upazila_detail[divid]" id="user_division_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>$UpazilaInfo['divid']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_zilla; ?>" class="row show-grid " id="zilla_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ZILLA_NAME_BN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="upazila_detail[zillaid]" id="user_zilla_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$zillas,'drop_down_selected'=>$userInfo['zillaid']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILA_NAME_BN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="upazila_detail[upazilaname]" class="form-control" value="<?php echo $UpazilaInfo['upazilaname'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILA_NAME_EN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="upazila_detail[upazilanameeng]" class="form-control" value="<?php echo $UpazilaInfo['upazilanameeng'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('GO_CODE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="upazila_detail[upazilaid]" class="form-control" value="<?php echo $UpazilaInfo['upazilaid'];?>">
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="upazila_detail[visible]" class="form-control" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('INACTIVE'),'value'=>0),array('text'=>$CI->lang->line('ACTIVE'),'value'=>1)),'drop_down_selected'=>$UpazilaInfo['visible']));
                        ?>
                    </select>
                </div>
            </div>

        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $(document).on("change","#user_division_id",function()
        {
            $("#zilla_option").show();
            $("#user_zilla_id").val("");
            var division_id=$(this).val();
            if(division_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id:division_id},
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
                $("#zilla_option").hide();
            }
        });
    })
</script>