<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
$modules=User_helper::get_reports_task_module();
//echo "<pre>";
//print_r($modules);
//echo "</pre>";
?>
<div>
    <div class="home_head_custom" style="">সারাদেশের প্রতিবেদন </div>
    <div class="home_txt_div_custom" style="">
        <div>
            <ul>
                <?php
                foreach($modules as $module)
                {
                    ?>
                    <li class="st_custom " style="text-align:center;color:#800081;font-weight:bold;font-family:NiKoshBan,Nikosh,Arial;">
                        <?php echo $module['module_name'] ;?>
                    </li>
                <?php
                    foreach($module['tasks'] as $task)
                    {
                        ?>
                            <li class="st_custom">
                                <a class="a_active <?php echo $task['task_icon']; ?>" href="<?php echo $CI->get_encoded_url($task['controller']); ?>">
                                    <span>
                                        <?php echo $task['task_name'];?>
                                    </span>
                                </a>
                            </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <br />
</div>
