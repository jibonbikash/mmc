<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//public pages
$config['PUBLIC_CONTROLLERS']=array('home', 'entrepreneur_registration','user_registration', 'common', 'eservice_list', 'help_desk_contact','media_corner','public_notice');
/////// Pagination Config
$config['page_size']=100;
///// report language folder
$config['GET_LANGUAGE']="bangla";

//upload directories
$config['dcms_upload']['entrepreneur']='images/entrepreneur';
$config['dcms_upload']['excel']='uploads/excel';
$config['dcms_upload']['notice']='images/notice';

// USER GROUP ADED BY JIBON BIKASH ROY <jibon.bikash@gmail.com>

$config['SUPER_ADMIN_GROUP_ID'] = 1; 

$config['USER_GROUP_A2I'] = 2;  // A2i Group

$config['USER_GROUP_MINISTRY_1'] = 3;  // Ministry 1 Group
$config['USER_GROUP_MINISTRY_2'] = 4;  // Ministry 2 Group
$config['USER_GROUP_MINISTRY_3'] = 5;  // Ministry 3 Group
$config['USER_GROUP_MINISTRY_4'] = 6;  // Ministry 4 Group

$config['USER_GROUP_DONNER_1'] = 7;  // Donner 1 Group
$config['USER_GROUP_DONNER_2'] = 8;  // Donner 2 Group
$config['USER_GROUP_DONNER_3'] = 9;  // Donner 3 Group


$config['USER_GROUP_DIVISION_1'] = 10;  // Division 1 Group
$config['USER_GROUP_DIVISION_2'] = 11;  // Division 2 Group
$config['USER_GROUP_DIVISION_3'] = 12;  // Division 3 Group

$config['USER_GROUP_DISTRICT_1'] = 13;  // District 1 Group
$config['USER_GROUP_DISTRICT_2'] = 14;  // District 2 Group
$config['USER_GROUP_DISTRICT_3'] = 15;  // District 3 Group
$config['USER_GROUP_DISTRICT_4'] = 16;  // District 4 Group

$config['USER_GROUP_UPOZILA_1'] = 17;  // Upazila 1 Group
$config['USER_GROUP_UPOZILA_2'] = 18;  // Upazila 2 Group
$config['USER_GROUP_UPOZILA_3'] = 19;  // Upazila 3 Group

$config['USER_GROUP_INSTITUTE_4'] = 20;  // Institute Group

// END USER GROUP

$config['ADMIN_GROUP_B_ID'] = 3; //Administrator level user gruop
$config['ADMIN_GROUP_C_ID'] = 4; //Administrator level user gruop
$config['ADMIN_GROUP_D_ID'] = 5; //Administrator level user gruop
$config['ADMIN_GROUP_E_ID'] = 6; //Administrator level user gruop
$config['ADMIN_GROUP_F_ID'] = 7; //Administrator level user gruop
$config['ADMIN_GROUP_G_ID'] = 8; //Administrator level user gruop
$config['ADMIN_GROUP_H_ID'] = 9; //Administrator level user gruop
$config['ADMIN_GROUP_I_ID'] = 10; //Administrator level user gruop
$config['USERGROUP_DIVISION'] = 5;

$config['DIVISION_GROUP_A_ID'] = 11; // Division level user group
$config['DIVISION_GROUP_B_ID'] = 12; // Division level user group
$config['DIVISION_GROUP_C_ID'] = 13; // Division level user group
$config['DIVISION_GROUP_D_ID'] = 14; // Division level user group
$config['DIVISION_GROUP_E_ID'] = 15; // Division level user group

$config['DISTRICT_GROUP_A_ID'] = 16; // District level user group
$config['DISTRICT_GROUP_B_ID'] = 17; // District level user group
$config['DISTRICT_GROUP_C_ID'] = 18; // District level user group
$config['DISTRICT_GROUP_D_ID'] = 19; // District level user group
$config['DISTRICT_GROUP_E_ID'] = 20; // District level user group

$config['UPAZILLA_GROUP_A_ID'] = 21; // Upazilla level user group
$config['UPAZILLA_GROUP_B_ID'] = 22; // Upazilla level user group
$config['UPAZILLA_GROUP_C_ID'] = 23; // Upazilla level user group
$config['UPAZILLA_GROUP_D_ID'] = 24; // Upazilla level user group
$config['UPAZILLA_GROUP_E_ID'] = 25; // Upazilla level user group

