<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Answer_create_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_question_list()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();

//        if($user->user_group_id==$this->config->item('A_TO_I_GROUP_ID'))
//        {
//            $CI->db->where('faqs.user_type', $this->config->item('A_TO_I_GROUP_ID'));
//        }
//
//        if($user->user_group_id==$this->config->item('DONOR_GROUP_ID'))
//        {
//            $CI->db->where('faqs.user_type', $this->config->item('DONOR_GROUP_ID'));
//        }
//
//        if($user->user_group_id==$this->config->item('MINISTRY_GROUP_ID'))
//        {
//            $CI->db->where('faqs.user_type', $this->config->item('MINISTRY_GROUP_ID'));
//        }

        if($user->user_group_id==$this->config->item('DIVISION_GROUP_ID'))
        {
            $user_division = $user->division;
            $user_uiscs = $this->get_div_user_uiscs($user_division);
            $CI->db->where("faqs.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('faqs.user_type', $this->config->item('DIVISION_GROUP_ID'));
        }
        elseif($user->user_group_id==$this->config->item('DISTRICT_GROUP_ID'))
        {
            $user_district = $user->zilla;
            $user_uiscs = $this->get_district_user_uiscs($user_district);
            $CI->db->where("faqs.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('faqs.user_type', $this->config->item('DISTRICT_GROUP_ID'));
        }
        elseif($user->user_group_id==$this->config->item('UPAZILLA_GROUP_ID'))
        {
            $user_district = $user->zilla;
            $user_upazilla = $user->upazila;
            $user_uiscs = $this->get_upazilla_user_uiscs($user_district, $user_upazilla);
            $CI->db->where("faqs.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('faqs.user_type', $this->config->item('UPAZILLA_GROUP_ID'));
        }
        elseif($user->user_group_id==$this->config->item('CITY_CORPORATION_GROUP_ID'))
        {
            $user_district = $user->zilla;
            $user_cityCorporation = $user->citycorporation;
            $user_uiscs = $this->get_citycorporation_user_uiscs($user_district, $user_cityCorporation);
            $CI->db->where("faqs.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('faqs.user_type', $this->config->item('CITY_CORPORATION_GROUP_ID'));
        }
        elseif($user->user_group_id==$this->config->item('MUNICIPAL_GROUP_ID'))
        {
            $user_district = $user->zilla;
            $user_municipal = $user->municipal;
            $user_uiscs = $this->get_municipal_user_uiscs($user_district, $user_municipal);
            $CI->db->where("faqs.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('faqs.user_type', $this->config->item('MUNICIPAL_GROUP_ID'));
        }

        $CI->db->select('faqs.*');
        $CI->db->select('groups.name_bn question_made_to');
        $CI->db->select('uisc_infos.uisc_name uisc_name');
        $CI->db->from($CI->config->item('table_faqs').' faqs');

        $CI->db->join($CI->config->item('table_user_group').' groups', 'groups.id = faqs.user_type', 'LEFT');
        $CI->db->join($CI->config->item('table_uisc_infos').' uisc_infos', 'uisc_infos.id = faqs.uisc_id', 'LEFT');
        $results = $CI->db->get()->result_array();

        foreach($results as &$result)
        {
            $result['edit_link']=$CI->get_encoded_url('faq_management/Answer_create/index/edit/'.$result['id']);
            if($result['answer']!='')
            {
                $result['ans_status'] = $CI->lang->line('ANSWERED');
            }
            else
            {
                $result['ans_status'] = $CI->lang->line('NOT_ANSWERED');
            }
        }
        return $results;
    }

    public function get_question_user_groups()
    {
        $CI =& get_instance();
        $skip = array
        (
            $this->config->item('SUPER_ADMIN_GROUP_ID'),
            $this->config->item('UNION_GROUP_ID'),
            $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
            $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
            $this->config->item('UISC_GROUP_ID')
        );

        $CI->db->from($CI->config->item('table_user_group').' groups');
        $CI->db->select('groups.*');

        $CI->db->where_not_in('groups.id',$skip);
        $result = $CI->db->get()->result_array();
        return $result;
    }

    public function get_faq_detail($id)
    {
        $CI =& get_instance();

        $CI->db->select('faqs.*');
        $CI->db->from($CI->config->item('table_faqs').' faqs');
        $CI->db->where('faqs.id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_div_user_uiscs($user_division)
    {
        $CI =& get_instance();

        $CI->db->select('users.uisc_id');
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.division', $user_division);
        $results = $this->db->get()->result_array();

        $ids_string=",";
        foreach($results as $result)
        {
            $ids_string.='"'.$result['uisc_id'].'",';
        }
        return trim($ids_string,",");
    }

    public function get_district_user_uiscs($user_district)
    {
        $CI =& get_instance();

        $CI->db->select('users.uisc_id');
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.zilla', $user_district);
        $results = $this->db->get()->result_array();

        $ids_string=",";
        foreach($results as $result)
        {
            $ids_string.='"'.$result['uisc_id'].'",';
        }
        return trim($ids_string,",");
    }

    public function get_upazilla_user_uiscs($user_district, $user_upazilla)
    {
        $CI =& get_instance();

        $CI->db->select('users.uisc_id');
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.zilla', $user_district);
        $CI->db->where('users.upazila', $user_upazilla);
        $results = $this->db->get()->result_array();

        $ids_string=",";
        foreach($results as $result)
        {
            $ids_string.='"'.$result['uisc_id'].'",';
        }
        return trim($ids_string,",");
    }

    public function get_citycorporation_user_uiscs($user_district, $user_cityCorporation)
    {
        $CI =& get_instance();

        $CI->db->select('users.uisc_id');
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.zilla', $user_district);
        $CI->db->where('users.citycorporation', $user_cityCorporation);
        $results = $this->db->get()->result_array();

        $ids_string=",";
        foreach($results as $result)
        {
            $ids_string.='"'.$result['uisc_id'].'",';
        }
        return trim($ids_string,",");
    }

    public function get_municipal_user_uiscs($user_district, $user_municipal)
    {
        $CI =& get_instance();

        $CI->db->select('users.uisc_id');
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.zilla', $user_district);
        $CI->db->where('users.municipal', $user_municipal);
        $results = $this->db->get()->result_array();

        $ids_string=",";
        foreach($results as $result)
        {
            $ids_string.='"'.$result['uisc_id'].'",';
        }
        return trim($ids_string,",");
    }
}