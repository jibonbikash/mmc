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

<?php
    //echo '<pre>';
    //print_r($uisc_detail);
    //echo '</pre>';
?>

<div class="clearfix"></div>
<div id="system_content" class="dashboard-wrapper">
<div class="" >
<form action="<?php echo $CI->get_encoded_url('approval/user_approval/index/save'); ?>" class="signup" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="box round first">
        <div class="block">
            <div class="box round first">
                <h2><?php echo $this->lang->line('GENERAL_INFO')?></h2>
                <div class="block">
                    <table width="100%" class="signup table">
                        <tbody>
                            <tr>
                                <input type="hidden" id="uisc_id" name="uisc_id" value="<?php echo $uisc_detail['uisc_id'];?>" />
                                <input type="hidden" id="id" name="id" value="<?php echo $uisc_detail['id'];?>" />
                                <input type="hidden" id="uisc_type" name="uisc_type" value="<?php echo $uisc_detail['user_group_id'];?>" />
                                <input type="hidden" id="division" name="division" value="<?php echo $uisc_detail['division'];?>" />
                                <input type="hidden" id="zilla" name="zilla" value="<?php echo $uisc_detail['zilla'];?>" />
                                <input type="hidden" id="upazilla" name="upazilla" value="<?php echo $uisc_detail['upazila'];?>" />
                                <input type="hidden" id="union" name="union" value="<?php echo $uisc_detail['unioun'];?>" />
                                <input type="hidden" id="citycorporation" name="citycorporation" value="<?php echo $uisc_detail['citycorporation'];?>" />
                                <input type="hidden" id="citycorporationward" name="citycorporationward" value="<?php echo $uisc_detail['citycorporationward'];?>" />
                                <input type="hidden" id="municipal" name="municipal" value="<?php echo $uisc_detail['municipal'];?>" />
                                <input type="hidden" id="municipalward" name="municipalward" value="<?php echo $uisc_detail['municipalward'];?>" />
                                <input type="hidden" id="ques_id" name="ques_id" value="<?php echo $uisc_detail['ques_id'];?>" />
                                <input type="hidden" id="ques_ans" name="ques_ans" value="<?php echo $uisc_detail['ques_ans'];?>" />

                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('DIVISION');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ZILLA');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('UPAZILLA');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('UNION');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('CITY_CORPORATION');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MUNICIPALITY');?></span></td>
                            </tr>
                            <tr>
                                <td><?php echo $uisc_detail['divname'];?></td>
                                <td><?php echo $uisc_detail['zillaname'];?></td>
                                <td><?php echo $uisc_detail['upazilaname'];?></td>
                                <td><?php echo $uisc_detail['unionname'];?></td>
                                <td><?php echo $uisc_detail['citycorporationname'];?></td>
                                <td><?php echo $uisc_detail['municipalname'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box round first">
                    <h2><?php echo $this->lang->line('SECRETARY_RELATED_INFO');?></h2>
                    <div class="block ">
                        <table width="100%" class="signup table">
                            <tbody>
                            <tr>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NAME');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE_NO');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EMAIL');?></span></td>
                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS');?></span></td>
                            </tr><tr>
                                <td><?php echo $uisc_detail['secretary_name'];?></td>
                                <td><?php echo $uisc_detail['secretary_mobile'];?></td>
                                <td><?php echo $uisc_detail['secretary_email'];?></td>
                                <td><?php echo $uisc_detail['secretary_address'];?></td>
                            </tr></tbody>
                        </table>
                    </div>

                    <div class="box round first">
                        <h2><?php echo $this->lang->line('ENTREPRENEUR_RELATED_INFO');?></h2>
                        <div class="block ">
                            <table width="100%" class="signup table">
                                <tbody>
                                    <tr>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ENTREPRENEUR');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ENTREPRENEUR_TYPE');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NAME');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOTHERS_NAME');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ACADEMIC_QUALIFICATION');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE');?></span></td>

                                    </tr>
                                    <tr>
                                        <td><?php echo $uisc_detail['entrepreneur_no'];?></td>
                                        <td><?php if($uisc_detail['entrepreneur_type']==1){echo $this->lang->line('ENTREPRENEUR');}elseif($uisc_detail['entrepreneur_type']==2){echo $this->lang->line('NOVICE_ENTREPRENEUR');}?></td>
                                        <td><?php echo $uisc_detail['entrepreneur_name'];?></td>
                                        <td><?php echo $uisc_detail['entrepreneur_father_name'];?></td>
                                        <td><?php echo $uisc_detail['entrepreneur_qualification'];?></td>
                                        <td><?php echo $uisc_detail['entrepreneur_mobile'];?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table width="100%" class="signup table">
                                <tbody>
                                    <tr>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EMAIL');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('GENDER');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS');?></span></td>
                                        <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('PROFILE_PIC');?></span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $uisc_detail['entrepreneur_email'];?></td>
                                        <td><?php if($uisc_detail['entrepreneur_sex']==1){echo $this->lang->line('MALE');}elseif($uisc_detail['entrepreneur_sex']==2){echo $this->lang->line('FEMALE');}?></td>
                                        <td><?php echo $uisc_detail['entrepreneur_address'];?></td>
                                        <td>
                                            <?php
                                            $dir=$this->config->item("dcms_upload");
                                            $profile_picture=FCPATH.$dir['entrepreneur'].'/'.$uisc_detail['picture_name'];
                                            if(file_exists($profile_picture) && !empty($uisc_detail['picture_name']))
                                            {
                                                ?>
                                                <img width="150" height="200" src="<?php echo base_url().$dir['entrepreneur'].'/'.$uisc_detail['picture_name'];?>" height="50">
                                            <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <img width="150" height="200" src="<?php echo base_url().'images/profile.jpg';?>" height="50">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="box round first">
                            <?php
                            if(is_array($uisc_detail['equips']) && sizeof($uisc_detail['equips'])>0)
                            {
                            ?>
                            <h2><?php echo $this->lang->line('EQUIPMENT');?></h2>
                            <div class="block ">
                                <table width="100%" class="signup table">
                                    <tbody>
                                        <tr>
                                            <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NUMBER_NO');?></span></td>
                                            <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EQUIPMENT_NAME');?></span></td>
                                            <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('DETAIL');?></span></td>
                                            <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NUMBER');?></span></td>
                                            <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('STATUS');?></span></td>
                                        </tr>
                                        <?php
                                        foreach($uisc_detail['equips'] as $key=>$equipment)
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo $equipment['res_name'];?></td>
                                                <td><?php echo $equipment['res_detail'];?></td>
                                                <td><?php echo $equipment['quantity'];?></td>
                                                <td><?php if($equipment['status']==0){echo $this->lang->line('GOOD');}elseif($equipment['status']==1){echo $this->lang->line('DEFAULTER');}?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            }
                            ?>

                            <div class="box round first">
                                <h2><?php echo $this->lang->line('DEVICE_RELATED_INFO')?></h2>
                                <div class="block ">
                                    <table width="100%" class="signup table">
                                        <tbody>
                                            <tr>
                                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo  $this->lang->line('CONNECTION_TYPE')?></span></td>
                                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo  $this->lang->line('MODEM')?></span></td>
                                                <td class="custom smalllabelcell"><span class="labelcell"><?php echo  $this->lang->line('IP_ADDRESS')?></span></td>
                                            </tr><tr>
                                                <td><?php echo $uisc_detail['modem'];?></td>
                                                <td><?php echo $uisc_detail['connection_type'];?></td>
                                                <td><?php echo $uisc_detail['ip_address'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="uiscbtn">
                                    <?php
                                    if($uisc_detail['status']==$this->config->item('STATUS_ACTIVE'))
                                    {
                                        ?>
                                        <label class="label label-success" style="font-size: 15px; text-align: center">
                                            <?php echo $this->lang->line('MSG_APPROVED');?>
                                        </label>
                                    <?php
                                    }
                                    elseif($uisc_detail['status']==$this->config->item('STATUS_REJECT'))
                                    {
                                        ?>
                                        <label class="label label-warning" style="font-size: 15px; text-align: center">
                                            <?php echo $this->lang->line('MSG_DENY');?>
                                        </label>
                                    <?php
                                    }
                                    elseif($uisc_detail['status']==$this->config->item('STATUS_SUSPEND'))
                                    {
                                        ?>
                                        <label class="label label-warning" style="font-size: 15px; text-align: center">
                                            <?php echo $this->lang->line('MSG_SUSPEND');?>
                                        </label>
                                    <?php
                                    }
                                    elseif($uisc_detail['status']==$this->config->item('STATUS_TEMPORARY_SUSPEND'))
                                    {
                                        ?>
                                        <label class="label label-warning" style="font-size: 15px; text-align: center">
                                            <?php echo $this->lang->line('MSG_TEMPORARY_SUSPEND');?>
                                        </label>
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <input name="approval_approve" type="button" style="cursor:pointer;" id="approve" class="myButton" value="<?php echo $this->lang->line('APPROVE');?>" />
                                        <input name="approval_deny" type="button" style="cursor:pointer;" id="deny" class="myButton" value="<?php echo $this->lang->line('DENY');?>" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
</div>

