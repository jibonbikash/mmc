<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();

?>
<div id="system_action_button_container" class="system_action_button_container">

</div>

<style>
    body {
        background: #e9e9e9;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>

<div class="clearfix"></div>
<div id="system_content" class="dashboard-wrapper">
<div class="">
    <div class="grid_10">
        <form action="<?php echo $CI->get_encoded_url('user_management/user_password_reset/index/save'); ?>" class="signup" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $password_detail['id'];?>" />
        <div class="box round first">
            <div class="block ">
                <table class="signup table">
                    <tbody>
                        <tr>
                            <td class="labelcell">
                                <label><?php echo $this->lang->line('USER_ID').': ' ;?></label>
                            </td>
                            <td class="fieldcell">
                                <label class="labelcell"><?php echo $password_detail['username'];?></label>
                            </td>

                        </tr>
                        <tr>
                            <td class="labelcell">
                                <label><?php echo $this->lang->line('PASSWORD').': ' ;?></label>
                            </td>
                            <td class="fieldcell">
                                <input type="password" name="user_detail[password]" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td class="labelcell">
                                <label><?php echo $this->lang->line('CONFIRM_PASSWORD').': ' ;?></label>
                            </td>
                            <td class="fieldcell">
                                <input type="password" name="user_detail[confirm_password]" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td class="labelcell">
                                <label><?php echo $this->lang->line('SECRET_QUESTION').': ' ;?></label>
                            </td>
                            <td class="fieldcell">
                                <select name="user_detail[ques_id]" class="selectbox-1">
                                    <option value=""><?php echo $CI->lang->line('SELECT');?></option>
                                    <?php
                                    foreach($questions as $question)
                                    {
                                        ?>
                                        <option value="<?php echo $question['value'];?>" <?php if($question['value']==$password_detail['ques_id']){echo 'selected';}?>><?php echo $question['text'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="labelcell">
                                <label><?php echo $this->lang->line('ANSWER').': ' ;?></label>
                            </td>
                            <td class="fieldcell">
                                <input type="text" name="user_detail[ques_ans]" value="<?php echo $password_detail['ques_ans'];?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="signup table" width="100%">
                    <tr>
                        <td colspan="1" class="custom labelcell text-center">
                            <input type="submit" style="margin-left: 45%" class="myButton" id="submitChange" name="submitRegistration" value="<?php echo $this->lang->line('SAVE');?>" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
</div>

