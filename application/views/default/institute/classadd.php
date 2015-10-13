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
<style>
    #classesname label{ display: inline !important;}
</style>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
     //   $CI->load_view('system_action_buttons');

//$data = unserialize("a:3:{i:1;a:1:{i:0;i:1;}i:2;a:1:{i:0;i:2;}i:3;a:1:{i:0;i:3;}}");
//
//echo $itemcount = count($data);
//
//
//foreach($data as $key => $value){
//            
//                 foreach($value as $k => $v){
//                     echo $v;
//                 }
//             
//
//         }
//         
        ?>
    </div>
    <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('institute/institute/classsave'); ?>" method="post">
    <?php 
    
    ?>
    <select class="" name="education_level" id="education_level">
	<option value="">বাছাই করুন ...</option>
        <?php
        if($institute['is_primary']==1){
            echo '<option value="5">প্রাথমিক/ ইবতেদায়ী</option>';
        }
         if($institute['is_secondary']==1){
            echo '<option value="6">মাধ্যমিক/ দাখিল</option>';
        }
        
         if($institute['is_higher']==1){
            echo '<option value="7">উচ্চ মাধ্যমিক/ আলীম</option>';
        }
        ?>
</select>
     <select name="classesid" id="classes" class="selectbox-1 zilla validate[required]">
         <option value=""><?php echo $this->lang->line('SELECT');?></option>
         </select>
    
    <div id="classesname"></div>
    
    <input type="hidden" id="education_type_ids" name="education_type_ids" value="<?php echo $institute['education_type_ids'];?>" />
    <input type="hidden" id="institute" name="institute" value="<?php echo $institute['id'];?>" />
    <?php
    if($institute['is_primary']==1){
        echo '<input type="hidden" name="is_primary" value="'.$institute['is_primary'].'"/>';
    }
    else{
      echo '<input type="hidden" name="is_primary" value="0"/>';  
    }
    ?>
    
        <?php
    if($institute['is_higher']==1){
        echo '<input type="hidden" name="is_higher" value="'.$institute['is_higher'].'"/>';
    }
    else{
      echo '<input type="hidden" name="is_primary" value="0"/>';  
    }
    ?>
    
    
        <?php
    if($institute['is_secondary']==1){
        echo '<input type="hidden" name="is_secondary" value="'.$institute['is_secondary'].'"/>';
    }
    else{
      echo '<input type="hidden" name="is_secondary" value="0"/>';  
    }
    ?>
    <input type="submit" name="classsave" value="submit">
</form>
     <?php //echo 'education_type_ids'.$institute['education_type_ids']?>
     <?php //echo 'is_primary'.$institute['is_primary']?>
     <?php //echo 'is_secondary'.$institute['is_secondary']?>
    <?php //echo 'is_higher'.$institute['is_higher']?>
</div>
<script>
 $(document).on("change","#education_level",function()
        {
            var education_level=$(this).val();

            if(education_level>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/education_level'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{education_level:education_level},
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
        
        
        $(document).on("change","#classes",function()
        {
            var classes=$(this).val();
         //   var education_level=$(this).val();
            var education_level = $("#education_level").val();
            var education_type_ids = $("#education_type_ids").val();

            if(education_level>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/education_classes'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{education_level: education_level, classes: classes,education_type_ids: education_type_ids},
                    success: function (data, status)
                    {
                       $('#classesname').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            
        });

</script>