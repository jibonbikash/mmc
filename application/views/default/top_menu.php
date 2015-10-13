<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
//echo "<pre>";
//print_r($user);
//echo "</pre>";
if($user)
{


    //$CI->load_view('sidebar_left');
    $components=User_helper::get_task_module_component($CI->config->item('system_sidebar01'));
    //    echo "<pre>";
    //    print_r($components);
    //    echo "</pre>";
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="top-nav" style="clear:both; border-bottom:1px solid gray;display:inline-table;width:100%;">
                <ul class="nav1">
                    <li><a href="<?php echo base_url();?>home/dashboard">ড্যাশবোর্ড</a></li>
                    <?php
                    foreach($components as $component)
                    {

                         foreach($component['modules'] as $module)
                         {
                         ?>
                             <li><a class="external" href="#"><?php echo $module['module_name']; ?></a>
                             <ul class="subs">
                         <?php
                             foreach($module['tasks'] as $task)
                             {
                                 ?>
                                     <li>
                                         <a href="<?php echo $CI->get_encoded_url($task['controller']); ?>">
                                             <i class="<?php echo $task['task_icon']; ?>"></i>
                                             <?php echo $task['task_name']; ?>
                                         </a>
                                     </li>
                                <?php
                             }
                             ?>
                             </ul>
                             </li>
                             <?php
                         }
                         ?>
                        <?php
                    }
                    ?>
                    <li><a href="<?php echo base_url();?>report/report_home/">প্রতিবেদন</a></li>
                    <li><a href="<?php echo base_url();?>home/logout/">লগ আউট</a></li>
                </ul>

                <div class="clearfix"> </div>
            </div>
        </div>
<!--        --><?php
//        $uisc=User_helper::get_uisc_info();
//        if(sizeof($uisc)>0)
//        {
//            ?>
<!--            <div class="col-lg-12 text-right">-->
<!--                <p class="text-primary">-->
<!--                    সেবা কেন্দ্রের নাম: --><?php //echo $uisc->uisc_name;?>
<!--                </p>-->
<!--            </div>-->
<!--            <div class="clearfix"> </div>-->
<!--            <br />-->
<!--            --><?php
//        }
//        ?>

    </div>
    <?php
}
else
{
    ?>
    <style>
	.nav1 li a{
		min-width:130px;
		border-radius:10px 10px 0px 0px;
		padding-left:5px;
		padding-right:5px;
		margin-left:5px;
		margin-right:5px;
		
	}
	</style>
    <!-- start top menu-->
    <div class="row">
        <div class="col-lg-12">
            <div class="top-nav" style="clear:both; border-bottom:1px solid #CCC;display:inline-table;">
                <ul class="nav1">
                    <li><a href="<?php echo base_url();?>">প্রথম পাতা</a></li>
                    <li>
                        <a class="external" href="<?php echo base_url().'home/registration';?>">রেজিস্ট্রেশন</a>
                        
                    </li>
                    <li><a class="external" href="#">রেজিষ্ট্রেশন নির্দেশনা</a>
                        <ul class="subs">
                            <li><a class="external" href="<?php echo base_url().'website/registration_direction';?>">রেজিস্ট্রেশন নির্দেশনা</a></li>
                            <li><a class="external" href="<?php echo base_url().'website/registration_form';?>">রেজিস্ট্রেশন ফরম</a></li>
                        </ul>
                    </li>
                    <li><a class="external" href="#">ই-সেবাসমূহ</a>
                        <ul class="subs">
                            <li><a href="<?php echo base_url().'website/eservice_list';?>">সেবাসমূহের তালিকা</a></li>
                        </ul>
                    </li>
                    <li><a class="external" href="#"> হেল্প ডেস্ক</a>
                        <ul class="subs">
                            <li><a class="external" href="<?php echo base_url().'website/user_direction';?>">ব্যবহারকারী নির্দেশনা</a></li>
                            <li><a href="<?php echo base_url().'website/help_desk_contact';?>">হেল্প ডেস্কে যোগাযোগ</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url();?>media/media_corner/">মিডিয়া কর্ণার</a></li>
                    <li><a class="" href="<?php echo base_url();?>notice_management/public_notice/">বিজ্ঞপ্তি</a></li>
                    <li><a class="" href="<?php echo base_url();?>home/login/">লগইন</a></li>

                </ul>

                <div class="clearfix">
                </div>
            </div>
        </div>
    </div>
    <!--end top menu-->
    <?php
}

?>
