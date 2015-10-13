<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_sidebar_left" class="system_sidebar_left col-sm-1" style="padding-left:0;">&nbsp;</div>
<div id="system_content">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        //$CI->load_view('system_action_buttons');
        ?>
    </div>

<div id="system_content" class="dashboard-wrapper">
    <div class="grid_10" >
        <form action="<?php echo $CI->get_encoded_url('approval/entrepreneur_approval/index/list'); ?>" class="signup" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="frm_user_approval">
            <div class="box round first">
                <h2><?php echo $this->lang->line('UISC_REGISTRATION_APPROVAL');?></h2>
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
                                <td class="custom fieldcell division_label">
                                    <div class="input select">
                                        <select name="division" id="user_division_id" class="selectbox-1 division validate[required]">
                                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                            <?php
                                            foreach($divisions as $division)
                                            {
                                                ?>
                                                <option value="<?php echo $division['divid'];?>"><?php echo $division['divname'];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td  class="custom smalllabelcell zilla_label">
                                    <span class="labelcell"><?php echo $this->lang->line('ZILLA');?> <span style="color: #FF0000">*</span></span>
                                </td>
                                <td class="custom fieldcell zilla_label">
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
                                <td class="custom labelcell"><label for="name"><?php echo $this->lang->line('YEAR');?></label></td>
                                <td class="custom fieldcell">
                                    <div class="input select">
                                        <select name="year" id="year" class="selectbox-1" style="font-family: nikoshBan,nikosh,arial;">
                                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                            <?php
                                            foreach($this->config->item('approval_year') as $val=>$year)
                                            {
                                            ?>
                                                <option value="<?php echo $val;?>"><?php echo $year;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td class="custom labelcell"><label for="name"><?php echo $this->lang->line('MONTH');?></label></td>
                                <td class="custom fieldcell">
                                    <div class="input select">
                                        <select name="month" id="month" class="selectbox-1 month">
                                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                            <?php
                                            foreach($this->config->item('month') as $val=>$month)
                                            {
                                            ?>
                                                <option value="<?php echo $val;?>"><?php echo $month;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td  class="custom labelcell"><label for="name"><?php echo $this->lang->line('DATE')?></label></td>
                                <td  class="custom fieldcell">
                                    <div class="input text">
                                        <input name="date" id="date" class="registration_date" value="" type="text"/>
                                    </div>
                                </td>
                                <td class="custom labelcell"><label for="name"><?php echo $this->lang->line('STATUS')?></label></td>
                                <td class="custom fieldcell">
                                    <div class="input select">
                                        <select name="status" id="status" class="selectbox-1 status">
                                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                            <option value="<?php echo $this->config->item('STATUS_ACTIVE');?>"><?php echo $this->lang->line('APPROVED')?></option>
                                            <option value="<?php echo $this->config->item('STATUS_REJECT');?>"><?php echo $this->lang->line('NOT_APPROVED')?></option>
                                            <option value="<?php echo $this->config->item('STATUS_INACTIVE');?>"><?php echo $this->lang->line('PENDING')?></option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td  class="labelcell">
                                    <input type="submit" style="cursor:pointer;" id="search" class="myButton" name="1" value="<?php echo $this->lang->line('SEARCH');?>" />
                                    <input type="button" style="cursor:pointer;" id="reset" class="myButton" name="1" value="<?php echo $this->lang->line('RESET');?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div style="width: 86%" class="grid_10" id="load_list"></div>
</div>

<div class="row show-grid popContainer" id="show_data" style="display: none; overflow-y: auto;">
    <span class="crossSpan">
        <img src="<?php echo base_url()?>images/xmark.png" style="cursor: pointer;" width="26px" height="26px"/>
    </span>
    <div id="modal_data">
    </div>
</div>

<div id="bgBlack"></div>

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

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
            $("#bgBlack").hide();
        });

        // Approve
        $(document).on("click","#approve",function()
        {
            $(".popContainer").hide();
            $("#bgBlack").hide();
            var status_approved="<?php echo $this->config->item('STATUS_ACTIVE');?>";
            $.ajax({
                url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/index/save'); ?>',
                type: 'POST',
                dataType: "JSON",
                data:{
                    uisc_id: $("#uisc_id").val(),
                    approval_status:status_approved,
                    uisc_type: $("#uisc_type").val(),
                    division: $("#division").val(),
                    zilla: $("#zilla").val(),
                    upazilla: $("#upazilla").val(),
                    union: $("#union").val(),
                    citycorporation: $("#citycorporation").val(),
                    citycorporationward: $("#citycorporationward").val(),
                    municipal: $("#municipal").val(),
                    municipalward: $("#municipalward").val(),
                    union_name: $("#union_name").val(),
                    city_corporation_name: $("#city_corporation_name").val(),
                    city_corporation_ward_name: $("#city_corporation_ward_name").val(),
                    municipal_name: $("#municipal_name").val(),
                    municipal_ward_name: $("#municipal_ward_name").val(),
                    gender: $("#gender").val(),
                    ques_id: $("#ques_id").val(),
                    ques_ans: $("#ques_ans").val(),
                    user_image: $("#user_image").val()
                },
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });

            $("#modal_data").html('');
            $("#frm_user_approval").submit();
        });

        // Deny
        $(document).on("click","#deny",function()
        {
            $(".popContainer").hide();
            $("#bgBlack").hide();
            var status_deny="<?php echo $this->config->item('STATUS_REJECT');?>";
            $.ajax({
                url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/index/save'); ?>',
                type: 'POST',
                dataType: "JSON",
                data:{
                    uisc_id: $("#uisc_id").val(),
                    approval_status:status_deny,
                    uisc_type: $("#uisc_type").val(),
                    division: $("#division").val(),
                    zilla: $("#zilla").val(),
                    upazilla: $("#upazilla").val(),
                    union: $("#union").val(),
                    citycorporation: $("#citycorporation").val(),
                    citycorporationward: $("#citycorporationward").val(),
                    municipal: $("#municipal").val(),
                    municipalward: $("#municipalward").val(),
                    gender: $("#gender").val(),
                    ques_id: $("#ques_id").val(),
                    ques_ans: $("#ques_ans").val(),
                    user_image: $("#user_image").val()
                },
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });

            $("#modal_data").html('');
            $("#frm_user_approval").submit();
        });


        $( ".registration_date" ).datepicker({dateFormat : display_date_format});


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
                url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_zilla'); ?>',
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
                    url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_upazila'); ?>',
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
                    url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_city_corporation'); ?>',
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
                    url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_municipal'); ?>',
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
                url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_union'); ?>',
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
                url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_city_corporation_word'); ?>',
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
                url: '<?php echo $CI->get_encoded_url('approval/Entrepreneur_approval/get_municipal_ward'); ?>',
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

        <!--        $(document).on("change","#user_unioun_id",function()-->
        <!--        {-->
        <!--            $("#uisc_name_load").html('');-->
        <!--            var str = $("#user_unioun_id option:selected").text();-->
        <!--            $.ajax({-->
        <!--                url: '--><?php //echo $CI->get_encoded_url('approval/Entrepreneur_approval/CountUnionServiceCenter'); ?><!--',-->
        <!--                type: 'POST',-->
        <!--                dataType: "JSON",-->
        <!--                data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), upazilla_id: $("#user_upazila_id").val(), union_id: $("#user_union_id").val(), str: str},-->
        <!--                success: function (data, status)-->
        <!--                {-->
        <!---->
        <!--                },-->
        <!--                error: function (xhr, desc, err)-->
        <!--                {-->
        <!--                    console.log("error");-->
        <!--                }-->
        <!--            });-->
        <!--        });-->
        <!---->
        <!--        $(document).on("change","#user_city_corporation_ward_id",function()-->
        <!--        {-->
        <!--            $("#uisc_name_load").html('');-->
        <!---->
        <!--            var str = $("#user_city_corporation_ward_id option:selected").text();-->
        <!--            var pre_str = $("#user_citycorporation_id option:selected").text();-->
        <!---->
        <!--            $.ajax({-->
        <!--                url: '--><?php //echo $CI->get_encoded_url('approval/Entrepreneur_approval/CountCityServiceCenter'); ?><!--',-->
        <!--                type: 'POST',-->
        <!--                dataType: "JSON",-->
        <!--                data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), citycorporation_id: $("#user_citycorporation_id").val(), city_corporation_ward_id: $(this).val(), str: str, pre_str:pre_str},-->
        <!--                success: function (data, status)-->
        <!--                {-->
        <!---->
        <!--                },-->
        <!--                error: function (xhr, desc, err)-->
        <!--                {-->
        <!--                    console.log("error");-->
        <!--                }-->
        <!--            });-->
        <!--        });-->
        <!---->
        <!--        $(document).on("change","#user_municipal_ward_id",function()-->
        <!--        {-->
        <!--            $("#uisc_name_load").html('');-->
        <!--            var str = $("#user_municipal_ward_id option:selected").text();-->
        <!--            var pre_str = $("#user_municipal_id option:selected").text();-->
        <!--            $.ajax({-->
        <!--                url: '--><?php //echo $CI->get_encoded_url('approval/Entrepreneur_approval/CountMunicipalServiceCenter'); ?><!--',-->
        <!--                type: 'POST',-->
        <!--                dataType: "JSON",-->
        <!--                data:{division_id: $("#user_division_id").val(),zilla_id:$("#user_zilla_id").val(), municipal_id: $("#user_municipal_id").val(), municipal_ward_id: $(this).val(), str: str, pre_str:pre_str},-->
        <!--                success: function (data, status)-->
        <!--                {-->
        <!---->
        <!--                },-->
        <!--                error: function (xhr, desc, err)-->
        <!--                {-->
        <!--                    console.log("error");-->
        <!--                }-->
        <!--            });-->
        <!--        });-->

    });
</script>