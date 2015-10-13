<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Esheba_create_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_record_list()
    {
        $CI =& get_instance();
        $this->db->select('service_id id, service_name, service_type, service_amount, status');
        $this->db->from($CI->config->item('table_services'));
        $this->db->where('status', $this->config->item('STATUS_ACTIVE'));
        $users = $this->db->get()->result_array();
        foreach($users as &$user)
        {
            $user['edit_link']=$CI->get_encoded_url('esheba_management/Esheba_create/index/edit/'.$user['id']);
            if($user['status']==$this->config->item('STATUS_ACTIVE'))
            {
                $user['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($user['status']==$this->config->item('STATUS_INACTIVE'))
            {
                $user['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $user['status_text']=$user['status'];
            }
        }
        return $users;
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