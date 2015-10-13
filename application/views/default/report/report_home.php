<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
?>
<div id="system_content" class="system_content_margin">
    <div class="col-lg-4 system_action_button_container">
        <?php
        $CI->load_view("report/report_menus");
        ?>

    </div>
    <div class="col-lg-8">

    </div>
    <div class="clearfix"></div>
</div>

