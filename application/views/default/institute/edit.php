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
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
     //   $CI->load_view('system_action_buttons');
        ?>
    </div>
     <div class="clearfix"></div>
     
     <form id="system_save_form" action="<?php echo $CI->get_encoded_url('institute/institute/index/save'); ?>" method="post">
                    <?php //echo $institute['id']?>
         
         <table width="100%" border="0" class="table">
  <tr>
      <td width="25%"><strong>বিদ্যালয়ের  নাম<strong></td>
    <td width="25%"> <?php echo $institute['name']?></td>
    <td width="25%"><strong>বিদ্যালয়ের EM নাম্বার<strong></td>
     <td width="25%"> <?php echo $institute['code']?></td>
  </tr>
  
  <tr>
    <td><strong>বিদ্যালয়ের  ইমেইল<strong></td>
    <td><?php echo $institute['email']?></td>
    <td><strong>মোবাইল নম্বর <strong></td>
    <td><?php echo $institute['mobile']?></td>
  </tr>
  
  <tr>
    <td><strong>বিদ্যালয়ের ধরন<strong></td>
    <td><?php if($institute['education_type_ids']==1)
    {
        echo 'সাধারণ শিক্ষা';
    }
    else
         echo 'মাদ্রাসা শিক্ষা';
        ?></td>
    <td><strong>বিদ্যালয়ের  স্তর <strong></td>
    <td>
        <?php if($institute['is_primary']==1)
    {
         echo 'প্রাথমিক'; 
    }
     ?>
        
         <?php if($institute['is_secondary']==1)
    {
         echo 'মাধ্যমিক'; 
    }
     ?>
        
         <?php if($institute['is_higher']==1)
    {
         echo ' উচ্চমাধ্যমিক '; 
    }
     ?>
    
    </td>
  </tr>
  
  <tr>
    <td><strong>Status<strong></td>
                <td>
     <?php
//echo $institute['status'];
     ?>
                    <select name="registration[status]" class="form-control" id="registration_status">

                    <?php
     $options = array(      
        '0' => ['text'=>'Not Approved','value'=>1],
        '1' => ['text'=>'Approved','value'=>2]
);
   $CI->load_view('dropdown',array('drop_down_options'=>$options,'drop_down_selected'=>$institute['status']));
  ?>     
                    </select>                  
                </td>
    <td>
        <input type="hidden" value="<?php echo $institute['id']; ?>" name="instituteid" />
      
        <input type="submit" style="cursor:pointer; margin-right: 37px !important;" class="myButton" id="saveRegistration" name="saveRegistration" value="<?php echo $this->lang->line('SAVE');?>" /></td>
    <td></td>
  </tr>
</table>

         
     </form>
  </div>  
    