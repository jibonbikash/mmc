<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_sidebar_left" class="system_sidebar_left col-sm-1" style="padding-left:0;">&nbsp;</div>
<div id="system_content">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('system_setup/component/index/save') ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $component_info['id'];?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_EN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="name_en" class="form-control" value="<?php echo $component_info['name_en'];?>">
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_BN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="name_bn" class="form-control" value="<?php echo $component_info['name_bn'];?>">
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ICON'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="icon" class="form-control" value="<?php echo $component_info['icon'];?>">
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('DESCRIPTION'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <textarea name="description" class="form-control"><?php echo $component_info['description'];?></textarea>

                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ORDERING'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="ordering" class="form-control" value="<?php echo $component_info['ordering'];?>">
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="status" class="form-control" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('INACTIVE'),'value'=>0),array('text'=>$CI->lang->line('ACTIVE'),'value'=>1)),'drop_down_selected'=>$component_info['status']));
                        ?>
                    </select>
                </div>
            </div>




        </div>

        <div class="clearfix"></div>
    </form>

</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
    });
</script>