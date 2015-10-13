<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_action_button_container" class="system_action_button_container">
    <?php
    //$CI->load_view('system_action_buttons');

    ?>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/3dtimeline/css/style.css" />
<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/3dtimeline/js/modernizr.custom.63321.js"></script>

<style>
    body {
        background: #e9e9e9;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

.user-3 {
	background-image:url(<?php echo $CI->get_encoded_url('images/logo/a2i_user.png'); ?>);
}

</style>


<div class="clearfix"></div>
<div id="system_content" class="dashboard-wrapper">
    <div class="grid_12" >
        <div class="container">
            <section class="main">
                <ul class="timeline">
                    <?php
                    if(is_array($notices) && sizeof($notices)>0)
                    {
                        foreach($notices as $notice)
                        {
                        ?>
                        <li class="event">
                            <input type="radio" name="tl-group"/>
                            <label></label>
                            <div class="thumb user-3"><span><?php echo System_helper::Get_Eng_to_Bng(date('Y-m-d', $notice['create_date'])); ?></span></div>
                            <div class="content-perspective">
                                <div class="content">
                                    <div class="content-inner">
                                        <h3><?php echo $notice['notice_title'];?></h3>
                                        <p>
                                            <?php
                                            echo $notice['notice_details'];

                                            if($notice['upload_file']!='')
                                            {
                                                ?>
                                                <br/><br/>
                                                <a href="<?php echo base_url().'images/notice/'.$notice['upload_file']?>" target="_blank" class="external">
                                                    <?php echo $notice['upload_file']." ... <span style='color:red;'>".$CI->lang->line('CLICK_HERE_TO_DOWNLOAD')."</span>"; ?>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                        }
                    }
                    else
                    {
                        ?>
                        <label style="font-size: 22px;" class="fieldcell label label-warning"><?php echo $this->lang->line('NO_PUBLIC_NOTICE');?></label>
                    <?php
                    }
                    ?>
                </ul>
            </section>
        </div>
    </div>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
