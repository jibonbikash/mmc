<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invested_money_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_invested_money_union_info($division, $zilla, $upazila, $union)
    {
        $CI =& get_instance();
        if (!empty($division))
        {
            $this->db->where('divisions.divid',$division);
            if (!empty($zilla))
            {
                $this->db->where('zillas.zillaid',$zilla);
                if (!empty($upazila))
                {
                    $this->db->where('upa_zilas.upazilaid',$upazila);
                    if (!empty($union))
                    {
                        $this->db->where('unions.unionid',$union);
                    }
                }
            }
        }

        $this->db->select("
                            core_01_users.uisc_type,
                            uisc_infos.uisc_name,
                            entrepreneur_infos.entrepreneur_name,
                            entrepreneur_investment_info.invested_money,
                            entrepreneur_investment_info.self_investment,
                            entrepreneur_investment_info.invest_debt,
                            entrepreneur_investment_info.invest_sector,
                            divisions.divid,
                            divisions.divname,
                            zillas.zillaid,
                            zillas.zillaname,
                            upa_zilas.upazilaid,
                            upa_zilas.upazilaname,
                            unions.unionid,
                            unions.unionname
                            ", false);
        $CI->db->from($CI->config->item('table_users').' core_01_users');
        $this->db->join($CI->config->item('table_uisc_infos').' uisc_infos','uisc_infos.id = core_01_users.uisc_id', 'LEFT');
        $this->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.uisc_id = core_01_users.uisc_id AND entrepreneur_infos.user_id = core_01_users.id', 'LEFT');
        $this->db->join($CI->config->item('table_investment').' entrepreneur_investment_info','entrepreneur_investment_info.uisc_id = core_01_users.uisc_id AND entrepreneur_investment_info.user_id = core_01_users.id', 'LEFT');
        $this->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = core_01_users.division', 'LEFT');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = core_01_users.division AND zillas.zillaid = core_01_users.zilla', 'LEFT');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = core_01_users.zilla AND upa_zilas.upazilaid = core_01_users.upazila', 'LEFT');
        $this->db->join($CI->config->item('table_unions').' unions','unions.zillaid = core_01_users.zilla AND unions.upazilaid = core_01_users.upazila AND unions.unionid = core_01_users.unioun', 'LEFT');
        $this->db->where('core_01_users.`status`',$this->config->item('STATUS_ACTIVE'));
        $this->db->where('core_01_users.uisc_type',$this->config->item('ONLINE_UNION_GROUP_ID'));
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_invested_money_municipal_info($division, $zilla, $municipal, $municipal_ward)
    {
        $CI =& get_instance();
        if (!empty($division))
        {
            $this->db->where('divisions.divid',$division);
            if (!empty($zilla))
            {
                $this->db->where('zillas.zillaid',$zilla);
                if (!empty($municipal))
                {
                    $this->db->where('municipals.municipalid',$municipal);
                    if (!empty($municipal_ward))
                    {
                        $this->db->where('municipal_wards.wardid',$municipal_ward);
                    }
                }
            }
        }

        $this->db->select("
                            core_01_users.uisc_type,
                            uisc_infos.uisc_name,
                            entrepreneur_infos.entrepreneur_name,
                            entrepreneur_investment_info.invested_money,
                            entrepreneur_investment_info.self_investment,
                            entrepreneur_investment_info.invest_debt,
                            entrepreneur_investment_info.invest_sector,
                            divisions.divid,
                            divisions.divname,
                            zillas.zillaid,
                            zillas.zillaname,
                            municipals.municipalid,
                            municipals.municipalname,
                            municipal_wards.wardid,
                            municipal_wards.wardname
                            ", false);
        $CI->db->from($CI->config->item('table_users').' core_01_users');
        $this->db->join($CI->config->item('table_uisc_infos').' uisc_infos','uisc_infos.id = core_01_users.uisc_id', 'LEFT');
        $this->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.uisc_id = core_01_users.uisc_id AND entrepreneur_infos.user_id = core_01_users.id', 'LEFT');
        $this->db->join($CI->config->item('table_investment').' entrepreneur_investment_info','entrepreneur_investment_info.uisc_id = core_01_users.uisc_id AND entrepreneur_investment_info.user_id = core_01_users.id', 'LEFT');
        $this->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = core_01_users.division', 'LEFT');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = core_01_users.division AND zillas.zillaid = core_01_users.zilla', 'LEFT');
        $this->db->join($CI->config->item('table_municipals').' municipals','municipals.zillaid = core_01_users.zilla AND municipals.municipalid = core_01_users.municipal', 'LEFT');
        $this->db->join($CI->config->item('table_municipal_wards').' municipal_wards','municipal_wards.zillaid = core_01_users.zilla AND municipal_wards.municipalid = core_01_users.municipal AND municipal_wards.wardid = core_01_users.municipalward', 'LEFT');
        $this->db->where('core_01_users.`status`',$this->config->item('STATUS_ACTIVE'));
        $this->db->where('core_01_users.uisc_type',$this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'));
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_invested_money_city_corporation_info($division, $zilla, $city_corporation, $city_corporation_ward)
    {
        $CI =& get_instance();
        if (!empty($division))
        {
            $this->db->where('divisions.divid',$division);
            if (!empty($zilla))
            {
                $this->db->where('zillas.zillaid',$zilla);
                if (!empty($city_corporation))
                {
                    $this->db->where('city_corporations.citycorporationid',$city_corporation);
                    if (!empty($city_corporation_ward))
                    {
                        $this->db->where('city_corporation_wards.citycorporationwardid',$city_corporation_ward);
                    }
                }
            }
        }

        $this->db->select("
                            core_01_users.uisc_type,
                            uisc_infos.uisc_name,
                            entrepreneur_infos.entrepreneur_name,
                            entrepreneur_investment_info.invested_money,
                            entrepreneur_investment_info.self_investment,
                            entrepreneur_investment_info.invest_debt,
                            entrepreneur_investment_info.invest_sector,
                            divisions.divid,
                            divisions.divname,
                            zillas.zillaid,
                            zillas.zillaname,
                            city_corporations.citycorporationid,
                            city_corporations.citycorporationname,
                            city_corporation_wards.citycorporationwardid,
                            city_corporation_wards.wardname
                            ", false);
        $CI->db->from($CI->config->item('table_users').' core_01_users');
        $this->db->join($CI->config->item('table_uisc_infos').' uisc_infos','uisc_infos.id = core_01_users.uisc_id', 'LEFT');
        $this->db->join($CI->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.uisc_id = core_01_users.uisc_id AND entrepreneur_infos.user_id = core_01_users.id', 'LEFT');
        $this->db->join($CI->config->item('table_investment').' entrepreneur_investment_info','entrepreneur_investment_info.uisc_id = core_01_users.uisc_id AND entrepreneur_investment_info.user_id = core_01_users.id', 'LEFT');
        $this->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = core_01_users.division', 'LEFT');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = core_01_users.division AND zillas.zillaid = core_01_users.zilla', 'LEFT');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations','city_corporations.zillaid = core_01_users.zilla AND city_corporations.citycorporationid = core_01_users.citycorporation', 'LEFT');
        $this->db->join($CI->config->item('table_city_corporation_wards').' city_corporation_wards','city_corporation_wards.zillaid = core_01_users.zilla AND city_corporation_wards.citycorporationid = core_01_users.citycorporation AND city_corporation_wards.citycorporationwardid = core_01_users.citycorporationward', 'LEFT');
        $this->db->where('core_01_users.`status`',$this->config->item('STATUS_ACTIVE'));
        $this->db->where('core_01_users.uisc_type',$this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'));
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }


}