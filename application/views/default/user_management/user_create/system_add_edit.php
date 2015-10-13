<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('SUPER_ADMIN_GROUP_ID') || $userInfo['user_group_id']== $this->config->item('A_TO_I_GROUP_ID') || $userInfo['user_group_id']== $this->config->item('DONOR_GROUP_ID') || $userInfo['user_group_id']== $this->config->item('MINISTRY_GROUP_ID')))
{
    $display_division='none';
    $display_zilla='none';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('DIVISION_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='none';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('DISTRICT_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('UPAZILLA_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='block';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('UNION_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='block';
    $display_unioun='block';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('CITY_CORPORATION_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='block';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='block';
    $display_city_corporation_ward='block';
    $display_municipal='none';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('MUNICIPAL_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='block';
    $display_municipal_ward='none';
}
else if($userInfo['id']>0 && ($userInfo['user_group_id'] == $this->config->item('MUNICIPAL_WORD_GROUP_ID')))
{
    $display_division='block';
    $display_zilla='block';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='block';
    $display_municipal_ward='block';
}
else
{
    $display_division='none';
    $display_zilla='none';
    $display_upazila='none';
    $display_unioun='none';
    $display_city_corporation='none';
    $display_city_corporation_ward='none';
    $display_municipal='none';
    $display_municipal_ward='none';
}
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
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('user_management/User_create/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($userInfo['id'])){echo $userInfo['id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('GROUP_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[user_group_id]" id="user_group_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$groups,'drop_down_selected'=>$userInfo['user_group_id']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_division; ?>" class="row show-grid " id="division_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[division]" id="user_division_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>$userInfo['division']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_zilla; ?>" class="row show-grid " id="zilla_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('DISTRICT_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[zilla]" id="user_zilla_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$zillas,'drop_down_selected'=>$userInfo['zilla']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_upazila; ?>" class="row show-grid " id="upazila_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILLA_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[upazila]" id="user_upazila_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$upazilas,'drop_down_selected'=>$userInfo['upazila']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_unioun; ?>" class="row show-grid " id="union_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('UNION_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[unioun]" id="user_unioun_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$uniouns,'drop_down_selected'=>$userInfo['unioun']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_city_corporation; ?>" class="row show-grid " id="city_corporation_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('CITY_CORPORATION_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[citycorporation]" id="user_citycorporation_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$city_corporations,'drop_down_selected'=>$userInfo['citycorporation']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_city_corporation_ward; ?>" class="row show-grid " id="city_corporation_ward_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('CITY_CORPORATION_WORD_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[citycorporationward]" id="user_city_corporation_ward_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$city_corporation_words,'drop_down_selected'=>$userInfo['citycorporationward']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_municipal; ?>" class="row show-grid " id="municipal_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MUNICIPAL_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[municipal]" id="user_municipal_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$municipals,'drop_down_selected'=>$userInfo['municipal']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="display: <?php echo $display_municipal_ward; ?>" class="row show-grid " id="municipal_ward_option">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MUNICIPAL_WORD_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="user_detail[municipalward]" id="user_municipal_ward_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$municipal_wards,'drop_down_selected'=>$userInfo['municipalward']));
                        ?>
                    </select>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_BN'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[name_bn]" class="form-control" value="<?php echo $userInfo['name_bn'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('USER_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[username]" class="form-control" value="<?php echo $userInfo['username'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('PASSWORD'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="password" name="user_detail[password]" id="" class="form-control" value="">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('CONFIRM_PASSWORD'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="password" name="user_detail[confirm_password]" id="" class="form-control" value="">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('EMAIL'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[email]" class="form-control" value="<?php echo $userInfo['email'];?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MOBILE_NUMBER'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[mobile]" class="form-control" value="<?php echo $userInfo['mobile'];?>">
                </div>
            </div>

        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        // G.O. Location

        //        $("#division_option").hide();
        //        $("#zilla_option").hide();
        //        $("#upazila_option").hide();
        //        $("#union_option").hide();
        //        $("#city_corporation_option").hide();
        //        $("#city_corporation_ward_option").hide();
        //        $("#municipal_option").hide();
        //        $("#municipal_ward_option").hide();

        var SUPER_ADMIN_GROUP_ID = "<?php echo $this->config->item('SUPER_ADMIN_GROUP_ID');?>";
        var A_TO_I_GROUP_ID = "<?php echo $this->config->item('A_TO_I_GROUP_ID');?>";
        var DONOR_GROUP_ID = "<?php echo $this->config->item('DONOR_GROUP_ID');?>";
        var MINISTRY_GROUP_ID = "<?php echo $this->config->item('MINISTRY_GROUP_ID');?>";

        var DIVISION_GROUP_ID = "<?php echo $this->config->item('DIVISION_GROUP_ID');?>";
        var DISTRICT_GROUP_ID = "<?php echo $this->config->item('DISTRICT_GROUP_ID');?>";
        var UPAZILLA_GROUP_ID = "<?php echo $this->config->item('UPAZILLA_GROUP_ID');?>";
        var UNION_GROUP_ID = "<?php echo $this->config->item('UNION_GROUP_ID');?>";
        var CITY_CORPORATION_GROUP_ID = "<?php echo $this->config->item('CITY_CORPORATION_GROUP_ID');?>";
        var CITY_CORPORATION_WORD_GROUP_ID = "<?php echo $this->config->item('CITY_CORPORATION_WORD_GROUP_ID');?>";
        var MUNICIPAL_GROUP_ID = "<?php echo $this->config->item('MUNICIPAL_GROUP_ID');?>";
        var MUNICIPAL_WORD_GROUP_ID = "<?php echo $this->config->item('MUNICIPAL_WORD_GROUP_ID');?>";
        var UISC_GROUP_ID = "<?php echo $this->config->item('UISC_GROUP_ID');?>";

        $(document).on("change","#user_group_id",function()
        {


            $("#user_division_id").val("");
            console.log($(this).val());
            if($(this).val()==SUPER_ADMIN_GROUP_ID || $(this).val()==A_TO_I_GROUP_ID || $(this).val()==DONOR_GROUP_ID || $(this).val()==MINISTRY_GROUP_ID)
            {
                elm_hide();
            }
            else if($(this).val()==DIVISION_GROUP_ID)
            {
                elm_hide(1);
            }
            else if($(this).val()==DISTRICT_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1,1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        //$("#zilla_option").hide();
                        elm_hide(1);
                    }
                });
            }
            else if($(this).val()==UPAZILLA_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1,1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        elm_hide(1);
                        //$("#zilla_option").hide();
                    }
                });

                // START UPAZILLA INFOS
                $(document).on("change","#user_zilla_id",function()
                {
                    elm_hide(1,1,1);
                    //$("#upazila_option").show();
                    $("#user_upazila_id").val("");
                    //var division_id=$("#user_division_id").val();
                    var zilla_id=$(this).val();
                    if(zilla_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_upazila'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1);
                        //$("#upazila_option").hide();
                    }
                });
            }
            else if($(this).val()==UNION_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1,1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        elm_hide(1);
                        //$("#zilla_option").hide();
                    }
                });

                // START UPAZILLA INFOS
                $(document).on("change","#user_zilla_id",function()
                {
                    elm_hide(1,1,1);
                    //$("#upazila_option").show();
                    $("#user_upazila_id").val("");
                    //var division_id=$("#user_division_id").val();
                    var zilla_id=$(this).val();
                    if(zilla_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_upazila'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1);
                        //$("#upazila_option").hide();
                    }
                });

                // START UNION INFOS
                $(document).on("change","#user_upazila_id",function()
                {
                    elm_hide(1,1,1,1);
                    //$("#union_option").show();
                    $("#user_union_id").val("");
                    //var division_id=$("#user_division_id").val();
                    var zilla_id=$("#user_zilla_id").val();
                    var upazila_id=$(this).val();
                    if(upazila_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_union'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id, upazila_id:upazila_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,1);
                        //$("#union_option").hide();
                    }
                });
            }
            else if($(this).val()==CITY_CORPORATION_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1, 1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        elm_hide(1);
                        //$("#zilla_option").hide();
                    }
                });

                // START CITY CORPORATION INFOS
                $(document).on("change","#user_zilla_id",function()
                {
                    elm_hide(1,1,0,0,1);
                    //$("#city_corporation_option").show();
                    $("#user_citycorporation_id").val("");
                    var division_id=$("#user_division_id").val();
                    var zilla_id=$(this).val();
                    if(zilla_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_city_corporation'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id, division_id:division_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,0,0,0);
                        //$("#city_corporation_option").hide();
                    }
                });


            }
            else if($(this).val()==CITY_CORPORATION_WORD_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1,1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        elm_hide(1);
                        //$("#zilla_option").hide();
                    }
                });

                // START CITY CORPORATION INFOS
                $(document).on("change","#user_zilla_id",function()
                {
                    elm_hide(1,1,0,0,1);
                    //$("#city_corporation_option").show();
                    $("#user_citycorporation_id").val("");
                    var division_id=$("#user_division_id").val();
                    var zilla_id=$(this).val();
                    if(zilla_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_city_corporation'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id, division_id:division_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,0,0,0);
                        //$("#city_corporation_option").hide();
                    }
                });

                // START CITY CORPORATION WORD INFOS
                $(document).on("change","#user_citycorporation_id",function()
                {
                    elm_hide(1,1,0,0,1,1);
                    //$("#city_corporation_ward_option").show();
                    $("#user_city_corporation_ward_id").val("");
                    var division_id=$("#user_division_id").val();
                    var zilla_id=$("#user_zilla_id").val();
                    var city_corporation_id=$(this).val();
                    if(city_corporation_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_city_corporation_word'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id, division_id:division_id, city_corporation_id: city_corporation_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,0,0,1,0);
                        //$("#city_corporation_ward_option").hide();
                    }
                });

            }
            else if($(this).val()==MUNICIPAL_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1,1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        elm_hide(1);
                        //$("#zilla_option").hide();
                    }
                });

                // START MUNICIPAL INFOS
                $(document).on("change","#user_zilla_id",function()
                {
                    elm_hide(1,1,0,0,0,0,1);
                    //$("#municipal_option").show();
                    $("#user_municipal_id").val("");
                    var division_id=$("#user_division_id").val();
                    var zilla_id=$(this).val();
                    if(zilla_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_municipal'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,0,0,0,0,0);
                        //$("#municipal_option").hide();
                    }
                });
            }
            else if($(this).val()==MUNICIPAL_WORD_GROUP_ID)
            {
                elm_hide(1);
                // START DISTRICT INFOS
                $(document).on("change","#user_division_id",function()
                {
                    elm_hide(1,1);
                    //$("#zilla_option").show();
                    $("#user_zilla_id").val("");
                    var division_id=$(this).val();
                    if(division_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
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
                    }
                    else
                    {
                        elm_hide(1);
                        //$("#zilla_option").hide();
                    }
                });

                // START MUNICIPAL INFOS
                $(document).on("change","#user_zilla_id",function()
                {
                    elm_hide(1,1,0,0,0,0,1);
                    //$("#municipal_option").show();
                    $("#user_municipal_id").val("");
                    var division_id=$("#user_division_id").val();
                    var zilla_id=$(this).val();
                    if(zilla_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_municipal'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,0,0,0,0,0);
                        //$("#municipal_option").hide();
                    }
                });

                // START MUNICIPAL WARD INFOS
                $(document).on("change","#user_municipal_id",function()
                {
                    elm_hide(1,1,0,0,0,0,1,1);
                    //$("#municipal_ward_option").show();
                    $("#user_municipal_ward_id").val("");
                    var zilla_id=$("#user_zilla_id").val();
                    var municipal_id=$(this).val();
                    if(municipal_id>0)
                    {
                        $.ajax({
                            url: '<?php echo $CI->get_encoded_url('common/get_municipal_ward'); ?>',
                            type: 'POST',
                            dataType: "JSON",
                            data:{zilla_id:zilla_id, municipal_id:municipal_id},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");

                            }
                        });
                    }
                    else
                    {
                        elm_hide(1,1,0,0,0,0,1,0);
                        //$("#municipal_ward_option").hide();
                    }
                });
            }
            else
            {
                elm_hide();
            }
        });

    });

function elm_hide(division, zilla, upazila, union, city_corporation, city_corporation_word, municipal, municipal_word)
{
    if(division==1)
    {
        $("#division_option").show();
    }
    else
    {
        $("#division_option").hide();
    }
    if(zilla==1)
    {
        $("#zilla_option").show();
    }
    else
    {
        $("#zilla_option").hide();
    }
    if(upazila==1)
    {
        $("#upazila_option").show();
    }
    else
    {
        $("#upazila_option").hide();
    }

    if(union==1)
    {
        $("#union_option").show();
    }
    else
    {
        $("#union_option").hide();
    }

    if(city_corporation==1)
    {
        $("#city_corporation_option").show();
    }
    else
    {
        $("#city_corporation_option").hide();
    }

    if(city_corporation_word==1)
    {
        $("#city_corporation_ward_option").show();
    }
    else
    {
        $("#city_corporation_ward_option").hide();
    }

    if(municipal==1)
    {
        $("#municipal_option").show();
    }
    else
    {
        $("#municipal_option").hide();
    }

    if(municipal_word==1)
    {
        $("#municipal_ward_option").show();
    }
    else
    {
        $("#municipal_ward_option").hide();
    }




}

</script>