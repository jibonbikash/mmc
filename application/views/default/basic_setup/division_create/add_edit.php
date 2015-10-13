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
    //print_r($divisionInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('basic_setup/Division_create/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($divisionInfo['divid'])){echo $divisionInfo['divid'];}else{echo 0;}?>"/>
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
                    <label class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_CODE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="division_detail[divid]" class="form-control" value="<?php echo $divisionInfo['divid'];?>" <?php if($divisionInfo['divid']>0){echo "readonly";}?>>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_BN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="division_detail[divname]" class="form-control" value="<?php echo $divisionInfo['divname'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_EN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="division_detail[divnameeng]" class="form-control" value="<?php echo $divisionInfo['divnameeng'];?>">
                </div>
            </div>

        </div>
    </form>
</div>

