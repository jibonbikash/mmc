<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
//$user=User_helper::get_user();

//report button not activated
//print button not activated
//echo $CI->permissions['add'];
?>
<style>
    .col-md-15{
        float: left;
        min-height: 1px;
        padding-left: 5px;
        padding-right: 5px;
        position: relative;
        width: 9.09%;
        box-sizing: border-box;
    }
    .top_action_button{
        width:99%;
        font-family:"Comic Sans MS", cursive;
        height:50px;
        font-size:12px;
    }
</style>
<div class="row">
<div class="col-md-15">
    <?php
    if(($CI->current_action=='list')&&($CI->permissions['add']))
    {
        ?>
        <a class="btn btn-success top_action_button" style="padding-left:15px;" id="button_action_add" href="<?php echo $CI->get_encoded_url($CI->controller_url.'/index/add'); ?>">
            <i class="fa fa-plus" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('NEW');?></a>
    <?php
    }
    else
    {
        ?>
        <a class="btn disabled btn-default top_action_button" style="padding-left:15px;" href="#">
            <i class="fa fa-plus" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('NEW');?></a>
    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <?php
    if(($CI->current_action=='list')&&($CI->permissions['edit']))
    {
        ?>
        <button id="button_action_edit" class="btn btn-success button_action_batch top_action_button" data-action-link="<?php echo $CI->get_encoded_url($CI->controller_url.'/index/batch_edit'); ?>" data-jqxgrid="#system_dataTable">
            <i class="fa fa-edit" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('EDIT');?></button>
    <?php
    }
    else
    {
        ?>
        <button class="btn disabled btn-default top_action_button">
            <i class="fa fa-edit" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('EDIT');?></button>
    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <?php
    if(($CI->current_action=='list')&&($CI->permissions['view']))
    {
        ?>
        <button id="button_action_details" class="btn btn-success button_action_batch top_action_button" data-action-link="<?php echo $CI->get_encoded_url($CI->controller_url.'/index/batch_details'); ?>" data-jqxgrid="#system_dataTable">
            <i class="fa fa-list" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('DETAILS');?></button>

    <?php
    }
    else
    {
        ?>
        <button class="btn disabled btn-default top_action_button">
            <i class="fa fa-list" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('DETAILS');?></button>
    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <?php
    if(($CI->current_action=='list')&&($CI->permissions['delete']))
    {
        ?>

        <button id="button_action_delete" class="btn btn-success button_action_batch top_action_button" data-action-link="<?php echo $CI->get_encoded_url($CI->controller_url.'/index/batch_delete'); ?>" data-jqxgrid="#system_dataTable">
            <i class="fa fa-remove" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('DELETE');?></button>
    <?php
    }
    else
    {
        ?>
        <button class="btn disabled btn-default top_action_button">
            <i class="fa fa-remove" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('DELETE');?></button>
    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <?php
    if((($CI->current_action=='add')&&($CI->permissions['add']))||(($CI->current_action=='edit')&&($CI->permissions['edit'])))
    {
        ?>
        <button class="btn btn-success top_action_button" id="button_action_save" data-form='#system_save_form'>
            <i class="fa fa-save" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('SAVE');?></button>
    <?php
    }
    else
    {
        ?>
        <button class="btn disabled btn-default top_action_button">
            <i class="fa fa-save" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('SAVE');?></button>
    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <?php
    if((($CI->current_action=='add')&&($CI->permissions['add']))||(($CI->current_action=='edit')&&($CI->permissions['edit'])))
    {
        ?>
        <button class="btn btn-success top_action_button" id="button_action_save_new" data-form='#system_save_form'>
            <i class="fa fa-share-square-o" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('SAVE_NEW');?></button>
    <?php
    }
    else
    {
        ?>
        <button class="btn disabled btn-default top_action_button">
            <i class="fa fa-share-square-o" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('SAVE_NEW');?></button>

    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <!--Report need to activate-->

    <button class="btn disabled btn-default top_action_button">
        <i class="fa fa-clipboard" style="font-size:20px"></i>
        <br/>
        <?php echo $CI->lang->line('REPORT');?></button>

</div>
<div class="col-md-15">
    <!--Report need to activate-->
    <button class="btn disabled btn-default top_action_button">
        <i class="fa fa-print" style="font-size:20px"></i>
        <br/>
        <?php echo $CI->lang->line('PRINT');?></button>
</div>
<div class="col-md-15">
    <?php
    if(($CI->current_action=='add')||($CI->current_action=='edit'))
    {
        ?>
        <button id="button_action_clear" data-form='#system_save_form' class="btn btn-success top_action_button">
            <i class="fa fa-eraser" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('CLEAR');?></button>
    <?php
    }
    else
    {
        ?>
        <button class="btn disabled btn-default top_action_button">
            <i class="fa fa-eraser" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('CLEAR');?></button>
    <?php
    }
    ?>
</div>
<div class="col-md-15">
    <?php
    if(($CI->current_action=='list'))
    {
        ?>
        <a class="btn btn-success top_action_button" href="<?php echo $CI->get_encoded_url($CI->controller_url); ?>">
            <i class="fa fa-refresh" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('REFRESH');?></a>
    <?php
    }
    else
    {
        ?>
        <a class="btn disabled btn-default top_action_button" href="#">
            <i class="fa fa-refresh" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('REFRESH');?></a>
    <?php
    }
    ?>

</div>
<div class="col-md-15">
    <?php
    if(($CI->current_action=='add')||($CI->current_action=='edit')||($CI->current_action=='batch_details'))
    {
        ?>
        <a class="btn btn-success top_action_button" style="padding-right:15px;" href="<?php echo $CI->get_encoded_url($CI->controller_url); ?>">
            <i class="fa fa-reply" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('BACK');?></a>
    <?php
    }
    else
    {
        ?>
        <a class="btn disabled btn-default top_action_button" style="padding-right:15px;" href="#">
            <i class="fa fa-reply" style="font-size:20px"></i>
            <br/>
            <?php echo $CI->lang->line('BACK');?></a>
    <?php
    }
    ?>
</div>
</div>