<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
  $CI =& get_instance();
$user = User_helper::get_user();
//echo $user->user_group_id;
// $CI->db->where('institute.divid', $user->division);
// $CI->db->where('institute.zillaid', $user->zilla);
//  $CI->db->where('institute.upozillaid', $user->upazila);
// $CI->db->where('institute.status', 2);
// $CI->db->select('institute.*');
// $CI->db->from($CI->config->item('table_institute').' institute');
  
 $this->db->where('institute.divid', $user->division);
 $this->db->where('institute.zillaid', $user->zilla);
  $this->db->where('institute.upozillaid', $user->upazila);
 $this->db->where('institute.status', 2);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$query = $this->db->get();
echo $rowcount = $query->num_rows();
// Total Upozila institute number
//echo $user->division;
//echo $user->zilla;
//echo $user->upazila;

// Total Primary School

 $this->db->where('institute.divid', $user->division);
 $this->db->where('institute.zillaid', $user->zilla);
  $this->db->where('institute.upozillaid', $user->upazila);
  $this->db->where('institute.status', 2);
 $this->db->where('institute.is_primary', 1);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$queryPrimary = $this->db->get();
echo $rowcount = $queryPrimary->num_rows();


// Total Secondary School

 $this->db->where('institute.divid', $user->division);
 $this->db->where('institute.zillaid', $user->zilla);
  $this->db->where('institute.upozillaid', $user->upazila);
  $this->db->where('institute.status', 2);
 $this->db->where('institute.is_secondary', 1);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$querysecondary = $this->db->get();
echo $rowcount = $querysecondary->num_rows();


// Total College 

 $this->db->where('institute.divid', $user->division);
 $this->db->where('institute.zillaid', $user->zilla);
  $this->db->where('institute.upozillaid', $user->upazila);
  $this->db->where('institute.status', 2);
 $this->db->where('institute.is_higher', 1);
//   $this->db->select('institute.*');
 $this->db->from($CI->config->item('table_institute'));
$queryCollege = $this->db->get();
echo $rowcount = $queryCollege->num_rows();


?>