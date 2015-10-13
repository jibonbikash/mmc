<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_approval_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_approval_uisc_detail($entrepreneur_type, $division, $zilla, $upazilla, $municipal, $municipalward, $citycorporation, $citycorporationward, $union, $year, $month, $date, $status)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' uisc');
        $CI->db->select('uisc.*');
        $CI->db->select('uisc_infos.uisc_name');
        $CI->db->select('entrepreneur_infos.entrepreneur_address');

        if(!empty($status))
        {
            $CI->db->where('uisc.status', $status);
        }
        if($entrepreneur_type>0)
        {
            $CI->db->where('uisc.user_group_id', $entrepreneur_type);
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
            $CI->db->where('uisc.upazila', $upazilla);
        }
        if($union>0)
        {
            $CI->db->where('uisc.unioun', $union);
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
        if(strtotime($date)>0)
        {
            $CI->db->where('uisc.create_date', strtotime($date));
        }
        if($month>0)
        {
            $CI->db->where('uisc.month', $month);
        }
        if($year>0)
        {
            $CI->db->where('uisc.year', $year);
        }

        $CI->db->where('uisc.status !=', 1);
        $CI->db->join($CI->config->item('table_uisc_infos').' uisc_infos','uisc_infos.id = uisc.uisc_id', 'LEFT');
        $CI->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.user_id = uisc.id', 'LEFT');
        $uiscs=$this->db->get()->result_array();

        foreach($uiscs as &$uisc)
        {
            $uisc['edit_link']=$CI->get_encoded_url('approval/user_approval/index/edit/'.$uisc['id']);
            if($uisc['status']==1)
            {
                $uisc['status_text']=$CI->lang->line('APPROVED');
            }
            elseif($uisc['status']==0)
            {
                $uisc['status_text']=$CI->lang->line('NOT_APPROVED');
            }
            elseif($uisc['status']==2)
            {
                $uisc['status_text']=$CI->lang->line('PENDING');
            }
        }

        $CI->jsonReturn($uiscs);
    }

    public function fetch_uisc_detail_info($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->select('users.*');
        $CI->db->select('entrepreneurinfos.id entrepreneur_no,entrepreneurinfos.entrepreneur_type, entrepreneurinfos.entrepreneur_name, entrepreneurinfos.entrepreneur_father_name, entrepreneurinfos.entrepreneur_qualification, entrepreneurinfos.entrepreneur_mobile, entrepreneurinfos.entrepreneur_email, entrepreneurinfos.entrepreneur_sex, entrepreneurinfos.entrepreneur_address');
        $CI->db->select('secretaryinfos.secretary_name, secretaryinfos.secretary_email, secretaryinfos.secretary_mobile, secretaryinfos.secretary_address');
        $CI->db->select('deviceinfos.modem, deviceinfos.connection_type, deviceinfos.ip_address');
        $CI->db->select('divisions.divname');
        $CI->db->select('zillas.zillaname');
        $CI->db->select('upazillas.upazilaname');
        $CI->db->select('unions.unionname');
        $CI->db->select('cities.citycorporationname');
        $CI->db->select('municipals.municipalname');

        $CI->db->where('users.id', $id);

        $CI->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = users.division', 'LEFT');
        $CI->db->join($CI->config->item('table_zillas').' zillas','zillas.zillaid = users.zilla', 'LEFT');
        $CI->db->join($CI->config->item('table_upazilas').' upazillas','upazillas.upazilaid = users.upazila AND upazillas.zillaid = users.zilla', 'LEFT');

        $CI->db->join($CI->config->item('table_unions').' unions','unions.zillaid = users.zilla AND unions.upazilaid = users.upazila AND unions.unionid = users.unioun', 'LEFT');
        $CI->db->join($CI->config->item('table_city_corporations').' cities','cities.citycorporationid = users.citycorporation AND cities.zillaid = users.zilla', 'LEFT');
        $CI->db->join($CI->config->item('table_municipals').' municipals','municipals.municipalid = users.municipal AND municipals.upazilaid = users.municipal AND municipals.zillaid = users.zilla', 'LEFT');

        $CI->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneurinfos','entrepreneurinfos.uisc_id = users.uisc_id AND entrepreneurinfos.user_id = users.id', 'LEFT');
        $CI->db->join($CI->config->item('table_secretary_infos').' secretaryinfos','secretaryinfos.uisc_id = users.uisc_id AND secretaryinfos.user_id = users.id', 'LEFT');
        $CI->db->join($CI->config->item('table_device_infos').' deviceinfos','deviceinfos.uisc_id = users.uisc_id AND deviceinfos.user_id = users.id', 'LEFT');
        $result = $CI->db->get()->row_array();
        return $result;
    }

    public function fetch_uisc_equipments($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_uisc_resources').' uisc_resources');
        $CI->db->select('uisc_resources.*');
        $CI->db->select('resources.res_name');

        $CI->db->where('uisc_resources.user_id', $id);

        $CI->db->join($CI->config->item('table_resources').' resources','resources.res_id = uisc_resources.res_id', 'LEFT');

        $results = $CI->db->get()->result_array();
        return $results;
    }

    public function CountUnionServiceCenter($division_id, $zilla_id, $upzilla_id, $unioun_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as uisc_id');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('upazila', $upzilla_id);
        $CI->db->where('unioun', $unioun_id);
        $CI->db->group_by("division", "zilla", "upazila", "unioun");

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

    public function countCityServiceCenter($division_id, $zilla_id, $citycorporation_id, $city_corporation_ward_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as uisc_id');
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

    public function countMunicipalServiceCenter($division_id, $zilla_id, $municipal_id, $municipal_ward_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as uisc_id');
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

    public function get_uisc_id_for_user($id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('uisc_id');
        $CI->db->where('id', $id);
        $result = $CI->db->get()->row_array();
        return $result['uisc_id'];
    }

}