<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secret_question_change_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users_info()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_users').' user');
        $this->db->select('user.*');
        $this->db->select('user.name_'.$CI->get_language_code().' user_name');
        $this->db->where('user.status != 99');

        $users = $this->db->get()->result_array();

        foreach($users as &$user)
        {
            $user['edit_link']=$CI->get_encoded_url('profile/secret_question_change/index/edit/'.$user['id']);
            if($user['status']==1)
            {
                $user['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($user['status']==0)
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

    public function get_user_list($tableName, $name_string)
    {
        $CI =& get_instance();
        $CI->db->from($tableName);
        $CI->db->select('name_'.$CI->get_language_code().' label');
        $CI->db->select('id value');
        $CI->db->where('status != 99');
        $CI->db->where("(name_en LIKE '%$name_string%' OR name_bn LIKE '%$name_string%')",'', false);
        $users = $CI->db->get()->result_array();
        return $users;
    }

    public function check_username_existence($username,$id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' user');
        $CI->db->select('user.*');
        $CI->db->where('user.username',$username);
        if($id>0)
        {
            $CI->db->where('user.id !=',$id);
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