<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <?php
    //print_r($userInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('profile/Secret_question_change/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($userInfo['id'])){echo $userInfo['id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('SECRET_QUESTION'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[ques_id]" class="selectbox-1">
                        <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        <?php
                        foreach($questions as $question)
                        {
                        ?>
                            <option value="<?php echo $question['value'];?>" <?php if($question['value']==$userInfo['ques_id']){echo 'selected';}?>><?php echo $question['text']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('ANSWER'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[ques_ans]" class="inputbx-1" value="<?php echo $userInfo['ques_ans'];?>">
                </div>
            </div>
        </div>
    </form>
</div>
