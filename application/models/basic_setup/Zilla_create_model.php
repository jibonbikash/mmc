<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zilla_create_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_record_list()
    {
        $CI =& get_instance();
        $this->db->select('zillas.id,
                            zillas.zillaname,
                            divisions.divname,
                            zillas.visible');
        $this->db->from($CI->config->item('table_zillas').' zillas');
        $this->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = zillas.divid','LEFT');
        $this->db->order_by('divisions.divid');
        $users = $this->db->get()->result_array();
        foreach($users as &$user)
        {
            $user['edit_link']=$CI->get_encoded_url('basic_setup/Zilla_create/index/edit/'.$user['id']);
            if($user['visible']==1)
            {
                $user['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($user['visible']==0)
            {
                $user['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $user['status_text']=$user['visible'];
            }
        }
        return $users;
    }


    public function check_existence($value,$id, $field_name)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_zillas'));
        $CI->db->where($field_name,$value);
        if($id<1)
        {
            $CI->db->where('divid !=',$id);
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