<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

//echo "<pre>";
//print_r($ServiceInfo);
//echo "</pre>";
$uisc=User_helper::get_uisc_info();
//echo "<pre>";
//print_r($uisc);
//echo "</pre>";
//echo "lllllllllllllllllllll";
$uisc_service_id=array();
foreach($uisc_services as $uisc_service)
{
    $uisc_service_id[] = $uisc_service['service_id'];
}

?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <?php
    //print_r($ServiceInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('esheba_management/esheba_including/index/save'); ?>" method="post">
        <input type="hidden" name="id" value="<?php if(isset($ServiceInfo['service_id'])){echo $ServiceInfo['service_id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-12">
                    <div class="col-lg-2">
                        <h3><?php echo $CI->lang->line('UISC_NAME'); ?>:</h3>
                    </div>
                    <div class="col-lg-10">
                        <h3><label class="text-info"><?php echo @$uisc->uisc_name;?></label></h3>
                    </div>

                    <div class="col-lg-4">
                        <h5><?php //echo $CI->lang->line('HEAD_OFFICE_SERVICE_LIST'); ?></h5>
                    </div>
                    <div class="col-lg-8 text-right">
                        <h5>
                            <?php echo $CI->lang->line('ALL_SELECT'); ?>
                            <input type="checkbox" name="select_all" id="select_all" class="checkAll" />
                        </h5>
                    </div>

                    <div class="col-lg-12">
                        <hr />
                        <?php
                        if(empty($ServiceInfo))
                        {
                            ?>
                            <label class="control-label pull-right"><span style="color:#FF0000"><?php echo $CI->lang->line('DATA_NOT_FOUND'); ?></span></label>
                        <?php
                        }
                        else
                        {
                            foreach($ServiceInfo as $service)
                            {
                                if(isset($service['service_id']))
                                {
                                    $service_id=$service['service_id'];
                                }
                                else
                                {
                                    $service_id='';
                                }
                                ?>
                                <div class="col-xs-4">
                                    <label class="control-label pull-left">
                                        <input type="hidden" name="uisc_service_id[]" value="<?php if(in_array($service_id, $uisc_service_id)){ echo $service_id;};?>"    />
                                        <input type="hidden" name="service_id[]" value="<?php echo $service['service_id'];?>"    />
                                        <input type="checkbox" name="<?php echo $service['service_id'];?>"  value="1" <?php if(in_array($service['service_id'], $uisc_service_id)){ echo "checked='checked'";};?> class="anther_check" />
                                        <?php echo $service['service_name'];?> ( <?php echo $service['service_amount'];?> )
                                    </label>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="col-xs-12">
                        <h5><?php echo $CI->lang->line('UISC_PROPOSED_SERVICE_LIST'); ?></h5>
                        <hr />
                    </div>

                    <div class="col-lg-12">
                        <?php
                        if(empty($uisc_service_list))
                        {
                            ?>
                            <label class="control-label pull-right"><span style="color:#FF0000"><?php echo $CI->lang->line('DATA_NOT_FOUND'); ?></span></label>
                        <?php
                        }
                        else
                        {
                            foreach($uisc_service_list as $service_uisc)
                            {
                                ?>
                                <div class="col-xs-4">
                                    <label class="control-label pull-left">
                                        <input type="hidden" name="own_service_id[]" value="<?php echo $service_uisc['service_id'];?>"    />
                                        <input type="checkbox" checked value="1" disabled />
                                        <?php echo $service_uisc['service_name'];?> ( <?php echo $service_uisc['service_amount'];?>    )
                                    </label>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="col-xs-12">
                    <h5><?php echo $CI->lang->line('UISC_SERVICE_LIST'); ?></h5>
                    <hr />
                </div>

                <div class="col-lg-12">
                    <?php
                    if(empty($ServiceInfo))
                    {
                        ?>
                        <label class="control-label pull-right"><span style="color:#FF0000"><?php echo $CI->lang->line('DATA_NOT_FOUND'); ?></span></label>
                    <?php
                    }
                    else
                    {
                        foreach($ServiceInfo as $service)
                        {
                            if($service['status']==$this->config->item('SERVICES_STATUS_PROPOSED'))
                            {
                                ?>
                                <div class="col-xs-4">
                                    <label class="control-label pull-left">
                                        <input type="checkbox" checked value="1" disabled />
                                        <?php echo $service['service_name'];?>
                                    </label>
                                </div>
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('.checkAll').click(function()
        {
            if($(this).is(':checked'))
            {
                $('.anther_check').prop('checked',true);
            }
            else
            {
                $('.anther_check').prop('checked',false);
            }
        });
    })
</script>