<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uisc_registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_uisc_registration_info($division, $zilla, $upazila, $union, $uisc_status)
    {
        $CI =& get_instance();
        $user=User_helper::get_user();
        $where = '';
        $where_total_uisc='';
        if (!empty($division))
        {
            //$where = $where . "where divisions.divid=" . $division;
            $this->db->where('divisions.divid',$division);
            //$where_total_uisc = $where_total_uisc." AND uisc_infos.division=divisions.divid";
            if (!empty($zilla))
            {
                //$where = $where . " AND zillas.zillaid=" . $zilla;
                $this->db->where('zillas.zillaid',$zilla);
                //$where_total_uisc =$where_total_uisc." AND uisc_infos.zilla=zillas.zillaid";
                if (!empty($upazila))
                {
                    //$where = $where . " AND upa_zilas.upazilaid=" . $upazila;
                    $this->db->where('upa_zilas.upazilaid',$upazila);
                    //$where_total_uisc =$where_total_uisc." AND uisc_infos.upazilla=upa_zilas.upazilaid";
                    if (!empty($union))
                    {
                        //$where = $where . " AND unions.unionid=" . $union;
                        //$where_total_uisc =$where_total_uisc." AND uisc_infos.`union`=unions.unionid";
                        $this->db->where('unions.unionid',$union);
                    }
                }
            }
        }
        if($uisc_status!="")
        {
            $where_uisc_status="uisc_infos.`status`=".$uisc_status;
        }
        else
        {
            $where_uisc_status="uisc_infos.`status`=".$this->config->item('STATUS_ACTIVE');
        }

        $this->db->select("divisions.divname,
                            zillas.zillaname,
                            upa_zilas.upazilaname,
                            unions.unionname,
                            divisions.divid,
                            zillas.zillaid,
                            upa_zilas.upazilaid,
                            unions.unionid,
                            (
                            SELECT COUNT(id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.upazilla=upa_zilas.upazilaid
                            AND uisc_infos.`union`=unions.unionid
                            ) total_uisc,
                            (
                            SELECT COUNT(user_info.id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            LEFT JOIN ".$CI->config->item('table_users')." user_info ON user_info.uisc_id=uisc_infos.id
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.upazilla=upa_zilas.upazilaid
                            AND uisc_infos.`union`=unions.unionid
                            AND user_info.gender=".$this->config->item('GENDER_MALE')."
                            ) total_male_user,
                            (
                            SELECT COUNT(user_info.id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            LEFT JOIN ".$CI->config->item('table_users')." user_info ON user_info.uisc_id=uisc_infos.id
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.upazilla=upa_zilas.upazilaid
                            AND uisc_infos.`union`=unions.unionid
                            AND user_info.gender=".$this->config->item('GENDER_FEMALE')."
                            ) total_female_user", false);
        $CI->db->from($CI->config->item('table_divisions').' divisions');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = divisions.divid', 'LEFT');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = zillas.zillaid', 'LEFT');
        $this->db->join($CI->config->item('table_unions').' unions','unions.zillaid = upa_zilas.zillaid AND unions.upazilaid = upa_zilas.upazilaid', 'LEFT');
        $this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, unions.unionid');
        $this->db->order_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, unions.unionid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_uisc_registration_municipal_info($division, $zilla, $municipal, $municipal_ward, $uisc_status)
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
        if($uisc_status!="")
        {
            $where_uisc_status="uisc_infos.`status`=".$uisc_status;
        }
        else
        {
            $where_uisc_status="uisc_infos.`status`=".$this->config->item('STATUS_ACTIVE');
        }

        $this->db->select("divisions.divname,
                            zillas.zillaname,
                            divisions.divid,
                            zillas.zillaid,
                            municipals.municipalid,
                            municipals.municipalname,
                            municipal_wards.wardname,
                            municipal_wards.wardid,
                            (
                            SELECT COUNT(id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.municipal=municipals.municipalid
                            AND uisc_infos.municipalward=municipal_wards.wardid
                            ) total_uisc,
                            (
                            SELECT COUNT(user_info.id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            LEFT JOIN ".$CI->config->item('table_users')." user_info ON user_info.uisc_id=uisc_infos.id
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.municipal=municipals.municipalid
                            AND uisc_infos.municipalward=municipal_wards.wardid
                            AND user_info.gender=".$this->config->item('GENDER_MALE')."
                            ) total_male_user,
                            (
                            SELECT COUNT(user_info.id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            LEFT JOIN ".$CI->config->item('table_users')." user_info ON user_info.uisc_id=uisc_infos.id
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.municipal=municipals.municipalid
                            AND uisc_infos.municipalward=municipal_wards.wardid
                            AND user_info.gender=".$this->config->item('GENDER_FEMALE')."
                            ) total_female_user", false);
        $CI->db->from($CI->config->item('table_divisions').' divisions');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = divisions.divid', 'LEFT');
        $this->db->join($CI->config->item('table_municipals').' municipals','municipals.zillaid = zillas.zillaid', 'LEFT');
        $this->db->join($CI->config->item('table_municipal_wards').' municipal_wards','municipal_wards.municipalid = municipals.municipalid', 'LEFT');
        $this->db->group_by('divisions.divid, zillas.zillaid, municipals.municipalid, municipal_wards.wardid');
        $this->db->order_by('divisions.divid, zillas.zillaid, municipals.municipalid, municipal_wards.wardid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_uisc_registration_city_corporation_info($division, $zilla, $city_corporation, $city_corporation_ward, $uisc_status)
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
        if($uisc_status!="")
        {
            $where_uisc_status="uisc_infos.`status`=".$uisc_status;
        }
        else
        {
            $where_uisc_status="uisc_infos.`status`=".$this->config->item('STATUS_ACTIVE');
        }

        $this->db->select("divisions.divname,
                            zillas.zillaname,
                            divisions.divid,
                            zillas.zillaid,
                            city_corporations.citycorporationid,
                            city_corporations.citycorporationname,
                            city_corporation_wards.citycorporationwardid,
                            city_corporation_wards.wardname,
                            (
                            SELECT COUNT(id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.citycorporation=city_corporations.citycorporationid
                            AND uisc_infos.citycorporationward=city_corporation_wards.citycorporationwardid
                            ) total_uisc,
                            (
                            SELECT COUNT(user_info.id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            LEFT JOIN ".$CI->config->item('table_users')." user_info ON user_info.uisc_id=uisc_infos.id
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.citycorporation=city_corporations.citycorporationid
                            AND uisc_infos.citycorporationward=city_corporation_wards.citycorporationwardid
                            AND user_info.gender=".$this->config->item('GENDER_MALE')."
                            ) total_male_user,
                            (
                            SELECT COUNT(user_info.id) FROM ".$CI->config->item('table_uisc_infos')." uisc_infos
                            LEFT JOIN ".$CI->config->item('table_users')." user_info ON user_info.uisc_id=uisc_infos.id
                            WHERE
                            $where_uisc_status
                            AND uisc_infos.division=divisions.divid
                            AND uisc_infos.zilla=zillas.zillaid
                            AND uisc_infos.citycorporation=city_corporations.citycorporationid
                            AND uisc_infos.citycorporationward=city_corporation_wards.citycorporationwardid
                            AND user_info.gender=".$this->config->item('GENDER_FEMALE')."
                            ) total_female_user", false);
        $CI->db->from($CI->config->item('table_divisions').' divisions');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = divisions.divid', 'LEFT');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations','city_corporations.zillaid = zillas.zillaid', 'LEFT');
        $this->db->join($CI->config->item('table_city_corporation_wards').' city_corporation_wards','city_corporation_wards.citycorporationid = city_corporations.citycorporationid', 'LEFT');
        $this->db->group_by('divisions.divid, zillas.zillaid, city_corporations.citycorporationid, city_corporation_wards.citycorporationwardid');
        $this->db->order_by('divisions.divid, zillas.zillaid, city_corporations.citycorporationid, city_corporation_wards.citycorporationwardid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_country_wise_union_monthly_income_info($month, $year)
    {
        $start_date = $year . "-" . $month . "-01";
        $end_date = $year . "-" . $month . "-31";
        $this->db->select("
                            divisions.divname,
                            zillas.zillaname,
                            upa_zilas.upazilaname,
                            unions.unionname,
                            divisions.divid,
                            zillas.zillaid,
                            upa_zilas.upazilaid,
                            unions.unionid,
                            (
                            SELECT SUM(invoices.total_income) FROM ".$this->config->item('table_invoice')." invoices WHERE
                            invoices.divid=divisions.divid
                            AND invoices.zillaid=zillas.zillaid
                            AND invoices.upazilaid=upa_zilas.upazilaid
                            AND invoices.unionid=unions.unionid
                            AND invoices.invoice_date between  '$start_date' AND '$end_date'
                            ) total_income
                            ");
        $this->db->from($this->config->item('table_divisions').' divisions');
        $this->db->join($this->config->item('table_zillas').' zillas','zillas.divid = divisions.divid', 'LEFT');
        $this->db->join($this->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = zillas.zillaid', 'LEFT');
        $this->db->join($this->config->item('table_unions').' unions','unions.zillaid = upa_zilas.zillaid AND unions.upazilaid = upa_zilas.upazilaid', 'LEFT');

        $this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, unions.unionid');
        $this->db->order_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, unions.unionid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_country_wise_municipal_monthly_income_info($month, $year)
    {
        $start_date = $year . "-" . $month . "-01";
        $end_date = $year . "-" . $month . "-31";
        $this->db->select("
                            invoices.invoice_date,
                            SUM(invoices.total_income) total_income,
                            uisc_infos.id,
                            uisc_infos.uisc_name,
                            divisions.divid,
                            divisions.divname,
                            zillas.zillaid,
                            zillas.zillaname,
                            municipals.municipalid,
                            municipals.municipalname,
                            municipal_wards.wardid,
                            municipal_wards.wardname
                            ");
        $this->db->from($this->config->item('table_invoices').' invoices');
        $this->db->join($this->config->item('table_uisc_infos').' uisc_infos','uisc_infos.id = invoices.uisc_id', 'LEFT');
        $this->db->join($this->config->item('table_divisions').' divisions','divisions.divid = invoices.divid', 'LEFT');
        $this->db->join($this->config->item('table_zillas').' zillas','zillas.divid = invoices.divid AND zillas.zillaid = invoices.zillaid', 'LEFT');
        $this->db->join($this->config->item('table_municipals').' municipals','municipals.zillaid = invoices.zillaid AND municipals.municipalid = invoices.municipalid', 'LEFT');
        $this->db->join($this->config->item('table_municipal_wards').' municipal_wards','municipal_wards.zillaid = municipals.zillaid AND municipal_wards.municipalid = municipals.municipalid', 'LEFT');
        $this->db->where('uisc_infos.uisc_type', $this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'));
        $this->db->where("invoices.invoice_date between  '$start_date' AND '$end_date'");
        $this->db->group_by('divisions.divid, zillas.zillaid, municipals.municipalid, municipal_wards.wardid, uisc_infos.id');
        $this->db->order_by('divisions.divid, zillas.zillaid, municipals.municipalid, municipal_wards.wardid, uisc_infos.id','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_country_wise_city_corporation_monthly_income_info($month, $year)
    {
        $start_date = $year . "-" . $month . "-01";
        $end_date = $year . "-" . $month . "-31";
        $this->db->select
        ("
            invoices.invoice_date,
            Sum(invoices.total_income) AS total_income,
            uisc_infos.id,
            uisc_infos.uisc_name,
            divisions.divid,
            divisions.divname,
            zillas.zillaid,
            zillas.zillaname,
            city_corporations.citycorporationid,
            city_corporations.citycorporationname,
            city_corporation_wards.citycorporationwardid,
            city_corporation_wards.wardname
        ");
        $this->db->from($this->config->item('table_invoices').' invoices');
        $this->db->join($this->config->item('table_uisc_infos').' uisc_infos','uisc_infos.id = invoices.uisc_id', 'LEFT');
        $this->db->join($this->config->item('table_divisions').' divisions','divisions.divid = invoices.divid', 'LEFT');
        $this->db->join($this->config->item('table_zillas').' zillas','zillas.divid = invoices.divid AND zillas.zillaid = invoices.zillaid', 'LEFT');
        $this->db->join($this->config->item('table_city_corporations').' city_corporations','city_corporations.zillaid = invoices.zillaid AND city_corporations.citycorporationid = invoices.citycorporationid', 'LEFT');
        $this->db->join($this->config->item('table_city_corporation_wards').' city_corporation_wards','city_corporation_wards.zillaid = uisc_infos.zilla AND city_corporation_wards.citycorporationid = uisc_infos.citycorporation AND city_corporation_wards.citycorporationwardid=uisc_infos.citycorporationward', 'LEFT');
        $this->db->where('uisc_infos.uisc_type', $this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'));
        $this->db->where("invoices.invoice_date between  '$start_date' AND '$end_date'");
        $this->db->group_by('divisions.divid, zillas.zillaid, city_corporations.citycorporationid, city_corporation_wards.citycorporationwardid, uisc_infos.id');
        $this->db->order_by('divisions.divid, zillas.zillaid, city_corporations.citycorporationid, city_corporation_wards.citycorporationwardid, uisc_infos.id','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_uisc_registration_union_user_info($division, $zilla, $upazila, $union)
    {
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
        $this->db->select('uisc_infos.uisc_name,
                            core_01_users.picture_name,
                            uisc_infos.`status`,
                            core_01_users.`status`,
                            entrepreneur_infos.entrepreneur_type,
                            entrepreneur_infos.entrepreneur_name,
                            entrepreneur_infos.entrepreneur_mobile,
                            entrepreneur_infos.entrepreneur_sex,
                            divisions.divname,
                            zillas.zillaname,
                            upa_zilas.upazilaname,
                            unions.unionname,
                            divisions.divid,
                            zillas.zillaid,
                            unions.upazilaid,
                            upa_zilas.upazilaid');
        $this->db->from($this->config->item('table_uisc_infos')." uisc_infos");
        $this->db->join($this->config->item('table_divisions').' divisions','divisions.divid = uisc_infos.division', 'LEFT');
        $this->db->join($this->config->item('table_zillas').' zillas','zillas.zillaid = uisc_infos.zilla AND zillas.divid = uisc_infos.division', 'LEFT');
        $this->db->join($this->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = uisc_infos.zilla AND upa_zilas.upazilaid = uisc_infos.upazilla', 'LEFT');
        $this->db->join($this->config->item('table_unions').' unions','unions.zillaid = uisc_infos.zilla AND unions.upazilaid = uisc_infos.upazilla AND unions.unionid = uisc_infos.union', 'LEFT');
        $this->db->join($this->config->item('table_users').' core_01_users','core_01_users.uisc_id = uisc_infos.id', 'LEFT');
        $this->db->join($this->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.user_id = core_01_users.id AND entrepreneur_infos.uisc_id = core_01_users.uisc_id', 'LEFT');
        $this->db->where('core_01_users.uisc_type',$this->config->item('ONLINE_UNION_GROUP_ID'));
        $this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, unions.unionid');
        $this->db->order_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, unions.unionid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_uisc_registration_municipal_user_info($division, $zilla, $municipal, $municipal_ward)
    {
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
        $this->db->select
        ('
        entrepreneur_infos.entrepreneur_name,
        entrepreneur_infos.entrepreneur_mobile,
        entrepreneur_infos.entrepreneur_type,
        core_01_users.`status`,
        core_01_users.picture_name,
        divisions.divid,
        divisions.divname,
        zillas.zillaid,
        zillas.zillaname,
        municipals.municipalid,
        municipals.municipalname,
        municipal_wards.wardid,
        municipal_wards.wardname
        ');
        $this->db->from($this->config->item('table_users')." core_01_users");
        $this->db->join($this->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.user_id = core_01_users.id', 'LEFT');
        $this->db->join($this->config->item('table_divisions').' divisions','divisions.divid = core_01_users.division', 'LEFT');
        $this->db->join($this->config->item('table_zillas').' zillas','zillas.divid = core_01_users.division AND zillas.zillaid = core_01_users.zilla', 'LEFT');
        $this->db->join($this->config->item('table_municipals').' municipals','municipals.zillaid = core_01_users.zilla AND municipals.municipalid = core_01_users.municipal', 'LEFT');
        $this->db->join($this->config->item('table_municipal_wards').' municipal_wards','municipal_wards.zillaid = core_01_users.zilla AND municipal_wards.municipalid = core_01_users.municipal AND municipal_wards.wardid = core_01_users.municipalward', 'LEFT');
        $this->db->where('core_01_users.uisc_type',$this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'));
        $this->db->group_by('divisions.divid, zillas.zillaid, municipals.municipalid, municipal_wards.wardid');
        $this->db->order_by('divisions.divid, zillas.zillaid, municipals.municipalid, municipal_wards.wardid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_uisc_registration_city_corporation_user_info($division, $zilla, $city_corporation, $city_corporation_ward)
    {
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
        $this->db->select
        ('
        entrepreneur_infos.entrepreneur_name,
        entrepreneur_infos.entrepreneur_mobile,
        entrepreneur_infos.entrepreneur_type,
        core_01_users.`status`,
        core_01_users.picture_name,
        divisions.divname,
        zillas.zillaname,
        divisions.divid,
        zillas.zillaid,
        city_corporations.citycorporationid,
        city_corporations.citycorporationname,
        city_corporation_wards.citycorporationwardid,
        city_corporation_wards.wardname
        ');

        $this->db->from($this->config->item('table_users')." core_01_users");
        $this->db->join($this->config->item('table_entrepreneur_infos').' entrepreneur_infos','entrepreneur_infos.user_id = core_01_users.id', 'LEFT');
        $this->db->join($this->config->item('table_divisions').' divisions','divisions.divid = core_01_users.division', 'LEFT');
        $this->db->join($this->config->item('table_zillas').' zillas','zillas.divid = core_01_users.division AND zillas.zillaid = core_01_users.zilla', 'LEFT');
        $this->db->join($this->config->item('table_city_corporations').' city_corporations','city_corporations.zillaid = core_01_users.zilla AND city_corporations.citycorporationid = core_01_users.citycorporation', 'LEFT');
        $this->db->join($this->config->item('table_city_corporation_wards').' city_corporation_wards','city_corporation_wards.zillaid = core_01_users.zilla AND city_corporation_wards.citycorporationwardid = core_01_users.citycorporationward', 'LEFT');

        $this->db->where('core_01_users.uisc_type',$this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'));
        $this->db->group_by('divisions.divid, zillas.zillaid, city_corporations.citycorporationid, city_corporation_wards.citycorporationwardid');
        $this->db->order_by('divisions.divid, zillas.zillaid, city_corporations.citycorporationid, city_corporation_wards.citycorporationwardid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }
}