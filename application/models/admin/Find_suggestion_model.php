<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Find_suggestion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_suggestions($uisc_type, $division, $zilla, $upazilla, $municipal, $municipalward, $citycorporation, $citycorporationward, $union, $start_date, $end_date)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_suggestion').' sug');
        $CI->db->select('sug.*');
        $CI->db->select('uisc.uisc_name, uisc.uisc_email, uisc.uisc_mobile');

        $CI->db->join($CI->config->item('table_uisc_infos').' uisc','uisc.id = sug.uisc_id','LEFT');

        if($uisc_type>0)
        {
            $CI->db->where('uisc.uisc_type', $uisc_type);
        }
        if($division>0)
        {
            $CI->db->where('uisc.division', $division);
        }
        if($zilla>0)
        {
            $CI->db->where('uisc.zilla', $zilla);
        }
        if($upazilla>0)
        {
            $CI->db->where('uisc.upazilla', $upazilla);
        }
        if($union>0)
        {
            $CI->db->where('uisc.union', $union);
        }
        if($municipal>0)
        {
            $CI->db->where('uisc.municipal', $municipal);
        }
        if($municipalward>0)
        {
            $CI->db->where('uisc.municipalward', $municipalward);
        }
        if($citycorporation>0)
        {
            $CI->db->where('uisc.citycorporation', $citycorporation);
        }
        if($citycorporationward>0)
        {
            $CI->db->where('uisc.citycorporationward', $citycorporationward);
        }
        if(!empty($start_date))
        {
            $CI->db->where('sug.date>=', $start_date);
        }
        if(!empty($end_date))
        {
            $CI->db->where('uisc.date<=', $end_date);
        }

        $results = $this->db->get()->result_array();

        foreach($results as &$result)
        {
            $result['edit_link']=$CI->get_encoded_url('admin/find_suggestion/index/edit/'.$result['suggestion_box_id']);
        }

        $CI->jsonReturn($results);
    }

    public function get_suggestion_detail($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_suggestion').' sug');
        $CI->db->select('sug.*');

        $CI->db->where('sug.suggestion_box_id', $id);
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