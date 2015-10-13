
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
    <div class="col-lg-6 user_detail ">
        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('USER_NAME_EN'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8" id="name_en">
                <input type="text" name="user_detail[name_en]" class="form-control" value="<?php if(isset($detail['name_en'])){echo $detail['name_en'];}?>">
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('DATE_OF_BIRTH'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[dob]" id="dob" class="form-control dob" value="<?php if(isset($detail['dob'])){echo $detail['dob'];}?>">
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('PHONE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[phone]" id="phone" class="form-control" value="<?php if(isset($detail['phone'])){echo $detail['phone'];}?>">
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('EMAIL'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[email]" id="email" class="form-control" value="<?php if(isset($detail['email'])){echo $detail['email'];}?>">
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('NID'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[national_id_no]" id="national_id_no" class="form-control" value="<?php if(isset($detail['national_id'])){echo $detail['national_id'];}?>">
            </div>
        </div>
    </div>



    <div class="col-lg-6 user_detail" id="basic">
        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('USER_NAME_BN'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[name_bn]" id="name_bn" class="form-control" value="<?php if(isset($detail['name_bn'])){echo $detail['name_bn'];}?>">
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('GENDER'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <select name="user_detail[gender]" class="form-control" id="gender">
                    <?php
                    $CI->load_view('dropdown',array('drop_down_options'=>Menu_helper::convert_dropDown_array($this->config->item('system_gender')),'drop_down_selected'=>$detail['gender']));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid ">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('PHONE_OFFICE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[office_phone]" id="office_phone" class="form-control" value="">
            </div>
        </div>

        <div class="row show-grid ">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('MOBILE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" name="user_detail[mobile]" id="mobile" class="form-control" value="<?php if(isset($detail['mobile'])){echo $detail['mobile'];}?>">
            </div>
        </div>
    </div>

    <div class="col-lg-12 show-grid user_detail ">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $CI->lang->line('PRESENT_ADDRESS'); ?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-xs-8">
            <textarea name="user_detail[present_address]" id="present_address" class="form-control"><?php if(isset($detail['present_address'])){echo $detail['present_address'];}?></textarea>
        </div>
    </div>

    <div class="col-lg-12 show-grid user_detail ">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $CI->lang->line('PERMANENT_ADDRESS'); ?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-xs-8">
            <textarea name="user_detail[permanent_address]" id="permanent_address" class="form-control"><?php if(isset($detail['permanent_address'])){echo $detail['permanent_address'];}?></textarea>
        </div>
    </div>

    <div class="col-lg-12 show-grid user_detail ">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $CI->lang->line('PHOTO'); ?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-xs-3">
            <input type="file" name="user_detail_photo" class="btn btn-primary" data-preview-container="#user_photo_container" data-preview-height="80"/>
        </div>
        <div class="col-xs-3" id="user_photo_container">
            <img src="<?php echo base_url().'images/no_image.jpg';?>" height="80">
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function ()
    {
        $(":file").filestyle({input: false,buttonText: "<?php echo $CI->lang->line('UPLOAD');?>",buttonName: "btn-primary"});
        $( ".dob" ).datepicker({
            dateFormat : display_date_format
        });
    });
</script>