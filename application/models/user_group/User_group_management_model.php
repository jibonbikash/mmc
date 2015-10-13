<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_group_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_user_groups()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_user_group').' group');
        $this->db->select('group.id,group.ordering,group.status');
        $this->db->select('group.name_'.$CI->get_language_code().' name');
        $this->db->order_by('group.ordering ASC');
        $this->db->where('status != 99');
        $groups=$this->db->get()->result_array();
        foreach($groups as &$group)
        {
            $group['edit_link']=$CI->get_encoded_url('user_group/user_group_management/index/edit/'.$group['id']);
            if($group['status']==1)
            {
                $group['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($group['status']==0)
            {
                $group['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $group['status_text']=$group['status'];
            }
        }
        return $groups;
    }
    public function get_user_group_details($ids)
    {
        if($ids)
        {
            $CI =& get_instance();

            $this->db->from($CI->config->item('table_user_group').' group');
            $this->db->select('group.id,group.ordering,group.name_en,group.name_bn,group.status');
            $this->db->where_in('id',$ids);
            $this->db->where('status != 99');
            $this->db->order_by('group.ordering ASC');
            $groups=$this->db->get()->result_array();

            return $groups;
        }
        else
        {
            return null;
        }

    }
}