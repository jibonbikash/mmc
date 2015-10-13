<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();
//echo "<pre>";
//print_r($notice_viewers);
//echo "</pre>";
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <?php
    //print_r($NoticeInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('notice_management/notice_create/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($NoticeInfo['id'])){echo $NoticeInfo['id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row show-grid " >
                <div class="col-xs-4"></div>
                <div class="col-sm-4 col-xs-8">
                    <table class="table table-responsive table-bordered" >
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="checkAll" id="" name="public_notice" value="1" />
                                <?php echo $this->lang->line('SELECT_ALL');?>
                            </th>
                            <th><?php //echo $this->lang->line('NOTICE_SENDER_NAME');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(empty($user_groups))
                        {
                            ?>
                            <tr>
                                <th colspan="21"><?php echo $this->lang->line('DATA_NOT_FOUND');?></th>
                            </tr>
                        <?php
                        }
                        else
                        {
                            $i=0;

                            foreach($user_groups as $group)
                            {

                                ?>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="check_in" id="viewer_group_id_<?php echo $group['id'];?>" name="viewer_group_id_<?php echo $group['id'];?>" value="<?php echo $group['id'];?>" <?php if(in_array($group['id'], $notice_viewers)){echo "checked='checked'";}?> />
                                        <input type="hidden" id="user_group_id[]" name="user_group_id[]" value="<?php echo $group['id'];?>" />
                                    </th>
                                    <th><?php echo $group['name_bn'];?></th>
                                </tr>
                            <?php

                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NOTICE_TITLE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="notice_detail[notice_title]" class="form-control" value="<?php echo $NoticeInfo['notice_title'];?>" />
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NOTICE_DETAILS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <textarea name="notice_detail[notice_details]" class="form-control "><?php echo $NoticeInfo['notice_details'];?></textarea>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('FILE_UPLOAD'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="file" name="upload_file" class="form-control OnlyNumber" value="">
                    <?php
                    if(!empty($NoticeInfo['upload_file']))
                    {
                        ?>
                        <a href="<?php echo base_url().'images/notice/'.$NoticeInfo['upload_file']?>" target="_blank">
                            <?php echo $CI->lang->line('DOWNLOAD'); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="notice_detail[status]" class="form-control" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('PUBLISHED'),'value'=>$this->config->item('STATUS_ACTIVE')),array('text'=>$CI->lang->line('UN_PUBLISHED'),'value'=>$this->config->item('STATUS_INACTIVE'))),'drop_down_selected'=>$NoticeInfo['status']));
                        ?>
                    </select>
                </div>
            </div>

        </div>
    </form>
</div>
<script>
    $(document).ready(function ()
    {
        $(document).on("click",'.checkAll',function()
        {
            if($(this).is(':checked'))
            {
                $('.check_in').prop('checked', true);
            }
            else
            {
                $('.check_in').prop('checked', false);
            }
        });
    });
</script>
