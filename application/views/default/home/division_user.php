<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $CI =& get_instance();
$user = User_helper::get_user();
//echo $user->division;
//echo $user->user_group_id;
// $CI->db->where('institute.divid', $user->division);
// $CI->db->where('institute.zillaid', $user->zilla);
//  $CI->db->where('institute.upozillaid', $user->upazila);
// $CI->db->where('institute.status', 2);
// $CI->db->select('institute.*');
// $CI->db->from($CI->config->item('table_institute').' institute');
  
 $this->db->where('institute.divid', $user->division);
 $this->db->where('institute.status', 2);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$query = $this->db->get();
$rowcount = $query->num_rows();
// Total Upozila institute number
//echo $user->division;
//echo $user->zilla;
//echo $user->upazila;

// Total Primary School

 $this->db->where('institute.divid', $user->division);
  $this->db->where('institute.status', 2);
 $this->db->where('institute.is_primary', 1);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$queryPrimary = $this->db->get();
$rowcountPrimary = $queryPrimary->num_rows();


// Total Secondary School

 $this->db->where('institute.divid', $user->division);

  $this->db->where('institute.status', 2);
 $this->db->where('institute.is_secondary', 1);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$querysecondary = $this->db->get();
$rowcountsecondary = $querysecondary->num_rows();


// Total College 

 $this->db->where('institute.divid', $user->division);
  $this->db->where('institute.status', 2);
 $this->db->where('institute.is_higher', 1);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$queryCollege = $this->db->get();
$rowcountCollege = $queryCollege->num_rows();
?>
<div class="system_content col-sm-3 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/1-48.png'); ?>" />
          
            <br>
            <h4>নিবন্ধিত শিক্ষা প্রতিষ্ঠান ( <?php echo $rowcount; ?> )</h4>
        </div>
    </div>

<div class="system_content col-sm-3 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/2-48.png'); ?>" />
          
            <br>
            <h4>প্রাথমিক স্তর ( <?php echo $rowcountPrimary; ?> )</h4>
        </div>
    </div>


<div class="system_content col-sm-3 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/9-48.png'); ?>" />
          
            <br>
            <h4>মাধ্যমিক স্তর ( <?php echo $rowcountsecondary; ?> )</h4>
        </div>
    </div>

<div class="system_content col-sm-3 text-center">
        <div class="shadow curved-2">
            <img src="<?php echo site_url('images/dashboard/3-48.png'); ?>" />
          
            <br>
            <h4>উচ্চমাধ্যমিক স্তর ( <?php echo $rowcountCollege; ?> )</h4>
        </div>
    </div>