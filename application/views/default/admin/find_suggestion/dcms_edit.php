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
        <div class="box round first">
            <div class="block ">
                <table class="form">
                    <tbody>
                        <tr>
                            <td class="labelcell">
                                <label><?php echo $this->lang->line('SUGGESTION').': ' ;?></label>
                            </td>
                            <td class="fieldcell">
                                <?php echo $suggestion['suggestion'];?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
</div>

