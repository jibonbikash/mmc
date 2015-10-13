<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();

//echo '<pre>';
//print_r($faqs);
//echo '</pre>';
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <div class="clearfix"></div>
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div style="" class="row show-grid " id="">
            <div class="col-xs-4">
                <label class="custom smalllabelcell pull-right"><?php echo $CI->lang->line('QUESTION_FOR'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="user_group" class="form-control user_group" disabled>
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    foreach($groups as $group)
                    {
                        ?>
                        <option value="<?php echo $group['id']?>" <?php if($faqs['user_type']==$group['id']){echo 'selected';}?>><?php echo $group['name_bn'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid question">
            <div class="col-xs-4">
                <label class="custom smalllabelcell pull-right"><?php echo $CI->lang->line('QUESTION'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <textarea disabled name="question" class="form-control"><?php echo $faqs['question'];?></textarea>
            </div>
        </div>
        <div class="row show-grid question">
            <div class="col-xs-4">
                <label class="custom smalllabelcell pull-right"><?php echo $CI->lang->line('ANSWER'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <?php
                    if($faqs['answer']=='')
                    {
                        echo "<label class='label label-warning'>".$this->lang->line('NOT_ANSWERED')."</label>";
                    }
                    else
                    {
                        echo "<label class='label label-success'>".$faqs['answer']."</label>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