$config['INSTITUTE_GROUP_ID'] = 26;

$config['ONLINE_UNION_GROUP_ID'] = 1;
$config['ONLINE_CITY_CORPORATION_WORD_GROUP_ID'] = 2;
$config['ONLINE_MUNICIPAL_WORD_GROUP_ID'] = 3;

$config['STATUS_INACTIVE']=0; // SERVICE PROPOSED
$config['STATUS_ACTIVE']=1; // SERVICE, USER APPROVED
$config['STATUS_REJECT']=2;   // USER DENY
$config['STATUS_SUSPEND']=3;
$config['STATUS_TEMPORARY_SUSPEND']=4;
$config['STATUS_DELETE']=99;

$config['GENDER_MALE']=1;
$config['GENDER_FEMALE']=2;

$config['DATE_DISPLAY_FORMAT'] = 'Y-m-d';

$config['system_sidebar01'] = 'position_left_01';
$config['system_sidebar02'] = 'position_top_01';

$config['system_TYPE'] = 'TYPE';

// Entrepreneur Type
$config['entrepreneur_type'][1] = 'ইউনিয়ন পরিষদ';
$config['entrepreneur_type'][2] = 'সিটি কর্পোরেশন';
$config['entrepreneur_type'][3] = 'পৌরসভা';

// Division
$config['division'][10] = 'বরিশাল';
$config['division'][20] = 'চট্টগ্রাম';
$config['division'][30] = 'ঢাকা';
$config['division'][40] = 'খুলনা';
$config['division'][50] = 'রাজশাহী';
$config['division'][55] = 'রংপুর';
$config['division'][60] = 'সিলেট';

// Modems
$config['modem']['GP'] = 'GP';
$config['modem']['Banglalink'] = 'Banglalink';
$config['modem']['Airtel'] = 'Airtel';
$config['modem']['Banglalion'] = 'Banglalion';
$config['modem']['CityCell'] = 'CityCell';
$config['modem']['Robi'] = 'Robi';
$config['modem']['Teletalk'] = 'Teletalk';
$config['modem']['Qubee'] = 'Qubee';

// Equipment Status
$config['equipment_status'][0] = 'ভাল';
$config['equipment_status'][1] = 'ত্রুটিপূর্ণ';

// Year
$config['approval_year']['2012'] = '2012';
$config['approval_year']['2013'] = '2013';
$config['approval_year']['2014'] = '2014';
$config['approval_year']['2015'] = '2015';
$config['approval_year']['2016'] = '2016';
$config['approval_year']['2017'] = '2017';
$config['approval_year']['2018'] = '2018';

// Month
$config['month']['01'] = 'জানুয়ারি';
$config['month']['02'] = 'ফেব্রুয়ারি';
$config['month']['03'] = 'মার্চ';
$config['month']['04'] = 'এপ্রিল';
$config['month']['05'] = 'মে';
$config['month']['06'] = 'জুন';
$config['month']['07'] = 'জুলাই';
$config['month']['08'] = 'আগস্ট';
$config['month']['09'] = 'সেপ্টেম্বর';
$config['month']['10'] = 'অক্টোবর';
$config['month']['11'] = 'নভেম্বর';
$config['month']['12'] = 'ডিসেম্বর';

//report menu id
$config['report_component_id']=3;

//Entrepreneur training course
$config['training_course'][1] = 'বেসিক কম্পিউটিং';
$config['training_course'][2] = 'এম এস ওয়ার্ড';
$config['training_course'][3] = 'এম এস এক্সেল';

// Center location Info
$config['center_location_info'][1]='ইউপি ভবন';
$config['center_location_info'][2]='ভাড়াকৃত (ইউপি)';
$config['center_location_info'][3]='ভাড়াকৃত (নিজ)';

// Latest Academic Info
$config['latest_academic_info'][1]='এস এস সি';
$config['latest_academic_info'][2]='এইচ এস সি';
$config['latest_academic_info'][3]='স্নাতক';
$config['latest_academic_info'][4]='স্নাতকোত্তর';

// jibon
