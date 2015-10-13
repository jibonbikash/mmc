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

    <?php
    //print_r($ZillaInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('basic_setup/Zilla_create/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($ZillaInfo['id'])){echo $ZillaInfo['id'];}else{echo 0;}?>"/>
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
                    <select name="zilla_detail[divid]" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>$ZillaInfo['divid']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ZILLA_NAME_BN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="zilla_detail[zillaname]" class="form-control" value="<?php echo $ZillaInfo['zillaname'];?>">
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="zilla_detail[visible]" class="form-control" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('INACTIVE'),'value'=>0),array('text'=>$CI->lang->line('ACTIVE'),'value'=>1)),'drop_down_selected'=>$ZillaInfo['visible']));
                        ?>
                    </select>
                </div>
            </div>

        </div>
    </form>
</div>

