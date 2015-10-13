<?php
class Website_helper
{
    public static function get_total_uiscs()
    {
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_uisc_infos').' uisc');
        //        $CI->db->select('uisc.*');
        //        $CI->db->where('uisc.status !=',99);
        //        $result = $CI->db->count_all_results();
        //
        //        if($result)
        //        {
        //            return $result;
        //        }
        //        else
        //        {
        //            return 0;
        //        }
        return 0;
    }

    public static function get_total_entrepreneurs()
    {
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_entrepreneur_infos').' entrepreneur');
        //        $CI->db->select('entrepreneur.*');
        //        $CI->db->where('entrepreneur.status !=',99);
        //        $result = $CI->db->count_all_results();
        //
        //        if($result)
        //        {
        //            return $result;
        //        }
        //        else
        //        {
        //            return 0;
        //        }
        return 0;
    }

    public static function get_total_income_today()
    {
        //        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_invoices').' invoices');
        //        $CI->db->select('SUM(invoices.total_income) total_income');
        //        $CI->db->where('invoices.invoice_date',$yesterday);
        //        $result = $CI->db->get()->row_array();
        //
        //        if($result['total_income'])
        //        {
        //            return $result['total_income'];
        //        }
        //        else
        //        {
        //            return 0;
        //        }
        return 0;
    }

    public static function get_total_services()
    {
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_services').' services');
        //        $CI->db->select('services.*');
        //        $CI->db->where('services.status', 1);
        //        $result = $CI->db->count_all_results();
        //
        //        if($result)
        //        {
        //            return $result;
        //        }
        //        else
        //        {
        //            return 0;
        //        }
        return 0;
    }

    public static function get_total_investment()
    {
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_investment').' investment');
        //        $CI->db->select('SUM(investment.invested_money) total_invest');
        //        $result = $CI->db->get()->row_array();
        //
        //        if($result['total_invest'])
        //        {
        //            return $result['total_invest'];
        //        }
        //        else
        //        {
        //            return 0;
        //        }
        return 0;
    }

    public static function get_all_public_notices()
    {
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_notice').' notice');
        //        $CI->db->select('notice.*');
        //        $CI->db->where('notice.public_status', 1);
        //        $CI->db->limit(5);
        //        $results = $CI->db->get()->result_array();
        //        return $results;
        return 0;
    }

    public static function get_service_income_detail($invoice_id)
    {
        //        $user = User_helper::get_user();
        //        $CI = & get_instance();
        //        $CI->db->from($CI->config->item('table_invoice_details').' invoice_details');
        //        $CI->db->select('invoice_details.*');
        //        $CI->db->select('services.service_name uisc_service_name');
        //        $CI->db->where('invoice_details.invoice_id', $invoice_id);
        //
        //        $CI->db->join($CI->config->item('table_services').' services','services.service_id = invoice_details.service_id', 'LEFT');
        //        $results = $CI->db->get()->result_array();
        //        return $results;
        return 0;
    }
}