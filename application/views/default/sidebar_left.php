<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$components=User_helper::get_task_module_component($CI->config->item('system_sidebar01'));

?>
<div class="sidebar">
    <ul class="sidebar-menu">
        <?php
        foreach($components as $component)
        {
            ?>
            <li class="treeview">
                <a class="external" href="#"><i class="<?php echo $component['component_icon']; ?>"></i><span><?php echo $component['component_name'] ?></span></a>
                <ul class="treeview-menu">
                    <?php
                    foreach($component['modules'] as $module)
                    {
                        ?>
                        <li class="treeview">
                            <a class="external" href="#"><i class="<?php echo $module['module_icon']; ?>"></i><?php echo $module['module_name']; ?></a>
                            <ul class="treeview-menu">
                                <?php
                                foreach($module['tasks'] as $task)
                                {
                                    ?>
                                    <li>
                                        <a class="" href="<?php echo $CI->get_encoded_url($task['controller']); ?>"><i class="<?php echo $task['task_icon']; ?>"></i><?php echo $task['task_name']; ?></a>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
                <?php
                ?>

            </li>
        <?php
        }
        ?>
    </ul>
</div>
<div class="clearfix"></div>
<script type="text/javascript">


    $(document).ready(function()
    {
        $('#system_wrapper').removeClass('wrapper_login');
        $(".sidebar .treeview").tree();
    });
</script>
