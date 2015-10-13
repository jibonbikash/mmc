<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_action_button_container" class="system_action_button_container">
<?php
    $CI->load_view('system_action_buttons');
?>
</div>
<div class="clearfix"></div>
<?php
foreach($components as $component_info)
{
    ?>
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $component_info['name_'.$CI->get_language_code()]; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_EN'); ?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label class="form-control"><?php echo $component_info['name_en'];?></label>
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_BN'); ?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label class="form-control"><?php echo $component_info['name_bn'];?></label>
            </div>
        </div>
        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('ICON'); ?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label class="form-control"><?php echo $component_info['icon'];?></label>
            </div>
        </div>
        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('DESCRIPTION'); ?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label class="form-control"><?php echo $component_info['description'];?></label>

            </div>
        </div>
        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('ORDERING'); ?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label class="form-control"><?php echo $component_info['ordering'];?></label>
            </div>
        </div>
        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <label class="form-control">
                    <?php
                    if($component_info['status']==1)
                    {
                        echo $CI->lang->line("ACTIVE");
                    }
                    else if($component_info['status']==0)
                    {
                        echo $CI->lang->line("INACTIVE");
                    }
                    else
                    {
                        echo $component_info['status'];
                    }

                    ?>
                </label>
            </div>
        </div>




    </div>
    <?php
}
?>
    <div class="clearfix"></div>

