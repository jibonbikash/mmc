<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_password_reset_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users($uisc_type, $division, $zilla, $upazilla, $municipal, $municipalward, $citycorporation, $citycorporationward, $union, $user_id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->select('users.*');
        $CI->db->select('uiscinfos.uisc_name');
        $CI->db->select('entrepreneur.entrepreneur_email, entrepreneur.entrepreneur_mobile, entrepreneur.entrepreneur_name');

        $CI->db->join($CI->config->item('table_uisc_infos').' uiscinfos','uiscinfos.id = users.uisc_id','LEFT');
        $CI->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneur','entrepreneur.user_id = users.id','LEFT');

        if($uisc_type>0)
        {
            $CI->db->where('users.uisc_type', $uisc_type);
        }
        if($division>0)
        {
            $CI->db->where('users.division', $division);
        }
        if($zilla>0)
        {
            $CI->db->where('users.zilla', $zilla);
        }
        if($upazilla>0)
        {
            $CI->db->where('users.upazila', $upazilla);
        }
        if($union>0)
        {
            $CI->db->where('users.union', $union);
        }
        if($municipal>0)
        {
            $CI->db->where('users.municipal', $municipal);
        }
        if($municipalward>0)
        {
            $CI->db->where('users.municipalward', $municipalward);
        }
        if($citycorporation>0)
        {
            $CI->db->where('users.citycorporation', $citycorporation);
        }
        if($citycorporationward>0)
        {
            $CI->db->where('users.citycorporationward', $citycorporationward);
        }
        if(strlen($user_id)>1)
        {
            $CI->db->where('users.username', $user_id);
        }

        $CI->db->where('users.user_group_id', $CI->config->item('UISC_GROUP_ID'));

        $results = $this->db->get()->result_array();

        foreach($results as &$result)
        {
            $result['edit_link']=$CI->get_encoded_url('user_management/user_password_reset/index/edit/'.$result['id']);
        }

        $CI->jsonReturn($results);
    }

    public function get_password_detail($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->select('users.id, users.username, users.password, users.ques_id, users.ques_ans');

        $CI->db->where('users.id', $id);
        $results = $CI->db->get()->row_array();
        return $results;
    }

    public static function get_divisions_by_user()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $CI->db->from($CI->config->item('table_divisions'));
        $CI->db->select('*');
        if($user_group_id > $CI->config->item('MINISTRY_GROUP_ID'))
        {
            $CI->db->where('divid', $user->division);
        }

        $results = $CI->db->get()->result_array();
        return $results;
    }


}