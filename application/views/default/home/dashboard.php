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
$user = User_helper::get_user();
//echo $user_division = $user->user_group_id.'dfdfd';
?>
<div class="constant">
    <div class="row" style="margin-top: 30px;">
        
        <?php
     //   echo $user->user_group_id;
        if($user->user_group_id==$this->config->item('USER_GROUP_DIVISION_1'))
        {
        $CI->load_view('home/division_user');
    //    $this->load->view('home/division_user');
        }
        elseif ($user->user_group_id==$this->config->item('USER_GROUP_DIVISION_2')) {
         //   $this->load->view('home/division_user');
             $CI->load_view('home/division_user');
        
    }
    
     elseif ($user->user_group_id==$this->config->item('USER_GROUP_DIVISION_3')) {
   //    $this->load->view('home/division_user');
        $CI->load_view('home/division_user');
         
    }
    
     elseif ($user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_1')) {
    //    $CI->load_view('district_user');
      //  $this->load->view('home/district_user');
         $CI->load_view('home/district_user');
    }
    
    
     elseif ($user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_2')) {
     //   $CI->load_view('district_user');
      //  $this->load->view('home/district_user');
         $CI->load_view('home/district_user');
    }
    
    
    
     elseif ($user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_3')) {
      //  $CI->load_view('district_user');
      //  $this->load->view('home/district_user');
          $CI->load_view('home/district_user');
    }
    
    
     elseif ($user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_4')) {
          $CI->load_view('home/district_user');
    }
    
    elseif ($user->user_group_id==$this->config->item('USER_GROUP_UPOZILA_1')) {
          $CI->load_view('home/upozila_user');
    }
    
   
    
    else
    //    echo $user->user_group_id;
   // echo $this->config->item('USER_GROUP_UPOZILA_1');
   //     echo 'dfdf123';
    $CI->load_view('home/institute');
        ?>
    </div>
</div>