<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

//echo "<pre>";
//print_r($services);
//echo "</pre>";

?>
<div id="system_content" class="system_content_margin">

    <div class="clearfix"></div>
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
                <div class="col-lg-12">
                    <?php
                    if(empty($services))
                    {
                        ?>
                        <label class="control-label pull-right"><span style="color:#FF0000"><?php echo $CI->lang->line('DATA_NOT_FOUND'); ?></span></label>
                    <?php
                    }
                    else
                    {
                        foreach($services as $service)
                        {
                            ?>
                            <div class="col-xs-4">
                                <label class="control-label pull-left">
                                    <?php echo $service['service_name'];?> ( <label class="label label-success"><?php echo $service['service_amount'];?></label> )
                                </label>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
