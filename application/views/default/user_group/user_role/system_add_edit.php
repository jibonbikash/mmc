<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
<div id="system_action_button_container" class="system_action_button_container">
    <?php
    $CI->load_view('system_action_buttons');
    //echo "<pre>";
    //print_r($access_tasks);
    //echo "</pre>";
    //echo "<pre>";
    //print_r($role_status);
    //echo "</pre>";

    $modules=array();
    foreach($access_tasks as $task)
    {
        $modules[$task['module_id']]['component_id']=$task['component_id'];
        $modules[$task['module_id']]['component_name']=$task['component_name'];
        $modules[$task['module_id']]['module_name']=$task['module_name'];
        $modules[$task['module_id']]['module_id']=$task['module_id'];
        $modules[$task['module_id']]['tasks'][]=$task;

    }
    $components=array();
    foreach($modules as $module)
    {
        $components[$module['component_id']]['component_id']=$module['component_id'];
        $components[$module['component_id']]['component_name']=$module['component_name'];
        $components[$module['component_id']]['modules'][]=$module;
    }
    //echo "<pre>";
    //print_r($components);
    //echo "</pre>";
    ?>
</div>

<div class="clearfix"></div>
<form id="system_save_form" action="<?php echo $CI->get_encoded_url('user_group/user_role/index/save') ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-xs-12" style="overflow-x: auto;">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line("COMPONENT_NAME"); ?></th>
                    <th><?php echo $this->lang->line("MODULE_NAME"); ?></th>
                    <th><?php echo $this->lang->line("TASK_NAME"); ?></th>
                    <th><?php echo $this->lang->line("LIST"); ?></th>
                    <th><?php echo $this->lang->line("VIEW"); ?></th>
                    <th><?php echo $this->lang->line("ADD"); ?></th>
                    <th><?php echo $this->lang->line("EDIT"); ?></th>
                    <th><?php echo $this->lang->line("DELETE"); ?></th>
                    <th><?php echo $this->lang->line("PRINT"); ?></th>
                    <th><?php echo $this->lang->line("REPORT"); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($components)>0)
                {
                    foreach($components as $component)
                    {
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" data-id='<?php echo $component['component_id']; ?>' class="component_name"><?php echo $component['component_name'];?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach($component['modules'] as $module)
                        {
                            ?>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" data-id='<?php echo $module['module_id']; ?>' class="module_name component_action_<?php echo $component['component_id'];?>"><?php echo $module['module_name'];?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                            <?php
                            foreach($module['tasks'] as $task)
                            {
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="tasks[<?php echo $task['task_id'];?>][ugr_id]" value="<?php echo isset($role_status['ugr_id'][$task['task_id']])?$role_status['ugr_id'][$task['task_id']]:0;?>">
                                        <input type="hidden" name="tasks[<?php echo $task['task_id'];?>][task_id]" value="<?php echo $task['task_id'];?>">
                                        <input type="hidden" name="tasks[<?php echo $task['task_id'];?>][module_id]" value="<?php echo $task['module_id'];?>">
                                        <input type="hidden" name="tasks[<?php echo $task['task_id'];?>][component_id]" value="<?php echo $task['component_id'];?>">
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" data-id='<?php echo $task['task_id'];?>' class="task_name module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>"><?php echo $task['task_name'];?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['list'])
                                        {
                                            ?>
                                            <input title="list" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['list'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][list]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['view'])
                                        {
                                            ?>
                                            <input title="view" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['view'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][view]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['add'])
                                        {
                                            ?>
                                            <input title="add" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['add'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][add]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['edit'])
                                        {
                                            ?>
                                            <input title="edit" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['edit'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][edit]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['delete'])
                                        {
                                            ?>
                                            <input title="delete" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['delete'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][delete]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['report'])
                                        {
                                            ?>
                                            <input title="report" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['report'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][report]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($task['print'])
                                        {
                                            ?>
                                            <input title="print" class="task_action_<?php echo $task['task_id'];?> module_action_<?php echo $module['module_id'];?> component_action_<?php echo $component['component_id'];?>" type="checkbox" <?php if(in_array($task['task_id'],$role_status['print'])){echo 'checked';}?> value="1" name='tasks[<?php echo $task['task_id'];?>][print]'>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }

                        }
                        ?>
                    <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="20" class="text-center alert-danger">
                            <?php echo $this->lang->line("NO_DATA_FOUND"); ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>
</form>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        $(document).on("click",'.task_name',function()
        {
            console.log('task_action clicked');
            if($(this).is(':checked'))
            {
                $('.task_action_'+$(this).attr('data-id')).prop('checked', true);

            }
            else
            {
                $('.task_action_'+$(this).attr('data-id')).prop('checked', false);
            }

        });
        $(document).on("click",'.module_name',function()
        {
            console.log('module_action clicked');
            if($(this).is(':checked'))
            {
                $('.module_action_'+$(this).attr('data-id')).prop('checked', true);

            }
            else
            {
                $('.module_action_'+$(this).attr('data-id')).prop('checked', false);
            }

        });
        $(document).on("click",'.component_name',function()
        {
            console.log('component_action clicked');
            if($(this).is(':checked'))
            {
                $('.component_action_'+$(this).attr('data-id')).prop('checked', true);

            }
            else
            {
                $('.component_action_'+$(this).attr('data-id')).prop('checked', false);
            }

        });


    });
</script>