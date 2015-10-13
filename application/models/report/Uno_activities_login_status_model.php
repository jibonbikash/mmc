<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uno_activities_login_status_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_uno_user_activities_login_status()
    {
        $user = User_helper::get_user();
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_services_uisc').' uisc_services');
        $CI->db->select('uisc_services.*');
        $CI->db->select('services.service_name');
        $CI->db->where('uisc_services.uisc_id', $user->uisc_id);

        $CI->db->join($CI->config->item('table_services').' services','services.service_id = uisc_services.service_id', 'LEFT');
        $results = $CI->db->get()->result_array();
        return $results;
    }

    //    public function get_income_info($from_date, $to_date)
    //    {
    //        $user = User_helper::get_user();
    //        $CI = & get_instance();
    //
    //        $CI->db->from($CI->config->item('table_invoices').' invoices');
    //        $CI->db->select('invoices.*');
    //
    //        if($from_date !='')
    //        {
    //            $CI->db->where('invoices.invoice_date >=', $from_date);
    //        }
    //
    //        if($to_date !='')
    //        {
    //            $CI->db->where('invoices.invoice_date <=', $to_date);
    //        }
    //
    //        $CI->db->where('invoices.uisc_id', $user->uisc_id);
    //
    //        $results = $CI->db->get()->result_array();
    //        return $results;
    //    }
    //
    //    public function get_device_info()
    //    {
    //        $user = User_helper::get_user();
    //        $CI = & get_instance();
    //
    //        $CI->db->from($CI->config->item('table_device_infos').' device');
    //        $CI->db->select('device.*');
    //
    //        $CI->db->where('device.uisc_id', $user->uisc_id);
    //        $CI->db->where('device.user_id', $user->id);
    //
    //        $results = $CI->db->get()->result_array();
    //        return $results;
    //    }
    //
    //    public function get_asset_info()
    //    {
    //        $user = User_helper::get_user();
    //        $CI = & get_instance();
    //        $CI->db->from($CI->config->item('table_uisc_resources').' uisc_resources');
    //        $CI->db->select('uisc_resources.*');
    //        $CI->db->select('resources.res_name');
    //
    //        $CI->db->where('uisc_resources.uisc_id', $user->uisc_id);
    //        $CI->db->where('uisc_resources.user_id', $user->id);
    //
    //        $CI->db->join($CI->config->item('table_resources').' resources','resources.res_id = uisc_resources.res_id', 'LEFT');
    //        $results = $CI->db->get()->result_array();
    //        return $results;
    //    }


}