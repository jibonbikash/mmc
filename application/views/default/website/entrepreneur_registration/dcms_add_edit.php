<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_action_button_container" class="system_action_button_container">
<?php
    //$CI->load_view('system_action_buttons');

?>
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
<div class="grid_10" >
<form action="<?php echo $CI->get_encoded_url('website/entrepreneur_registration/index/save'); ?>" class="signup" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<div class="box round first">
    <h2><?php echo $this->lang->line('DIGITAL_CENTER_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('TYPE');?> <span style="color: #FF0000">*</span></td>
                <td class="custom fieldcella">
                    <select name="entrepreneur_type" class="entrepreneur_type selectbox-1 division validate[required]">
                        <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        <option value="<?php echo $this->config->item('ONLINE_UNION_GROUP_ID');?>"><?php echo $this->lang->line('UNION_PARISHAD');?></option>
                        <option value="<?php echo $this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID');?>"><?php echo $this->lang->line('CITY_CORPORATION');?></option>
                        <option value="<?php echo $this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID');?>"><?php echo $this->lang->line('MUNICIPALITY');?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('DIVISION');?> <span style="color: #FF0000">*</span></td>
                <td  class="custom fieldcell">
                    <div class="input select">
                        <select name="division" id="user_division_id" class="selectbox-1 division validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <?php
                            foreach($this->config->item('division') as $key=>$division)
                            {
                            ?>
                                <option value="<?php echo $key;?>"><?php echo $division;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </td>
                <td  class="custom smalllabelcell zilla_label">
                    <span class="labelcell"><?php echo $this->lang->line('ZILLA');?> <span style="color: #FF0000">*</span></span>
                </td>
                <td  class="custom fieldcell zilla_label">
                    <div class="input select">
                        <select name="zilla" id="user_zilla_id" class="selectbox-1 zilla validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom labelcell upazila_label" style="display: none;"><label for="name"><?php echo $this->lang->line('UPAZILLA');?> <span style="color: #FF0000">*</span></label></td>
                <td class="custom fieldcell upazila_label" style="display: none;">
                    <div class="input select">
                        <select name="upazilla" id="user_upazila_id" class="selectbox-1 validate[required] upzilla">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>

                <td class="custom labelcell municipal_label" style="display: none;">
                    <label for="name"><?php echo $this->lang->line('MUNICIPALITY');?> <span style="color: #FF0000">*</span></label></td>
                <td class="custom fieldcell municipal_label" style="display: none;">
                    <div class="input select">
                        <select name="municipal" id="user_municipal_id" class="selectbox-1 municipal validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom labelcell municipalward_label" style="display: none;">
                    <label for="name"><?php echo $this->lang->line('MUNICIPALITY_WARD');?><span style="color: #FF0000">*</span></label>
                </td>
                <td class="custom fieldcell municipalward_label" style="display: none;">
                    <div class="input select">
                        <select name="municipalward" id="user_municipal_ward_id" class="selectbox-1 municipalward validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>
                <td class="custom labelcell citycorporation_label" style="display: none;"><label for="name"><?php echo $this->lang->line('CITY_CORPORATION');?><span style="color: #FF0000">*</span></label></td>
                <td class="custom fieldcell citycorporation_label" style="display: none;">
                    <div class="input select">
                        <select name="citycorporation" id="user_citycorporation_id" class="selectbox-1 citycorporation validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom labelcell citycorporationward_label" style="display: none;">
                    <label for="name"><?php echo $this->lang->line('WARD_NO');?><span style="color: #FF0000">*</span></label>
                </td>
                <td class="custom fieldcell citycorporationward_label" style="display: none;">
                    <div class="input select">
                        <select name="citycorporationward" id="user_city_corporation_ward_id" class="selectbox-1 citycorporationward validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>
                <td class="custom smalllabelcell union_label" style="display: none;">
                    <span class="labelcell"><?php echo $this->lang->line('UNION');?><span style="color: #FF0000">*</span>
                    </span>
                </td>
                <td class="custom smallfieldcell union_label" style="display: none;">
                    <div class="input select">
                        <select name="union" id="user_unioun_id" class="selectbox-1 union validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('DIGITAL_CENTER_NAME');?> <span style="color: #FF0000">*</span></td>
                <td class="custom fieldcell" id="uisc_name_load">
                    <input readonly="" type="text" value="" class="validate[required]" maxlength="100" id="uisc_name" name="uisc_name">
                </td>

                <td class="custom smalllabelcell">
                    <span class="labelcell"><?php echo $this->lang->line('EMAIL');?><span style="color: #FF0000">*</span></span>
                </td>
                <td class="custom fieldcell">
                    <span class="fieldcell">
                        <input type="text" value="" class="validate[required,custom[email]]" maxlength="100" id="uisc_email" name="uisc_email">
                    </span>
                </td>
            </tr>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE_NO');?> <span style="color: #FF0000">*</span></td>
                <td class="custom labelcell">
                    <span class="fieldcell">
                        <input type="text"  class="required validate[required]" value="" maxlength="60" id="uisc_mobile_no" name="uisc_mobile_no">
                    </span>
                </td>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS');?><span style="color: #FF0000">*</span></span></td>
                <td class="custom fieldcell">
                    <span class="fieldcell">
                        <div class="input textarea">
                            <textarea name="uisc_address" id="uisc_address" rows="1" cols="22" class="validate[required]"></textarea>
                        </div>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('SECRET_QUESTION');?> <span style="color: #FF0000">*</span></td>
                <td  class="custom fieldcell">
                    <div class="input select">
                        <select name="ques_id" id="ques_id" class="selectbox-1 validate[required]">
                            <?php
                            $CI->load_view('dropdown',array('drop_down_options'=>$questions,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </td>
                <td  class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('QUESTION_ANSWER');?><span style="color: #FF0000">*</span></span></td>
                <td  class="custom fieldcell">
                    <div class="input text">
                        <input name="ques_ans" id="ques_ans" class="validate[required]" type="text"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('PROFILE_PIC');?> <span style="color: #FF0000">*</span></td>
                <td  class="custom fieldcell">
                    <div class="input select">
                        <div id="imtext" style="width: 150px; height: 150px;"><img src="<?php echo base_url()?>images/profile.png" style="width: 130px; height: 130px;" id="imtext" /></div>
                        <input type="file" name="profile_image" id="profile_image" data-preview-container="#imtext" data-preview-height="30" class="validate[required, custom[validateMIME[image/jpeg|image/png|image/jpg|image/gif]]]" />
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="box round first">
    <h2><?php echo $this->lang->line('SECRETARY_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NAME');?> <span style="color: #FF0000">*</span></td>
                <td width="28%" class="custom fieldcell">
                    <div class="input text">
                        <input name="secretary_name" id="secretary_name" class="validate[required]" type="text"/>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE_NO')?><span style="color: #FF0000">*</span></span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <input name="secretary_mobile" id="secretary_mobile" class="validate[required]" type="text"/>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EMAIL')?><span style="color: #FF0000">*</span></span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <input name="secretary_email" id="secretary_email" class="validate[required,custom[email]]" type="text"/>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS')?> <span style="color: #FF0000">*</span></span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input textarea">
                        <textarea name="secretary_address" id="secretary_address" rows="1" cols="22" class="validate[required]"></textarea>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('ENTREPRENEUR_RELATED_INFO');?></h2>
    <div class="block" id="entrepreneur_list">
        <table class="signup table" width="100%">
            <tbody>
                <tr>
                    <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ENTREPRENEUR_TYPE');?> <span style="color: #FF0000">*</span></td>
                    <td  class="custom fieldcella">
                        <select name='entrepreneur_exp_type' id='entrepreneur_exp_type' class='selectbox-1 validate[required]'>
                            <option value=''><?php echo $this->lang->line('SELECT')?></option>
                            <option value='1'><?php echo $this->lang->line('ENTREPRENEUR');?></option>
                            <option value='2'><?php echo $this->lang->line('NOVICE_ENTREPRENEUR');?></option>
                        </select>
                    </td>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NAME');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input text">
                            <input name="entrepreneur_name" id="entrepreneur_name" class="validate[required]" type="text"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOTHERS_NAME');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input text">
                            <input name="entrepreneur_mother_name" id="entrepreneur_mother_name" class="validate[required]" type="text"/>
                        </div>
                    </td>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('FATHERS_NAME');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input text">
                            <input name="entrepreneur_father_name" id="entrepreneur_father_name" class="validate[required]" type="text"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE_NO');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input text">
                            <input name="entrepreneur_mobile" id="entrepreneur_mobile" class="validate[required]" type="text"/>
                        </div>
                    </td>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EMAIL');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input text">
                            <input name="entrepreneur_email" id="entrepreneur_email" class="validate[required,custom[email]]" type="text"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('GENDER');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input select">
                            <select name="entrepreneur_sex" id="entrepreneur_sex" class="selectbox-1 validate[required]">
                                <option value="1"><?php echo $this->lang->line('MALE');?></option>
                                <option value="2"><?php echo $this->lang->line('FEMALE');?></option>
                            </select>
                        </div>
                    </td>
                    <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS');?> <span style="color: #FF0000">*</span></span></td>
                    <td width="29%" class="custom fieldcell">
                        <div class="input textarea">
                            <textarea name="entrepreneur_address" id="entrepreneur_address" rows="1" cols="22" class="validate[required]"></textarea>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('DEVICE_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('CONNECTION_TYPE');?> <span style="color: #FF0000">*</span></td>
                <td>
                    <div class="input select">
                        <select name="connection_type" id="connection_type" class="selectbox-1 validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <option value="Lan">Lan</option>
                            <option value="Wireless">Wireless</option>
                        </select>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MODEM');?><span style="color: #FF0000">*</span></span></td>
                <td>
                    <div class="input select">
                        <select name="modem" id="modem" class="selectbox-1 validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <?php
                            foreach($this->config->item('modem') as $val=>$modem)
                            {
                                ?>
                                <option value="<?php echo $val;?>"><?php echo $modem;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('IP_ADDRESS');?><span style="color: #FF0000">*</span></span></td>
                <td width="29%" class="custom fieldcell">
                    <textarea name="ip_address" id="ip_address" class="validate[required]"></textarea>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('INVESTMENT_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('INVESTED_MONEY_AMOUNT');?> <span style="color: #FF0000">*</span></td>
                <td>
                    <div class="input select">
                        <input type="text" name="invested_money" id="invested_money" class="selectbox-1 validate[required]" value="" />
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('SELF_INVESTMENT');?><span style="color: #FF0000">*</span></span></td>
                <td>
                    <div class="input select">
                        <input type="text" name="self_investment" id="self_investment" class="selectbox-1 validate[required]" value="" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('INVEST_DEBT');?> <span style="color: #FF0000">*</span></td>
                <td>
                    <div class="input select">
                        <input type="text" name="invest_debt" id="invest_debt" class="selectbox-1 validate[required]" value="" />
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('INVEST_SECTOR');?><span style="color: #FF0000">*</span></span></td>
                <td width="29%" class="custom fieldcell">
                    <textarea name="invest_sector" id="invest_sector" class="validate[required]"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('ENTREPRENEUR_TRAINING_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" id="training_info" width="100%">
            <thead>
                <tr>
                    <th class="labelcell"><?php echo $this->lang->line('COURSE_NAME');?></th>
                    <th class="labelcell"><?php echo $this->lang->line('INSTITUTION_NAME');?></th>
                    <th class="labelcell"><?php echo $this->lang->line('TIME_SPAN');?></th>
                    <th class="labelcell"><?php echo $this->lang->line('DELETE');?></th>
                </tr>
            </thead>
            <tbody>
                <tr id="supliments_1">
                    <td class="custom fieldcell">
                        <div class="input select">
                            <select name="training_course[]" id="training_course[]" class="selectbox-1 ">
                                <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                <?php
                                foreach($this->config->item('training_course') as $key=>$training)
                                {
                                ?>
                                    <option value="<?php echo $key;?>"><?php echo $training;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>

                    <td class="custom fieldcell">
                        <div class="input text">
                            <input type="text" name="training_institute[]" id="training_institute[]" class="" />
                        </div>
                    </td>
                    <td class="custom fieldcell">
                        <div class="input text">
                            <input type="text" name="training_time[]" id="training_time[]" class="" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="signup table" width="100%">
            <tr class="add" id="add_more_1">
                <td class="custom labelcell">
                    <input type="button" style="cursor:pointer;" id="1" class="myButton add_more" name="1" value="<?php echo $this->lang->line('ADD_MORE');?>" onclick="RowIncrementTraining()"/>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('ELECTRICITY_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ELECTRICITY');?></td>
                <td>
                    <div class="input select">
                        <select name="electricity" id="electricity" class="selectbox-1 validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <option value="1"><?php echo $this->lang->line('YES')?></option>
                            <option value="0"><?php echo $this->lang->line('NO')?></option>
                        </select>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('SOLAR');?></span></td>
                <td>
                    <div class="input select">
                        <select name="solar" id="solar" class="selectbox-1 validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <option value="1"><?php echo $this->lang->line('YES')?></option>
                            <option value="0"><?php echo $this->lang->line('NO')?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('IPS');?></span></td>
                <td>
                    <div class="input select">
                        <select name="ips" id="ips" class="selectbox-1 validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <option value="1"><?php echo $this->lang->line('YES')?></option>
                            <option value="0"><?php echo $this->lang->line('NO')?></option>
                        </select>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('CENTER_LOCATION_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
                <tr>
                    <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('TYPE');?></td>
                    <td>
                        <div class="input select">
                            <select name="center_location" id="center_location" class="selectbox-1 validate[required]">
                                <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                <?php
                                foreach($this->config->item('center_location_info') as $key=>$location)
                                {
                                ?>
                                    <option value="<?php echo $key;?>"><?php echo $location;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('EDUCATION_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
                <tr>
                    <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('LATEST_ACADEMIC_INFO');?></td>
                    <td>
                        <div class="input select">
                            <select name="latest_education" id="latest_education" class="selectbox-1">
                                <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                <?php
                                foreach($this->config->item('latest_academic_info') as $key=>$academic)
                                {
                                ?>
                                    <option value="<?php echo $key;?>"><?php echo $academic;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>

                    <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('PASSING_YEAR');?></td>
                    <td>
                        <div class="input select">
                            <input type="text" name="passing_year" id="passing_year" class="selectbox-1" value="" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box round first">
    <h2><?php echo $this->lang->line('EQUIPMENT');?></h2>
    <div class="block ">
        <table class="signup table" id="resource_info" width="100%">
            <thead>
            <tr>
                <th class="labelcell"><?php echo $this->lang->line('NAME');?></th>
                <th class="labelcell"><?php echo $this->lang->line('DETAIL');?></th>
                <th class="labelcell"><?php echo $this->lang->line('NUMBER');?></th>
                <th class="labelcell"><?php echo $this->lang->line('STATUS');?></th>
                <th class="labelcell"><?php echo $this->lang->line('DELETE');?></th>
            </tr>
            </thead>
            <tbody>
            <tr id="supliments_1">
                <td  class="custom fieldcell">
                    <div class="input select">
                        <select name="res_id[]" id="res_id[]" class="selectbox-1 ">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <?php
                            foreach($resources as $equipment)
                            {
                            ?>
                                <option value="<?php echo $equipment['value'];?>"><?php echo $equipment['text'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </td>

                <td  class="custom fieldcell">
                    <textarea name="res_detail[]" id="res_detail[]" class=""></textarea>
                </td>
                <td  class="custom fieldcell">
                    <div class="input text">
                        <input name="quantity[]" id="quantity[]" class="" type="text"/>
                    </div>
                </td>
                <td class="custom col2">
                    <select name='status[]' id='status[]' class='selectbox-1'>
                        <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        <?php
                        foreach($this->config->item('equipment_status') as $val=>$equipment_status)
                        {
                            ?>
                            <option value="<?php echo $val;?>"><?php echo $equipment_status;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="signup table" width="100%">
            <tr class="add" id="add_more_1">
                <td class="custom labelcell">
                    <input type="button" style="cursor:pointer;" id="1" class="myButton add_more" name="1" value="<?php echo $this->lang->line('ADD_MORE');?>" onclick="RowIncrementResource()"/>
                </td>
            </tr>
            <tr>
                <td class="custom labelcell"></td>
                <td colspan="1" class="custom labelcell">
                    <input type="submit" style="cursor:pointer; margin-right: 37px !important;" class="myButton" id="submitRegistration" name="submitRegistration" value="<?php echo $this->lang->line('SAVE');?>" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
</div>
<script type="text/javascript">
var select_option="<option value=''><?php echo $this->lang->line('SELECT');?></option>";
function reset_all_element(division, zilla, upazila, union, city_corporation, city_corporation_word, municipal, municipal_word)
{
    if(division==1)
    {
        $("#user_division_id").val('');
    }
    else
    {

    }
    if(zilla==1)
    {
        $("#user_zilla_id").html('');
        $("#user_zilla_id").html(select_option);
    }
    else
    {

    }
    if(upazila==1)
    {
        $("#user_upazila_id").html('');
        $("#user_upazila_id").html(select_option);
    }
    else
    {

    }
    if(union==1)
    {
        $("#user_unioun_id").html('');
        $("#user_unioun_id").html(select_option);
    }
    else
    {

    }

    if(city_corporation==1)
    {
        $("#user_citycorporation_id").html('');
        $("#user_citycorporation_id").html(select_option);
    }
    else
    {

    }

    if(city_corporation_word==1)
    {
        $("#user_city_corporation_ward_id").html('');
        $("#user_city_corporation_ward_id").html(select_option);
    }
    else
    {

    }

    if(municipal==1)
    {
        $("#user_municipal_id").html('');
        $("#user_municipal_id").html(select_option);
    }
    else
    {

    }
    if(municipal_word==1)
    {
        $("#user_municipal_ward_id").html('');
        $("#user_municipal_ward_id").html(select_option);
    }
    else
    {

    }

    $("#uisc_name_load").html('');
}

    $(document).ready(function ()
    {
        turn_off_triggers();

        $(document).on("change",".entrepreneur_type",function()
        {
            if($(this).val()==<?php echo $this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID');?>)
            {
                $(".upazila_label").hide();
                $(".union_label").hide();

                $(".municipal_label").hide();
                $(".municipalward_label").hide();

                $(".citycorporation_label").show();
                $(".citycorporationward_label").show();

                reset_all_element(1,1,1,1,1,1,1,1)

            }
            else if($(this).val()==<?php echo $this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID');?>)
            {
                $(".upazila_label").hide();
                $(".union_label").hide();

                $(".municipal_label").show();
                $(".municipalward_label").show();

                $(".citycorporation_label").hide();
                $(".citycorporationward_label").hide();

                reset_all_element(1,1,1,1,1,1,1,1)
            }
            else if($(this).val()==<?php echo $this->config->item('ONLINE_UNION_GROUP_ID');?>)
            {
                $(".upazila_label").show();
                $(".union_label").show();

                $(".municipal_label").hide();
                $(".municipalward_label").hide();

                $(".citycorporation_label").hide();
                $(".citycorporationward_label").hide();

                reset_all_element(1,1,1,1,1,1,1,1)
            }
        });

        $(document).on("change","#user_division_id",function()
        {
            reset_all_element('',1,1,1,1,1,1,1)
            var division_id=$(this).val();

            $.ajax({
                url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_zilla'); ?>',
                type: 'POST',
                dataType: "JSON",
                data:{division_id:division_id},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");

                }
            });
        });

        $(document).on("change","#user_zilla_id",function()
        {
            reset_all_element('','',1,1,1,1,1,1)
            var zilla_id=$(this).val();
            var entrepreneur_type = $(".entrepreneur_type").val();

            if(entrepreneur_type==<?php echo $this->config->item('ONLINE_UNION_GROUP_ID');?>)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_upazila'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id: $("#user_division_id").val(),zilla_id:zilla_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else if(entrepreneur_type==<?php echo $this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID');?>)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_city_corporation'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id: $("#user_division_id").val(),zilla_id:zilla_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else if(entrepreneur_type==<?php echo $this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID');?>)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_municipal'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id: $("#user_division_id").val(),zilla_id:zilla_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
        });


        $(document).on("change","#user_upazila_id",function()
        {
            reset_all_element('','','',1,1,1,1,1)
            var upazila_id=$("#user_upazila_id").val();

            $.ajax({
                url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_union'); ?>',
                type: 'POST',
                dataType: "JSON",
                data:{zilla_id: $("#user_zilla_id").val(), upazila_id:upazila_id},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });
        });

        $(document).on("change","#user_citycorporation_id",function()
        {
            reset_all_element('','','','','',1,1,1)
            var citycorporation_id=$(this).val();

            $.ajax({
                url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_city_corporation_word'); ?>',
                type: 'POST',
                dataType: "JSON",
                data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), city_corporation_id: $(this).val()},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");

                }
            });
        });

        $(document).on("change","#user_municipal_id",function()
        {
            reset_all_element('','','','','','','',1)
            var municipal_id=$(this).val();

            $.ajax({
                url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/get_municipal_ward'); ?>',
                type: 'POST',
                dataType: "JSON",
                data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), municipal_id: $(this).val()},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");

                }
            });
        });

        $(document).on("change","#user_unioun_id",function()
        {
            if($(this).val()>0)
            {
                $("#uisc_name_load").html('');
                var str = $("#user_unioun_id option:selected").text();
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/CountUnionServiceCenter'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), upazilla_id: $("#user_upazila_id").val(), union_id: $("#user_unioun_id").val(), str: str},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
        });

        $(document).on("change","#user_city_corporation_ward_id",function()
        {
            if($(this).val()>0)
            {
                $("#uisc_name_load").html('');

                var str = $("#user_city_corporation_ward_id option:selected").text();
                var pre_str = $("#user_citycorporation_id option:selected").text();

                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/CountCityServiceCenter'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), citycorporation_id: $("#user_citycorporation_id").val(), city_corporation_ward_id: $(this).val(), str: str, pre_str:pre_str},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
        });

        $(document).on("change","#user_municipal_ward_id",function()
        {
            if($(this).val()>0)
            {
                $("#uisc_name_load").html('');
                var strw = $("#user_municipal_ward_id option:selected").text();
                var pre_str = $("#user_municipal_id option:selected").text();
                var new_str = strw.trim(strw);

                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('website/entrepreneur_registration/CountMunicipalServiceCenter'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), municipal_id: $("#user_municipal_id").val(), municipal_ward_id: $(this).val(), str: new_str, pre_str:pre_str},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
        });

    });

    //////////////////////////////////////// Table Row add delete function ///////////////////////////////
    var ExId = 0;
    function RowIncrementResource()
    {
        var table = document.getElementById('resource_info');

        var rowCount = table.rows.length;
        //alert(rowCount);
        var row = table.insertRow(rowCount);
        row.id = "T" + ExId;
        row.className = "tableHover";
        //alert(row.id);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = "<select name='res_id[]' id='res_id"+ExId+"' class='selectbox-1'>\n\
        <option value=''><?php echo $this->lang->line('SELECT');?></option>\n\
        <?php
        foreach ($resources as $resource)
        {
            echo "<option value='$resource[value]'>$resource[text]</option>";
        }
        ?>";
        var cell1 = row.insertCell(1);
        cell1.innerHTML = "<textarea name='res_detail[]' id='res_detail[]' class=''></textarea>";
        var cell1 = row.insertCell(2);
        cell1.innerHTML = "<input name='quantity[]' id='quantity[]' class='' type='text'/>";
        var cell1 = row.insertCell(3);
        cell1.innerHTML = "<select name='status[]' id='status[]' class='selectbox-1 validate[required]'>\n\
        <option value=''><?php echo $this->lang->line('SELECT');?></option>\n\
            <option value='0'>ভাল </option>\n\
            <option value='1'>ত্রুটিপূর্ণ </option>\n\
        </select>";
        cell1 = row.insertCell(4);
        cell1.innerHTML = "<input type='button' onclick=\"RowDecrementResource('resource_info','T"+ExId+"')\" style='cursor:pointer;' id='resource_del_btn"+ExId+"' name='resource_del_btn[]' value='মুছুন' class='more myButton' />";
        cell1.style.cursor = "default";
        document.getElementById("res_id" + ExId).focus();
        ExId = ExId + 1;
        $("#resource_info").tableDnD();
    }

    function RowDecrementResource(tableID, id)
    {
        try {
            var table = document.getElementById(tableID);
            for (var i = 1; i < table.rows.length; i++)
            {
                if (table.rows[i].id == id)
                {
                    table.deleteRow(i);
                    // showAlert('SA-00106');
                }
            }
        }
        catch (e) {
            alert(e);
        }
    }

    var ExId = 0;
    function RowIncrementTraining()
    {
        var table = document.getElementById('training_info');

        var rowCount = table.rows.length;
        //alert(rowCount);
        var row = table.insertRow(rowCount);
        row.id = "T" + ExId;
        row.className = "tableHover";
        //alert(row.id);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = "<select name='training_course[]' id='training_course"+ExId+"' class='selectbox-1'>\n\
            <option value=''><?php echo $this->lang->line('SELECT');?></option>\n\
            <?php
            foreach ($this->config->item('training_course') as $key=>$training)
            {
                echo "<option value='$key'>$training</option>";
            }
            ?>";
        var cell1 = row.insertCell(1);
        cell1.innerHTML = "<input type='text' name='training_institute[]' id='training_institute[]' class='' />";
        var cell1 = row.insertCell(2);
        cell1.innerHTML = "<input name='training_time[]' id='training_time[]' class='' type='text'/>";

        cell1 = row.insertCell(3);
        cell1.innerHTML = "<input type='button' onclick=\"RowDecrementTraining('training_info','T"+ExId+"')\" style='cursor:pointer;' id='training_del_btn"+ExId+"' name='training_del_btn[]' value='মুছুন' class='more myButton' />";
        cell1.style.cursor = "default";
        document.getElementById("training_course" + ExId).focus();
        ExId = ExId + 1;
        $("#training_info").tableDnD();
    }

    function RowDecrementTraining(tableID, id)
    {
        try {
            var table = document.getElementById(tableID);
            for (var i = 1; i < table.rows.length; i++)
            {
                if (table.rows[i].id == id)
                {
                    table.deleteRow(i);
                    // showAlert('SA-00106');
                }
            }
        }
        catch (e) {
            alert(e);
        }
    }

</script>