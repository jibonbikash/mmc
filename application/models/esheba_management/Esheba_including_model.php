<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Esheba_including_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_service_list()
    {
        $CI =& get_instance();
        $this->db->select('service_id id, service_name, service_type, service_amount, status');
        $this->db->from($CI->config->item('table_services'));
        $this->db->where('status !=',99);
        $this->db->where('status', $this->config->item('STATUS_ACTIVE'));
        $services = $this->db->get()->result_array();
        $service_info=array();

        foreach($services as $service)
        {
            $service_info[$service['id']]['status']=$service['status'];
            $service_info[$service['id']]['service_id']=$service['id'];
            $service_info[$service['id']]['service_name']=$service['service_name'];
            $service_info[$service['id']]['service_amount']=$service['service_amount'];
        }

        return $service_info;
    }

    public function get_user_service_list()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();

        $this->db->select('service_id id, service_name, service_type, service_amount, status');
        $this->db->from($CI->config->item('table_services'));

        $this->db->where('status', $this->config->item('STATUS_INACTIVE'));
        $services = $this->db->get()->result_array();
        $service_info = array();

        foreach($services as $service)
        {
            $service_info[$service['id']]['service_id']=$service['id'];
            $service_info[$service['id']]['service_name']=$service['service_name'];
            $service_info[$service['id']]['service_amount']=$service['service_amount'];
        }
        return $service_info;
    }

    public function get_user_services()
    {
        $user=User_helper::get_user();
        $CI =& get_instance();
        $this->db->select('uisc_id, service_id, user_id');
        $this->db->from($CI->config->item('table_services_uisc'));
        $this->db->where('user_id', $user->id);
        $this->db->where('status', $this->config->item('STATUS_ACTIVE'));
        $services = $this->db->get()->result_array();
        return $services;
    }

    public function check_existence($value,$id, $field_name)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_services'));
        $CI->db->where($field_name,$value);
        if($id>0)
        {
            $CI->db->where('service_id !=',$id);
        }

        $result = $CI->db->get()->row_array();
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}