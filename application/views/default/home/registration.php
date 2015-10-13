<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

?>
<div class="constant">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-8">
         <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('home/registration'); ?>" method="post">
        <table width="100%" border="0">
  <tr>
    <td width="33%">
        <label class="control-label pull-left"><?php echo $CI->lang->line('DIVISION_NAME_SELECT'); ?><span style="color:#FF0000">*</span></label>
     <select name="registration[divid]" class="form-control" id="division_id">
      <?php
      $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>''));
      ?>
    </select>
    </td>
     <td width="33%"> 
         <label class="control-label pull-left"><?php echo $CI->lang->line('ZILLA_NAME_SELECT_BN'); ?><span style="color:#FF0000">*</span></label>
         <select name="registration[zilla]" id="zilla_id" class="selectbox-1 zilla validate[required]">
         <option value=""><?php echo $this->lang->line('SELECT');?></option>
         </select>
     </td>
    <td width="33%"> 
        <label class="control-label pull-left"><?php echo $CI->lang->line('UPOZILLA_SELECT'); ?><span style="color:#FF0000">*</span></label>
        <select name="registration[upozilla]" id="upozilla_id" class="selectbox-1 zilla validate[required]">
          <option value=""><?php echo $this->lang->line('SELECT');?></option>
         </select>
    </td>
  </tr>
  
   <tr>
    <td>
        <label class="control-label pull-left"><?php echo $CI->lang->line('EDUCATION_TYPE'); ?><span style="color:#FF0000">*</span></label>
        <select name="registration[education_type]" class="form-control" id="education_type">
 <?php
   $CI->load_view('dropdown',array('drop_down_options'=>$education_type,'drop_down_selected'=>''));
  ?>
       </select>
    </td>
              <td colspan="2">
                  
     <?php           
             $dataa = array(
    'name'        => 'registration[primary]',
    'id'          => 'is_primary',
    'value'       => '1',
    'checked'     => TRUE,
    'style'       => 'margin:3px',
    );

 echo form_checkbox($dataa);
 echo $CI->lang->line('PRIMARY');
 
 $dataa = array(
    'name'        => 'registration[secondary]',
    'id'          => 'is_secondary',
    'value'       => '1',
    'checked'     => FALSE,
    'style'       => 'margin:3px',
    );

 echo form_checkbox($dataa);
 echo $CI->lang->line('SECONDARY');
 
 
 $dataa = array(
    'name'        => 'registration[higher]',
    'id'          => 'is_higher',
    'value'       => '1',
    'checked'     => FALSE,
    'style'       => 'margin:3px',
    );

 echo form_checkbox($dataa);
 echo $CI->lang->line('HIGHER'); 
 ?>
              
   </td>
  </tr>
  
   <tr>
       <td>
           <label class="control-label pull-left"><?php echo $CI->lang->line('SCHOOL_NAME'); ?><span style="color:#FF0000">*</span></label>
    <?php
    $data = array(
        'name'          => 'registration[institute]',
        'id'            => 'institute',
        'placeholder'   => $this->lang->line('SCHOOL_NAME'),
        'size'          => '60',
);

echo form_input($data);
    ?>
       </td>
       <td>
 <label class="control-label pull-left"><?php echo $CI->lang->line('SCHOOL_EMAIL'); ?><span style="color:#FF0000">*</span></label>
    <?php
    $data = array(
        'name'          => 'registration[email]',
        'id'            => 'email',
        'placeholder'   => $this->lang->line('SCHOOL_EMAIL'),
        'size'          => '60',
);

echo form_input($data);
    ?>          
       </td>
       <td>
           
   <label class="control-label pull-left"><?php echo $CI->lang->line('SCHOOL_MOBILE'); ?><span style="color:#FF0000">*</span></label>
    <?php
    $data = array(
        'name'          => 'registration[mobile]',
        'id'            => 'mobile',
        'placeholder'   => $this->lang->line('SCHOOL_MOBILE'),
        'size'          => '60',
);

