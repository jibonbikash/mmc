<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$user = User_helper::get_user();
//$modules=User_helper::get_task_module($CI->config->item('system_sidebar02'));
?>
<div class="row panel-heading">
    <div class="col-lg-1">
        <a href="#">
            <!--            <img src="--><?php //echo base_url().'assets/templates/'.$CI->get_template(); ?><!--/images/login_logo.png" class="img-responsive" alt="Cinque Terre" style="margin: auto;">-->
            <img src="<?php echo base_url().'images/logo/bd.png';?>" class="img-responsive" alt="Cinque Terre" style="margin: auto; height:72px;">
        </a>
    </div>
    <div class="col-lg-10 text-center">
        <h1>
            <?php
            if($user)
            {
                if($user->uisc_type==$CI->config->item('ONLINE_UNION_GROUP_ID'))
                {
                    echo $this->lang->line('WEBSITE_TITLE_UNION');
                }
                elseif($user->uisc_type==$CI->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'))
                {
                    echo $this->lang->line('WEBSITE_TITLE_CITY');
                }
                elseif($user->uisc_type==$CI->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'))
                {
                    echo $this->lang->line('WEBSITE_TITLE_MUNICIPAL');
                }
                else
                {
                    echo $this->lang->line('WEBSITE_TITLE');
                }
            }
            else
            {
                echo $this->lang->line('WEBSITE_TITLE');
            }
            ?>
        </h1>
    </div>
    <div class="col-lg-1">
        <a href="#">
            <!--            <img src="--><?php //echo base_url().'assets/templates/'.$CI->get_template(); ?><!--/images/login_logo.png" class="img-responsive" alt="Cinque Terre" style="margin: auto;">-->
            <img src="<?php echo base_url().'images/logo/a2i.png';?>" class="img-responsive" alt="Cinque Terre" style="margin: auto; height:72px;">
        </a>
    </div>
</div>