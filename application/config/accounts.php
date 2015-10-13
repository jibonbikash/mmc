<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Account Keyword Types for DropDown
$config['accounts_keyword_types'][1]='Debit';
$config['accounts_keyword_types'][2]='Credit';

//$config['accounts_keyword_types'][1]='Student';
//$config['accounts_keyword_types'][2]='Teacher';
//$config['accounts_keyword_types'][3]='Administration';
//$config['accounts_keyword_types'][4]='Expenditure';

// Account Keyword Duration
$config['accounts_keyword_duration'][1] = 'Hourly';
$config['accounts_keyword_duration'][2] = 'Daily';
$config['accounts_keyword_duration'][3] = 'Weekly';
$config['accounts_keyword_duration'][4] = 'Fortnightly';
$config['accounts_keyword_duration'][5] = 'Monthly';
$config['accounts_keyword_duration'][6] = 'Quarterly';
$config['accounts_keyword_duration'][7] = 'Half Yearly';
$config['accounts_keyword_duration'][8] = 'Yearly';
$config['accounts_keyword_duration'][9] = 'Once';
$config['accounts_keyword_duration'][10] = 'Other';

// Account Template Types
$config['accounts_template_type'][1] = 'Student';
$config['accounts_template_type'][2] = 'Teacher';
$config['accounts_template_type'][3] = 'Administrative';