echo form_input($data);
    ?>        
       </td>
  </tr>
  
  <tr>
      <td>
     <label class="control-label pull-left"><?php echo $CI->lang->line('SCHOOL_EM'); ?><span style="color:#FF0000">*</span></label>
    <?php
    $data = array(
        'name'          => 'registration[em]',
        'id'            => 'mobile',
        'placeholder'   => $this->lang->line('SCHOOL_EM'),
        'size'          => '60',
);

echo form_input($data);
    ?>     
      </td>
     <td>
     <label class="control-label pull-left"><?php echo $CI->lang->line('SCHOOL_PASSWORD'); ?><span style="color:#FF0000">*</span></label>
    <?php
    $data = array(
        'name'          => 'registration[password]',
        'id'            => 'password',
        'placeholder'   => $this->lang->line('SCHOOL_PASSWORD'),
        'size'          => '60',
);

echo form_password($data);
    ?>     
      </td>
       <td>
          
      </td>
  </tr>
  
</table>

             
             

              
             <?php
            
     /*      
             
             $dataa = array(
    'name'        => 'registration[primary]',
    'id'          => 'is_primary',
    'value'       => '1',
    'checked'     => TRUE,
    'style'       => 'margin:3px',
    );

echo form_checkbox($dataa);
 echo $CI->lang->line('PRIMARY');
 
 $dataa = array(
    'name'        => 'registration[secondary]',
    'id'          => 'is_secondary',
    'value'       => '1',
    'checked'     => FALSE,
    'style'       => 'margin:3px',
    );

echo form_checkbox($dataa);
 echo $CI->lang->line('SECONDARY');
 
 
 $dataa = array(
    'name'        => 'registration[higher]',
    'id'          => 'is_higher',
    'value'       => '1',
    'checked'     => FALSE,
    'style'       => 'margin:3px',
    );

echo form_checkbox($dataa);
 echo $CI->lang->line('HIGHER');
 */
 
             ?>
         <input type="submit" style="cursor:pointer; margin-right: 37px !important;" class="myButton" id="submitRegistration" name="submitRegistration" value="<?php echo $this->lang->line('SAVE');?>" />
      </form> 
            
            </div>
        <div class="col-md-4">
            <div class="control-group">
                            <ul>
                                <li>১ম ধাপঃ প্রথমে বিভাগ নির্বাচন করুন।</li>
                                <li>২য় ধাপঃ জেলা নির্বাচন করুন।।</li>
                                <li>৩য় ধাপঃ উপজেলা নির্বাচন করুন।</li>
                                <li>৪র্থ ধাপঃ বিদ্যালয়ের ধরন নির্বাচন করুন।</li>
                                <li>৫ম ধাপঃ বিদ্যালয়ের স্তর নির্বাচন করুন।।</li>
                                <li>৬ষ্ঠ ধাপঃ বিদ্যালয়ের নাম লিখুন।</li>
                                <li>৭ম ধাপঃ বিদ্যালয়ের ইমেইল ঠিকানা লিখুন। এই ইমেইলটি পরবর্তিতে ইউজার আইডি হিসাবে গণ্য হবে ।</li>
                                <li>৮ম ধাপঃ মোবাইল নম্বর লিখুন।</li>
                                <li>৯ম ধাপঃ পাসওয়ার্ড লিখুন।</li>
                                <li>১০ম ধাপঃ "আবেদন করুন" এ ক্লিক করুন ।</li>
                            </ul>
                        </div>
        </div>
    </div>
    
    
</div>

<script>
 $(document).on("change","#division_id",function()
        {
            var division_id=$(this).val();

            if(division_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getZilla'); ?>',
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
                $("#zilla_id").val('');
            }
        });
        
        
        $(document).on("change","#zilla_id",function()
        {
            var zilla_id=$(this).val();

            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazila'); ?>',
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
                $("#upozilla_id").val('');
            }
        });
</script>