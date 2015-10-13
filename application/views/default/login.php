<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>
<style>
    body {
        background: #e9e9e9;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

</style>


<div class='login_form aniamted bounceIn'>
    <div class='switch'>
        <i class='fa fa-support'></i>
        <div class='login_form tooltip'>Click Me</div>
    </div>
    <div class='login'>
        <h2><?php echo $this->lang->line('LOGIN_TITLE');?></h2>
        <form action="<?php echo $CI->get_encoded_url("home/login");?>" method="post">
            <input type="text"  placeholder="<?php echo $this->lang->line('USERNAME');?>" name="username" required autofocus>
            <input type="password"  placeholder="<?php echo $this->lang->line('PASSWORD');?>" name="password" required>
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo $this->lang->line('LOGIN');?>">
        </form>
    </div>
    <div class='register'>
        <h2>Want Help</h2>
        <div class='alert'>
            <div class='fa fa-times-circle'></div>
            User Manual
            <br/>
            Call Helpsystem
        </div>
    </div>
</div>




<div class="clearfix"></div>
<script type="text/javascript">

    $(document).ready(function()
    {
        $('#system_wrapper').addClass('wrapper_login');
    });

    $('.switch').click(function(){
        $(this).children('i').toggleClass('fa-pencil');
        $('.login').animate({height: "toggle", opacity: "toggle"}, "slow");
        $('.register').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>