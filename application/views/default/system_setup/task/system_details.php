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
    <div class="clearfix"></div>
    <?php
    foreach($tasks as $task_info)
    {
        ?>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $task_info['name_'.$CI->get_language_code()]; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_EN'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['name_en'];?></label>
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_BN'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['name_bn'];?></label>
                </div>
            </div>
            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('COMPONENT_NAME'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['component_name'];?></label>
                </div>
            </div>
            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MODULE_NAME'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['module_name'];?></label>
                </div>
            </div>
            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('CONTROLLER'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['controller'];?></label>
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ICON'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['icon'];?></label>
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('DESCRIPTION'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['description'];?></label>

                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ORDERING'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control"><?php echo $task_info['ordering'];?></label>
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="form-control">
                        <?php
                        if($task_info['status']==1)
                        {
                            echo $CI->lang->line("ACTIVE");
                        }
                        else if($task_info['status']==0)
                        {
                            echo $CI->lang->line("INACTIVE");
                        }
                        else
                        {
                            echo $task_info['status'];
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


</div>
