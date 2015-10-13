<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function CountUnionServiceCenter($division_id, $zilla_id, $upzilla_id, $unioun_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as user_id');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('upazilla', $upzilla_id);
        $CI->db->where('union', $unioun_id);
        $CI->db->group_by("division", "zilla", "upazilla", "unioun");

        $count = $CI->db->count_all_results();

        if($count > 0)
        {
            $total_uisc = $count + 1;
        }
        else
        {
            $total_uisc = "01";
        }
        return $total_uisc;
    }

    public function getUnionServiceCenter($division_id, $zilla_id, $upzilla_id, $unioun_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos'));
        $CI->db->select('id, uisc_name');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('upazilla', $upzilla_id);
        $CI->db->where('union', $unioun_id);

        $results = $CI->db->get()->result_array();
        return $results;
    }

    public function countCityServiceCenter($division_id, $zilla_id, $citycorporation_id, $city_corporation_ward_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as user_id');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('citycorporation', $citycorporation_id);
        $CI->db->where('citycorporationward', $city_corporation_ward_id);
        $CI->db->group_by("division", "zilla", "citycorporation", "citycorporationward");

        $count = $CI->db->count_all_results();

        if($count > 0)
        {
            $total_uisc = $count + 1;
        }
        else
        {
            $total_uisc = "01";
        }
        return $total_uisc;
    }

    public function getCityServiceCenter($division_id, $zilla_id, $citycorporation_id, $city_corporation_ward_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos'));
        $CI->db->select('id, uisc_name');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('citycorporation', $citycorporation_id);
        $CI->db->where('citycorporationward', $city_corporation_ward_id);
        $results = $CI->db->get()->result_array();
        return $results;
    }

    public function countMunicipalServiceCenter($division_id, $zilla_id, $municipal_id, $municipal_ward_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as user_id');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('municipal', $municipal_id);
        $CI->db->where('municipalward', $municipal_ward_id);
        $CI->db->group_by("division", "zilla", "municipal", "municipalward");

        $count = $CI->db->count_all_results();

        if($count > 0)
        {
            $total_uisc = $count + 1;
        }
        else
        {
            $total_uisc = "01";
        }
        return $total_uisc;
    }

    public function getMunicipalServiceCenter($division_id, $zilla_id, $municipal_id, $municipal_ward_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos'));
        $CI->db->select('id, uisc_name');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('municipal', $municipal_id);
        $CI->db->where('municipalward', $municipal_ward_id);

        $results = $CI->db->get()->result_array();
        return $results;
    }

    public function get_union_name($zilla, $upazilla, $union)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_unions'));
        $CI->db->select('unionname');
        $CI->db->where('zillaid', $zilla);
        $CI->db->where('upazilaid', $upazilla);
        $CI->db->where('unionid', $union);
        $result = $CI->db->get()->row_array();
        return $result['unionname'];
    }

    public function get_city_name($zilla, $city)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_city_corporations'));
        $CI->db->select('citycorporationname');
        $CI->db->where('zillaid', $zilla);
        $CI->db->where('citycorporationid', $city);
        $result = $CI->db->get()->row_array();
        return $result['citycorporationname'];
    }

    public function get_city_ward_name($zilla, $city, $ward)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_city_corporation_wards'));
        $CI->db->select('wardname');
        $CI->db->where('zillaid', $zilla);
        $CI->db->where('citycorporationid', $city);
        $CI->db->where('citycorporationwardid', $ward);
        $result = $CI->db->get()->row_array();
        return $result['wardname'];
    }

    public function get_municipal_name($zilla, $municipal)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_municipals'));
        $CI->db->select('municipalname');
        $CI->db->where('zillaid', $zilla);
        $CI->db->where('municipalid', $municipal);
        $result = $CI->db->get()->row_array();
        return $result['municipalname'];
    }

    public function get_municipal_ward_name($zilla, $municipal, $ward)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_municipal_wards'));
        $CI->db->select('wardname');
        $CI->db->where('zillaid', $zilla);
        $CI->db->where('municipalid', $municipal);
        $CI->db->where('wardid', $ward);
        $result = $CI->db->get()->row_array();
        return $result['wardname'];
    }

}