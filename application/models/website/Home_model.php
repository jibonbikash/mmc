<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function  get_top_service_yesterday()
    {
        $CI =& get_instance();
        $end_date = date('Y-m-d', time());
        $newdate = strtotime('-1 day', strtotime($end_date));
        $srt_date = date('Y-m-d', $newdate);

        $this->db->select('invoices.total_service');
        $this->db->select('unions.unionname');
        $this->db->select('upa_zilas.upazilaname');
        $this->db->select('municipals.municipalname');

        $this->db->select('zillas.zillaname');
        $this->db->select('city_corporations.citycorporationname');
        $this->db->from($CI->config->item('table_invoices')." invoices");

        $this->db->join($CI->config->item('table_unions').' unions', 'unions.zillaid = invoices.zillaid AND unions.upazilaid = invoices.upazilaid AND unions.unionid = invoices.unionid', 'left');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas', 'upa_zilas.upazilaid = invoices.upazilaid AND upa_zilas.zillaid = invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_municipals').' municipals', 'municipals.municipalid =invoices.municipalid', 'left');
        $this->db->join($CI->config->item('table_zillas').' zillas', 'zillas.zillaid =invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations', 'city_corporations.citycorporationid =invoices.citycorporationid', 'left');
        $this->db->where('invoice_date', $srt_date);
        $this->db->order_by('invoices.total_service', 'desc');

        //$this->db->limit('3','0');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_top_income_yesterday()
    {
        $CI =& get_instance();
        $end_date = date('Y-m-d', time());
        $newdate = strtotime('-1 day', strtotime($end_date));
        $srt_date = date('Y-m-d', $newdate);

        $this->db->select('invoices.total_income');
        $this->db->select('unions.unionname');
        $this->db->select('upa_zilas.upazilaname');
        $this->db->select('municipals.municipalname');
        $this->db->select('zillas.zillaname');
        $this->db->select('city_corporations.citycorporationname');
        $this->db->from($CI->config->item('table_invoices')." invoices");

        $this->db->join($CI->config->item('table_unions').' unions', 'unions.zillaid = invoices.zillaid AND unions.upazilaid = invoices.upazilaid AND unions.unionid = invoices.unionid', 'left');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas', 'upa_zilas.upazilaid = invoices.upazilaid AND upa_zilas.zillaid = invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_municipals').' municipals', 'municipals.municipalid =invoices.municipalid', 'left');
        $this->db->join($CI->config->item('table_zillas').' zillas', 'zillas.zillaid =invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations', 'city_corporations.citycorporationid =invoices.citycorporationid', 'left');
        $this->db->where('invoice_date', $srt_date);
        $this->db->order_by('invoices.total_income', 'desc');

        //$this->db->limit('20','0');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_top_service_last_seven_days()
    {
        $CI =& get_instance();
        $end_date = date('Y-m-d', time());

        $newdate_0 = strtotime('0 day', strtotime($end_date));
        $newdate6 = strtotime('-6 day', strtotime($end_date));

        $srt_date_0 = date('Y-m-d', $newdate_0);
        $srt_date6 = date('Y-m-d', $newdate6);

        $this->db->select('invoices.total_service,
			unions.unionname,
			upa_zilas.upazilaname,
			municipals.municipalname,
			zillas.zillaname,
			city_corporations.citycorporationname');
        $this->db->from($CI->config->item('table_invoices')." invoices");
        $this->db->join($CI->config->item('table_unions').' unions', 'unions.zillaid = invoices.zillaid AND unions.upazilaid = invoices.upazilaid AND unions.unionid = invoices.unionid', 'left');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas', 'upa_zilas.upazilaid = invoices.upazilaid AND upa_zilas.zillaid = invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_municipals').' municipals', 'municipals.municipalid =invoices.municipalid', 'left');
        $this->db->join($CI->config->item('table_zillas').' zillas', 'zillas.zillaid =invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations', 'city_corporations.citycorporationid =invoices.citycorporationid', 'left');
        $this->db->where("invoice_date BETWEEN '$srt_date6' and '$srt_date_0'");
        $this->db->order_by('invoices.total_service', 'desc');

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_top_income_last_seven_days()
    {
        $CI =& get_instance();
        $end_date = date('Y-m-d', time());

        $newdate_0 = strtotime('0 day', strtotime($end_date));
        $newdate6 = strtotime('-6 day', strtotime($end_date));

        $srt_date_0 = date('Y-m-d', $newdate_0);
        $srt_date6 = date('Y-m-d', $newdate6);

        $this->db->select('invoices.total_income,
			unions.unionname,
			upa_zilas.upazilaname,
			municipals.municipalname,
			zillas.zillaname,
			city_corporations.citycorporationname');
        $this->db->from($CI->config->item('table_invoices')." invoices");
        $this->db->join($CI->config->item('table_unions').' unions', 'unions.zillaid = invoices.zillaid AND unions.upazilaid = invoices.upazilaid AND unions.unionid = invoices.unionid', 'left');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas', 'upa_zilas.upazilaid = invoices.upazilaid AND upa_zilas.zillaid = invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_municipals').' municipals', 'municipals.municipalid =invoices.municipalid', 'left');
        $this->db->join($CI->config->item('table_zillas').' zillas', 'zillas.zillaid =invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations', 'city_corporations.citycorporationid =invoices.citycorporationid', 'left');
        $this->db->where("invoice_date BETWEEN '$srt_date6' and '$srt_date_0'");
        $this->db->order_by('invoices.total_income', 'desc');

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_top_service_last_month()
    {
        $CI =& get_instance();
        $srt_date = date('Y-m-d', strtotime('first day of last month'));
        $srt_date_month = date('Y-m', strtotime('first day of last month'));
        $end_date = $srt_date_month . '-' . '31';

        $this->db->select('invoices.total_service,
			unions.unionname,
			upa_zilas.upazilaname,
			municipals.municipalname,
			zillas.zillaname,
			city_corporations.citycorporationname');

        $this->db->from($CI->config->item('table_invoices')." invoices");
        $this->db->join($CI->config->item('table_unions').' unions', 'unions.zillaid = invoices.zillaid AND unions.upazilaid = invoices.upazilaid AND unions.unionid = invoices.unionid', 'left');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas', 'upa_zilas.upazilaid = invoices.upazilaid AND upa_zilas.zillaid = invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_municipals').' municipals', 'municipals.municipalid =invoices.municipalid', 'left');
        $this->db->join($CI->config->item('table_zillas').' zillas', 'zillas.zillaid =invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations', 'city_corporations.citycorporationid =invoices.citycorporationid', 'left');
        $this->db->where("invoice_date BETWEEN '$srt_date' and '$end_date'");
        $this->db->order_by('invoices.total_income', 'desc');

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }


    public function get_top_income_last_month()
    {
        $CI =& get_instance();
        $srt_date = date('Y-m-d', strtotime('first day of last month'));
        $srt_date_month = date('Y-m', strtotime('first day of last month'));
        $end_date = $srt_date_month . '-' . '31';

        $this->db->select('invoices.total_income,
			unions.unionname,
			upa_zilas.upazilaname,
			municipals.municipalname,
			zillas.zillaname,
			city_corporations.citycorporationname');

        $this->db->from($CI->config->item('table_invoices')." invoices");
        $this->db->join($CI->config->item('table_unions').' unions', 'unions.zillaid = invoices.zillaid AND unions.upazilaid = invoices.upazilaid AND unions.unionid = invoices.unionid', 'left');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas', 'upa_zilas.upazilaid = invoices.upazilaid AND upa_zilas.zillaid = invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_municipals').' municipals', 'municipals.municipalid =invoices.municipalid', 'left');
        $this->db->join($CI->config->item('table_zillas').' zillas', 'zillas.zillaid =invoices.zillaid', 'left');
        $this->db->join($CI->config->item('table_city_corporations').' city_corporations', 'city_corporations.citycorporationid =invoices.citycorporationid', 'left');
        $this->db->where("invoice_date BETWEEN '$srt_date' and '$end_date'");
        $this->db->order_by('invoices.total_income', 'desc');

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }



}