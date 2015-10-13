<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media_corner_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_profile_info($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_uisc_infos').' uiscinfos');
        $CI->db->select('uiscinfos.*');
        $CI->db->select('entrepreneurinfos.id entrepreneur_no,entrepreneurinfos.entrepreneur_type, entrepreneurinfos.entrepreneur_name, entrepreneurinfos.entrepreneur_father_name, entrepreneurinfos.entrepreneur_qualification, entrepreneurinfos.entrepreneur_mobile, entrepreneurinfos.entrepreneur_email, entrepreneurinfos.entrepreneur_sex, entrepreneurinfos.entrepreneur_address');
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

    public function get_uisc_info($id, $uisc_id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_uisc_infos').' uiscinfos');
        $CI->db->where('uiscinfos.id', $uisc_id);
        $result = $CI->db->get()->row_array();
        return $result;
    }

}