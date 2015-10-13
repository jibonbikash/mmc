<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suggestion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_uisc_services()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $uisc_id = $user->uisc_id;

        $CI->db->from($CI->config->item('table_services_uisc').' uisc_services');
        $CI->db->select('uisc_services.service_id');
        $CI->db->select('services.service_name');
        $CI->db->where('uisc_services.uisc_id', $uisc_id);
        $CI->db->where('uisc_services.status', $CI->config->item('STATUS_ACTIVE'));
        $CI->db->join($CI->config->item('table_services').' services', 'services.service_id = uisc_services.service_id', 'LEFT');
        $results = $CI->db->get()->result_array();

        return $results;
    }

    public function get_service_name($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_services').' services');
        $CI->db->select('services.service_name');
        $CI->db->where('services.service_id', $id);
        $results = $CI->db->get()->row_array();
        return $results['service_name'];
    }

    public function chk_existing_uploded_excel_file()
    {
        $CI =& get_instance();
        $toDay = strtotime(date('Y-m-d'));
        $user = User_helper::get_user();
        $user_id = $user->id;

        $CI->db->from($CI->config->item('table_excel_history').' history');
        $CI->db->select('COUNT(history.id) file_quantity');
        $CI->db->where('history.user_id', $user_id);
        $CI->db->where('history.upload_date', $toDay);
        $results = $CI->db->get()->row_array();
        return $results['file_quantity'];

    }

    public function get_service_id($name)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_services').' services');
        $CI->db->select('services.service_id');
        $CI->db->where('services.service_name', $name);
        $results = $CI->db->get()->row_array();
        return $results['service_id'];
    }

}