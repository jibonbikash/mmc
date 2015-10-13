<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entrepreneur_approval_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_approval_uisc_detail($entrepreneur_type, $division, $zilla, $upazilla, $municipal, $municipalward, $citycorporation, $citycorporationward, $union, $year, $month, $date, $status)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_uisc_infos').' uisc');
        $CI->db->select('uisc.*');

        if($status!="")
        {
            $CI->db->where('uisc.status', $status);
        }
        if($entrepreneur_type>0)
        {
            $CI->db->where('uisc.uisc_type', $entrepreneur_type);
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

        //$CI->db->where('uisc.status !=', 1);

        $uiscs=$this->db->get()->result_array();

        foreach($uiscs as &$uisc)
        {
            $uisc['edit_link']=$CI->get_encoded_url('approval/entrepreneur_approval/index/edit/'.$uisc['id']);
            if($uisc['status']==1)
            {
                $uisc['status_text']=$CI->lang->line('APPROVED');
            }
            elseif($uisc['status']==0)
            {
                $uisc['status_text']=$CI->lang->line('PENDING');
            }
            elseif($uisc['status']==2)
            {
                $uisc['status_text']=$CI->lang->line('NOT_APPROVED');
            }
        }

        $CI->jsonReturn($uiscs);
    }

    public function fetch_uisc_detail_info($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_uisc_infos').' uiscinfos');
        $CI->db->select('uiscinfos.*');
        $CI->db->select('entrepreneurinfos.id entrepreneur_no,entrepreneurinfos.entrepreneur_type, entrepreneurinfos.entrepreneur_name, entrepreneurinfos.entrepreneur_father_name,entrepreneurinfos.entrepreneur_mother_name, entrepreneurinfos.entrepreneur_qualification, entrepreneurinfos.entrepreneur_mobile, entrepreneurinfos.entrepreneur_email, entrepreneurinfos.entrepreneur_sex, entrepreneurinfos.entrepreneur_address');
        $CI->db->select('secretaryinfos.secretary_name, secretaryinfos.secretary_email, secretaryinfos.secretary_mobile, secretaryinfos.secretary_address');
        $CI->db->select('deviceinfos.modem, deviceinfos.connection_type, deviceinfos.ip_address');
        $CI->db->select('divisions.divname');
        $CI->db->select('zillas.zillaname');
        $CI->db->select('upazillas.upazilaname');
        $CI->db->select('unions.unionname');
        $CI->db->select('cities.citycorporationname');
        $CI->db->select('city_word.wardname  city_corporation_word_name');
        $CI->db->select('municipals.municipalname');
        $CI->db->select('municipal_word.wardname municipal_word_name');

        $CI->db->where('uiscinfos.id', $id);

        $CI->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = uiscinfos.division', 'LEFT');
        $CI->db->join($CI->config->item('table_zillas').' zillas','zillas.zillaid = uiscinfos.zilla', 'LEFT');
        $CI->db->join($CI->config->item('table_upazilas').' upazillas','upazillas.upazilaid = uiscinfos.upazilla AND upazillas.zillaid = uiscinfos.zilla', 'LEFT');

        $CI->db->join($CI->config->item('table_unions').' unions','unions.zillaid = uiscinfos.zilla AND unions.upazilaid = uiscinfos.upazilla AND unions.unionid = uiscinfos.union', 'LEFT');
        $CI->db->join($CI->config->item('table_city_corporations').' cities','cities.citycorporationid = uiscinfos.citycorporation AND cities.zillaid = uiscinfos.zilla', 'LEFT');
        $CI->db->join($CI->config->item('table_city_corporation_wards').' city_word','city_word.zillaid = uiscinfos.zilla AND city_word.citycorporationid = uiscinfos.citycorporation AND city_word.citycorporationwardid = uiscinfos.citycorporationward', 'LEFT');
        $CI->db->join($CI->config->item('table_municipals').' municipals','municipals.municipalid = uiscinfos.municipal AND municipals.upazilaid = uiscinfos.municipal AND municipals.zillaid = uiscinfos.zilla', 'LEFT');
        $CI->db->join($CI->config->item('table_municipal_wards').' municipal_word','municipal_word.zillaid = uiscinfos.zilla AND municipal_word.municipalid = uiscinfos.municipal AND municipal_word.wardid = uiscinfos.municipalward', 'LEFT');

        $CI->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneurinfos','entrepreneurinfos.uisc_id = uiscinfos.id', 'LEFT');
        $CI->db->join($CI->config->item('table_secretary_infos').' secretaryinfos','secretaryinfos.uisc_id = uiscinfos.id', 'LEFT');
        $CI->db->join($CI->config->item('table_device_infos').' deviceinfos','deviceinfos.uisc_id = uiscinfos.id', 'LEFT');
        $result = $CI->db->get()->row_array();
        //echo $CI->db->last_query();
        return $result;
    }

    public function fetch_uisc_equipments($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_uisc_resources').' uisc_resources');
        $CI->db->select('uisc_resources.*');
        $CI->db->select('resources.res_name');

        $CI->db->where('uisc_resources.uisc_id', $id);

        $CI->db->join($CI->config->item('table_resources').' resources','resources.res_id = uisc_resources.res_id', 'LEFT');

        $results = $CI->db->get()->result_array();
        return $results;
    }

    public function CountUnionServiceCenter($division_id, $zilla_id, $upzilla_id, $unioun_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos'));
        $CI->db->select('count(id)');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('upazilla', $upzilla_id);
        $CI->db->where('union', $unioun_id);
        $CI->db->where('status', 1);
        $CI->db->group_by("division", "zilla", "upazilla", "union");

        $count = $CI->db->count_all_results();

        //echo $this->db->last_query();

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
        $CI->db->from($CI->config->item('table_uisc_infos'));
        $CI->db->select('count(id) as uisc_id');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('citycorporation', $citycorporation_id);
        $CI->db->where('citycorporationward', $city_corporation_ward_id);
        $CI->db->where('status', 1);
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
        $CI->db->from($CI->config->item('table_uisc_infos'));
        $CI->db->select('count(id) as uisc_id');
        $CI->db->where('division', $division_id);
        $CI->db->where('zilla', $zilla_id);
        $CI->db->where('municipal', $municipal_id);
        $CI->db->where('municipalward', $municipal_ward_id);
        $CI->db->where('status', 1);
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

    //////// NUMBER OF UISC USER MODIFY MARAJ
    public function Number_of_uisc_user($uisc_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_users'));
        $CI->db->select('count(id) as uisc_id');
        $CI->db->where('uisc_id', $uisc_id);

        $count = $CI->db->count_all_results();

        if($count > 0)
        {
            $total_uisc_user = $count + 1;
        }
        else
        {
            $total_uisc_user = "01";
        }
        return $total_uisc_user;
    }

    public static function check_division($division_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_divisions'));
        $CI->db->where('divid', $division_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_zilla($division_id, $zilla_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_zillas'));
        $CI->db->where('divid', $division_id);
        $CI->db->where('zillaid', $zilla_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_upazilla($zilla_id, $upazilla_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_upazilas'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('upazilaid', $upazilla_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_union($zilla_id, $upazilla_id, $union_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_unions'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('upazilaid', $upazilla_id);
        $CI->db->where('unionid', $union_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_city_corporation($zilla_id, $city_corporation_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_city_corporations'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('citycorporationid', $city_corporation_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_city_corporation_word($zilla_id, $city_corporation_id, $city_corporation_word_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_city_corporation_wards'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('citycorporationid', $city_corporation_id);
        $CI->db->where('citycorporationwardid', $city_corporation_word_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_municipal($zilla_id, $municipal_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_municipals'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('municipalid', $municipal_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_municipal_word($zilla_id, $municipal_id, $municipal_word_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_municipal_wards'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('municipalid', $municipal_id);
        $CI->db->where('wardid', $municipal_word_id);
        $results = $CI->db->get()->result_array();
        if(!$results)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function get_user_detail_info_from_entrepreneur($uisc_user_id, $id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_entrepreneur_infos').' entrepreneur');
        $CI->db->where('entrepreneur.uisc_id', $id);
        $CI->db->where('entrepreneur.user_id', $uisc_user_id);
        $result = $CI->db->get()->row_array();
        return $result;
    }

}