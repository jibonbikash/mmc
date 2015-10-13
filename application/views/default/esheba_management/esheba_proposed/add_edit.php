<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

//echo "<pre>";
//print_r($ServiceInfo);
//echo "</pre>";
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <?php
    //print_r($ServiceInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('esheba_management/Esheba_proposed/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($ServiceInfo['service_id'])){echo $ServiceInfo['service_id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('SERVICE_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="service_detail[service_name]" class="form-control" value="<?php echo $ServiceInfo['service_name'];?>" />
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('SERVICE_TYPE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="service_detail[service_type]" class="form-control" value="<?php echo $ServiceInfo['service_type'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('SERVICE_AMOUNT'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="service_detail[service_amount]" class="form-control OnlyNumber" value="<?php echo $ServiceInfo['service_amount'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('WEBSITE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="service_detail[website]" class="form-control" value="<?php echo $ServiceInfo['website'];?>">
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="service_detail[status]" class="form-control" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('PROPOSED_SERVICE'),'value'=>$this->config->item('STATUS_INACTIVE')),array('text'=>$CI->lang->line('APPROVED_SERVICE'),'value'=>$this->config->item('STATUS_ACTIVE'))),'drop_down_selected'=>$ServiceInfo['status']));
                        ?>
                    </select>
                </div>
            </div>

        </div>
    </form>
</div>

