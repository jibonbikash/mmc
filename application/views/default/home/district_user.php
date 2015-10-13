<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="col-md-4">
   
    <div class="table-responsive">
        <table class="table">
   <caption> <h4>   প্রাথমিক স্তর</h4></caption>
   
   <tbody>
      <tr>
         <td> </td>
         <td>মোট</td>
         <td>সাধারন</td>
         <td>মাদ্রাসা</td>
      </tr>
      <tr>
         <td>রেজিস্ট্রারকৃত বিদ্যালয়</td>
         <td>
             <?php
             $CI =& get_instance();
            $user = User_helper::get_user();
             $user_district = $user->zilla;
            $user_division = $user->division;     
        $this->db->where(array('institute.divid' => $user_division,'institute.zillaid' => $user_district, 'institute.is_primary' => 1));
        echo $this->db->count_all_results($CI->config->item('table_institute'));

          // echo $total = $u->count();

            
      //      $CI->db->where('institute.divid',$user_division);
     //       $CI->db->where('institute.zillaid', $user->zilla);
             ?>
         </td>
         <td>
    <?php
    $this->db->where(array('institute.divid' => $user_division,'institute.zillaid' => $user_district, 'institute.education_type_ids' => 1, 'institute.is_primary' => 1));
        echo $this->db->count_all_results($CI->config->item('table_institute'));
    ?>
             
         </td>
         <td><?php
    $this->db->where(array('institute.divid' => $user_division,'institute.zillaid' => $user_district, 'institute.education_type_ids' => 2, 'institute.is_primary' => 1));
        echo $this->db->count_all_results($CI->config->item('table_institute'));
    ?></td>
      </tr>
      <tr>
         <td>এমএমসি ব্যবহার করেছেন</td>
         <td>Tanmay</td>
         <td>Tanmay</td>
         <td>Bangalore</td>
      </tr>
      
      <tr>
         <td>শতকরা</td>
         <td>Tanmay</td>
         <td>Tanmay</td>
         <td>Bangalore</td>
      </tr>
      
   </tbody>
</table>
   
   
    </div>
</div>

<div class="col-md-4">
  
    <div class="table-responsive">
        <table class="table">
   <caption>  <h4>  মাধ্যমিক স্তর</h4></caption>
   
   <tbody>
      <tr>
         <td> </td>
         <td>মোট</td>
         <td>সাধারন</td>
         <td>মাদ্রাসা</td>
      </tr>
      <tr>
         <td>রেজিস্ট্রারকৃত বিদ্যালয়</td>
         <td>
             <?php
             $CI =& get_instance();
            $user = User_helper::get_user();
             $user_district = $user->zilla;
            $user_division = $user->division;     
        $this->db->where(array('institute.divid' => $user_division,'institute.zillaid' => $user_district, 'institute.is_secondary' => 1));
        echo $this->db->count_all_results($CI->config->item('table_institute'));

          // echo $total = $u->count();

            
      //      $CI->db->where('institute.divid',$user_division);
     //       $CI->db->where('institute.zillaid', $user->zilla);
             ?>
         </td>
         <td>
    <?php
    $this->db->where(array('institute.divid' => $user_division,'institute.zillaid' => $user_district, 'institute.education_type_ids' => 1, 'institute.is_secondary' => 1));
        echo $this->db->count_all_results($CI->config->item('table_institute'));
    ?>
             
         </td>
         <td><?php
    $this->db->where(array('institute.divid' => $user_division,'institute.zillaid' => $user_district, 'institute.education_type_ids' => 2, 'institute.is_secondary' => 1));
        echo $this->db->count_all_results($CI->config->item('table_institute'));
    ?></td>
      </tr>
      <tr>
         <td>এমএমসি ব্যবহার করেছেন</td>
         <td>Tanmay</td>
         <td>Tanmay</td>
         <td>Bangalore</td>
      </tr>
      
      <tr>
         <td>শতকরা</td>
         <td>Tanmay</td>
         <td>Tanmay</td>
         <td>Bangalore</td>
      </tr>
      
   </tbody>
</table>
   
   
    </div>
    
</div>

<div class="col-md-4">
   <h4> উচ্চমাধ্যমিক স্তর  </h4>
</div>