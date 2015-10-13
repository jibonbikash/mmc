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
<div class="box round first">
    <h2><?php echo $this->lang->line('DIGITAL_CENTER_NAME');?></h2>
    <div class="block ">
        <span class="labelcell"><?php echo $uisc_detail['uisc_name'];?></span>
    </div>
</div>
<div class="box round first">
    <h2><?php echo $this->lang->line('SECRETARY_RELATED_INFO');?></h2>
    <div class="block ">
        <table class="signup table" width="100%">
            <tbody>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NAME');?></td>
                <td width="28%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $secretary['secretary_name'];?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE_NO')?></span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $secretary['secretary_mobile'];?></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EMAIL')?></span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $secretary['secretary_email'];?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS')?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input textarea">
                        <span class="labelcell"><?php echo $secretary['secretary_address'];?></span>
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
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ENTREPRENEUR_TYPE');?> </td>
                <td  class="custom fieldcella">
                    <span class="labelcell">
                        <?php
                            if($entrepreneur['entrepreneur_type']==1)
                            {
                                echo $this->lang->line('ENTREPRENEUR');
                            }
                            elseif($entrepreneur['entrepreneur_type']==2)
                            {
                                echo $this->lang->line('NOVICE_ENTREPRENEUR');
                            }
                        ?>
                    </span>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('NAME');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $entrepreneur['entrepreneur_name'];?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOTHERS_NAME');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $entrepreneur['entrepreneur_mother_name'];?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('FATHERS_NAME');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $entrepreneur['entrepreneur_father_name'];?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MOBILE_NO');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $entrepreneur['entrepreneur_mobile'];?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('EMAIL');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input text">
                        <span class="labelcell"><?php echo $entrepreneur['entrepreneur_email'];?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('GENDER');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input select">
                        <span class="labelcell">
                        <?php
                        if($entrepreneur['entrepreneur_sex']==1)
                        {
                            echo $this->lang->line('MALE');
                        }
                        elseif($entrepreneur['entrepreneur_sex']==2)
                        {
                            echo $this->lang->line('FEMALE');
                        }
                        ?>
                    </span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('ADDRESS');?> </span></td>
                <td width="29%" class="custom fieldcell">
                    <div class="input textarea">
                        <span class="labelcell"><?php echo $entrepreneur['entrepreneur_address'];?></span>
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
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('CONNECTION_TYPE');?> </td>
                <td>
                    <div class="input select">
                        <span class="labelcell"><?php echo $device['connection_type'];?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('MODEM');?></span></td>
                <td>
                    <div class="input select">
                        <span class="labelcell"><?php echo $device['modem'];?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('IP_ADDRESS');?></span></td>
                <td width="29%" class="custom fieldcell">
                    <span class="labelcell"><?php echo $device['ip_address'];?></span>
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
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('INVESTED_MONEY_AMOUNT');?> </td>
                <td>
                    <div class="input select">
                        <span class="labelcell"><?php echo $investment['invested_money'].' '.$this->lang->line('TAKA');?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('SELF_INVESTMENT');?></span></td>
                <td>
                    <div class="input select">
                        <span class="labelcell"><?php echo $investment['self_investment'].' '.$this->lang->line('TAKA');?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('INVEST_DEBT');?> </td>
                <td>
                    <div class="input select">
                        <span class="labelcell"><?php echo $investment['invest_debt'].' '.$this->lang->line('TAKA');?></span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('INVEST_SECTOR');?></span></td>
                <td width="29%" class="custom fieldcell">
                    <span class="labelcell"><?php echo $investment['invest_sector'];?></span>
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
            <tr>
                <td class="custom labelcell"><span class="labelcell"><?php echo $this->lang->line('COURSE_NAME');?></span></td>
                <td class="custom labelcell"><span class="labelcell"><?php echo $this->lang->line('INSTITUTION_NAME');?></span></td>
                <td class="custom labelcell"><span class="labelcell"><?php echo $this->lang->line('TIME_SPAN');?></span></td>
            </tr>
            <tbody>
            <?php
            if(is_array($trainings) && sizeof($trainings)>0)
            {
                foreach($trainings as $training)
                {
            ?>
                <tr id="supliments_1">
                    <td>
                        <div class="input select">
                            <span class="labelcell">
                                <?php
                                $config = $this->config->item('training_course');
                                if(isset($training['course_name']))
                                {
                                    echo $config[$training['course_name']];
                                }
                                ?>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="input text">
                            <span class="labelcell"><?php echo $training['institute_name'];?></span>
                        </div>
                    </td>
                    <td>
                        <div class="input text">
                            <span class="labelcell"><?php echo $training['timespan'];?></span>
                        </div>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
            </tbody>
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
                        <span class="labelcell">
                        <?php
                        if($electricity['electricity']==1)
                        {
                            echo $this->lang->line('YES');
                        }
                        elseif($electricity['electricity']==0)
                        {
                            echo $this->lang->line('NO');
                        }
                        ?>
                    </span>
                    </div>
                </td>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('SOLAR');?></span></td>
                <td>
                    <div class="input select">
                        <span class="labelcell">
                        <?php
                        if($electricity['solar']==1)
                        {
                            echo $this->lang->line('YES');
                        }
                        elseif($electricity['solar']==0)
                        {
                            echo $this->lang->line('NO');
                        }
                        ?>
                    </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%" class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('IPS');?></span></td>
                <td>
                    <div class="input select">
                        <span class="labelcell">
                        <?php
                        if($electricity['ips']==1)
                        {
                            echo $this->lang->line('YES');
                        }
                        elseif($electricity['ips']==0)
                        {
                            echo $this->lang->line('NO');
                        }
                        ?>
                    </span>
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
                        <span class="labelcell">
                            <?php
                            $config = $this->config->item('center_location_info');
                            if(isset($center_location['center_type']))
                            {
                                echo $config[$center_location['center_type']];
                            }
                            ?>
                        </span>
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
                        <span class="labelcell">
                            <?php
                            $config = $this->config->item('latest_academic_info');
                            if(isset($qualification['latest_education']))
                            {
                                echo $config[$qualification['latest_education']];
                            }
                            ?>
                        </span>
                    </div>
                </td>

                <td class="custom smalllabelcell"><span class="labelcell"><?php echo $this->lang->line('PASSING_YEAR');?></td>
                <td>
                    <div class="input select">
                        <span class="labelcell"><?php echo $qualification['passing_year'];?></span>
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
            <tr>
                <th class="labelcell"><?php echo $this->lang->line('NAME');?></th>
                <th class="labelcell"><?php echo $this->lang->line('DETAIL');?></th>
                <th class="labelcell"><?php echo $this->lang->line('NUMBER');?></th>
                <th class="labelcell"><?php echo $this->lang->line('STATUS');?></th>
            </tr>
            <tbody>

            <?php
            if(is_array($resources) && sizeof($resources)>0)
            {
                foreach($resources as $resource)
                {
                ?>
                <tr id="supliments_1">
                    <td  class="custom fieldcell">
                        <div class="input select">
                            <span class="labelcell"><?php echo $resource['res_name'];?></span>
                        </div>
                    </td>

                    <td  class="custom fieldcell">
                        <span class="labelcell"><?php echo $resource['res_detail'];?></span>
                    </td>
                    <td  class="custom fieldcell">
                        <div class="input text">
                            <span class="labelcell"><?php echo $resource['quantity'];?></span>
                        </div>
                    </td>
                    <td class="custom col2">
                        <span class="labelcell">
                            <?php
                            if($resource['status']==0)
                            {
                                echo $this->lang->line('GOOD');
                            }
                            elseif($resource['status']==1)
                            {
                                echo $this->lang->line('DEFAULTER');
                            }
                            ?>
                        </span>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>

    </div>
</div>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
</div>
