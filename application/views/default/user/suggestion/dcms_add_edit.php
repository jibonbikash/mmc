<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();

//print_r($services);
?>

<div id="system_sidebar_left" class="system_sidebar_left col-sm-1" style="padding-left:0;">&nbsp;</div>
<div id="system_content">
    <div class="clearfix"></div>
    <div class="grid_10">
        <div class="box round first">
            <h2><?php echo $title;?></h2>
            <div class="block ">
                <form accept-charset="utf-8" method="post" id="form_id" class="signup" action="<?php echo $CI->get_encoded_url('user/suggestion/index/save') ?>">
                    <table class="form">
                        <tbody>
                            <tr>
                                <td class="labelcell">
                                    <label><?php echo $this->lang->line('SUGGESTION');?> <span style="color: #FF0000;">*</span></label>
                                </td>
                                <td class="fieldcell">
                                    <textarea cols="150" row="120" class="type validate[required]" required="required" name="suggestion"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" value="<?php echo $this->lang->line('SAVE');?>" name="submit" id="submit" style="cursor:pointer;" class="myButton">
                                    <input id="reset" type="reset" value="<?php echo $this->lang->line('DISCARD');?>" class="myButton">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div class="clear">
    </div>
    <div style="line-height:45px;">&nbsp;</div>
</div>
</div>

<script>

</script>

