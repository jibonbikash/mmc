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
    //print_r($divisionInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('faq_management/Answer_create/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="" />
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
                    <select name="user_group" class="form-control user_group">
                        <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        <?php
                        foreach($groups as $group)
                        {
                        ?>
                            <option value="<?php echo $group['id']?>"><?php echo $group['name_bn'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row show-grid question" style="display: none;">
                <div class="col-xs-4">
                    <label class="custom smalllabelcell pull-right"><?php echo $CI->lang->line('QUESTION'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <textarea name="question" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function ()
    {
        turn_off_triggers();

        $(document).on("change",".user_group",function()
        {
            if($(this).val()>0)
            {
                $(".question").show();
            }
            else
            {
                $(".question").hide();
            }
        });
    });
</script>
