<?php
class Dashboard_helper
{
    // Center Count
    public static function get_center_count_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->where('uisc_infos.status', 1);
        $total=$CI->db->count_all_results();
        return $total;
    }
    public static function get_center_count_division($division_id)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->where('uisc_infos.status', 1);
        $CI->db->where('uisc_infos.division', $division_id);
        $total=$CI->db->count_all_results();
        return $total;
    }
    public static function get_center_count_zilla($zilla_id)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->where('uisc_infos.status', 1);
        $CI->db->where('uisc_infos.zilla', $zilla_id);
        $total=$CI->db->count_all_results();
        return $total;
    }
    public static function get_center_count_upazila($zilla_id,$upazilla_id)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->where('uisc_infos.status', 1);
        $CI->db->where('uisc_infos.zilla', $zilla_id);
        $CI->db->where('uisc_infos.upazilla', $upazilla_id);
        $total=$CI->db->count_all_results();
        return $total;
    }

    // User Count
    public static function get_uisc_user_count_all($gender=0)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.status', 1);
        $CI->db->where('users.user_group_id', $CI->config->item('UISC_GROUP_ID'));
        if($gender)
        {
            $CI->db->where('users.gender', $gender);
        }
        $total=$CI->db->count_all_results();
        return $total;
    }
    public static function get_uisc_user_count_division($division_id,$gender=0)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.status', 1);
        $CI->db->where('users.user_group_id', $CI->config->item('DIVISION_GROUP_ID'));
        if($gender)
        {
            $CI->db->where('users.gender', $gender);
        }
        $CI->db->where('users.division', $division_id);
        $total=$CI->db->count_all_results();
        return $total;
    }
    public static function get_uisc_user_count_zilla($zilla,$gender=0)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.status', 1);
        $CI->db->where('users.user_group_id', $CI->config->item('DISTRICT_GROUP_ID'));
        if($gender)
        {
            $CI->db->where('users.gender', $gender);
        }
        $CI->db->where('users.zilla', $zilla);
        $total=$CI->db->count_all_results();
        return $total;
    }
    public static function get_uisc_user_count_upazila($zilla,$upazila,$gender=0)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.status', 1);
        $CI->db->where('users.user_group_id', $CI->config->item('UPAZILLA_GROUP_ID'));
        if($gender)
        {
            $CI->db->where('users.gender', $gender);
        }
        $CI->db->where('users.upazila', $upazila);
        $CI->db->where('users.zilla', $zilla);
        $total=$CI->db->count_all_results();
        return $total;
    }
    // Service Count
    public static function get_total_services_all()
    {
        $CI = & get_instance();
        $user=User_helper::get_user();

        $CI->db->from($CI->config->item('table_services').' services');
        $CI->db->where('services.status', 1);
        $total=$CI->db->count_all_results();
        //TODO
        //need to count proposed services
        return $total;
    }
    public static function get_division_services($division)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->join($CI->config->item('table_services_uisc').' services_uisc' ,'services_uisc.uisc_id = uisc_infos.id','INNER' );
        $CI->db->where('uisc_infos.status', 1);
        $CI->db->where('services_uisc.status', 1);
        $CI->db->where('uisc_infos.division', $division);
        $total = $CI->db->count_all_results();
        //TODO
        //need to count proposed services
        return $total;
    }
    public static function get_total_services_zilla($zilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->join($CI->config->item('table_services_uisc').' services_uisc' ,'services_uisc.uisc_id = uisc_infos.id','INNER' );
        $CI->db->where('uisc_infos.status', 1);
        $CI->db->where('services_uisc.status', 1);
        $CI->db->where('uisc_infos.zilla', $zilla);
        $total = $CI->db->count_all_results();
        //TODO
        //need to count proposed services
        return $total;
    }
    public static function get_total_services_upazilla($zilla,$upazilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->join($CI->config->item('table_services_uisc').' services_uisc' ,'services_uisc.uisc_id = uisc_infos.id','INNER' );
        $CI->db->where('uisc_infos.status', 1);
        $CI->db->where('services_uisc.status', 1);
        $CI->db->where('uisc_infos.upazilla', $upazilla);
        $CI->db->where('uisc_infos.zilla', $zilla);
        $total = $CI->db->count_all_results();
        //TODO
        //need to count proposed services
        return $total;
    }


    // Invoice Count
    public static function get_total_invoices_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_invoices_division($division)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $CI->db->where('divid',$division);
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_invoices_zilla($zilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $CI->db->where('zillaid',$zilla);
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_invoices_upazila($zilla,$upazilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $CI->db->where('upazilaid',$upazilla);
        $CI->db->where('zillaid',$zilla);
        $total = $CI->db->count_all_results();
        return $total;
    }


    // Income
    public static function get_total_invoice_income_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $total_income = $CI->db->get()->result_array();
        return isset($total_income[0]['total_income']) ? $total_income[0]['total_income'] : 0 ;
    }
    public static function get_total_invoice_income_division($division)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $CI->db->where('divid',$division);
        $total_income = $CI->db->get()->result_array();
        return isset($total_income[0]['total_income']) ? $total_income[0]['total_income'] : 0 ;
    }
    public static function get_total_invoice_income_zilla($zilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $CI->db->where('zillaid',$zilla);
        $total_income = $CI->db->get()->result_array();
        return isset($total_income[0]['total_income']) ? $total_income[0]['total_income'] : 0 ;
    }
    public static function get_total_invoice_income_upazila($zilla,$upazilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_income');
        $CI->db->where('upazilaid',$upazilla);
        $CI->db->where('zillaid',$zilla);
        $total_income = $CI->db->get()->result_array();
        return isset($total_income[0]['total_income']) ? $total_income[0]['total_income'] : 0 ;
    }
    // Total inactive center
    public static function get_total_inactive_center_all()
    {
        $CI = & get_instance();
        $ystr_day = date('Y-m-d',strtotime("-1 day"));

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.uisc_id');
        $CI->db->where('invoices.invoice_date',$ystr_day);
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->select('uisc_infos.id,uisc_infos.uisc_name');
        $CI->db->where("`uisc_infos`.`id` NOT IN ($sub_query)", NULL, FALSE);
        $CI->db->group_by('uisc_infos.id');
        $query = $CI->db->get();
        return $query->num_rows();
    }
    public static function get_total_inactive_center_division($division)
    {
        $CI = & get_instance();
        $ystr_day = date('Y-m-d',strtotime("-1 day"));

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.uisc_id');
        $CI->db->where('invoices.invoice_date',$ystr_day);
        $CI->db->where('invoices.divid',$division);
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->select('uisc_infos.id,uisc_infos.uisc_name');
        $CI->db->where("`uisc_infos`.`id` NOT IN ($sub_query)", NULL, FALSE);
        $CI->db->where('uisc_infos.division',$division);
        $query = $CI->db->get();
        return $query->num_rows();
    }
    public static function get_total_inactive_center_zilla($zilla)
    {
        $CI = & get_instance();
        $ystr_day = date('Y-m-d',strtotime("-1 day"));

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.uisc_id');
        $CI->db->where('invoices.invoice_date',$ystr_day);
        $CI->db->where('invoices.zillaid',$zilla);
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->select('uisc_infos.id,uisc_infos.uisc_name');
        $CI->db->where("`uisc_infos`.`id` NOT IN ($sub_query)", NULL, FALSE);
        $CI->db->where('uisc_infos.zilla',$zilla);
        $query = $CI->db->get();
        return $query->num_rows();
    }
    public static function get_total_inactive_center_upazilla($zilla,$upazilla)
    {
        $CI = & get_instance();
        $ystr_day = date('Y-m-d',strtotime("-1 day"));

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.uisc_id');
        $CI->db->where('invoices.invoice_date',$ystr_day);
        $CI->db->where('invoices.upazilaid',$upazilla);
        $CI->db->where('invoices.zillaid',$zilla);
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->select('uisc_infos.id,uisc_infos.uisc_name');
        $CI->db->where("`uisc_infos`.`id` NOT IN ($sub_query)", NULL, FALSE);
        $CI->db->where('uisc_infos.upazilla',$upazilla);
        $CI->db->where('uisc_infos.zilla',$zilla);
        $query = $CI->db->get();
        return $query->num_rows();
    }


    // GET APPROVAL COUNT
    public static function get_total_approval_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.user_group_id',$CI->config->item('UISC_GROUP_ID'));
        $CI->db->where('users.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_approval_division($division)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.user_group_id',$CI->config->item('UISC_GROUP_ID'));
        $CI->db->where('users.division',$division);
        $CI->db->where('users.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_approval_zilla($zilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.user_group_id',$CI->config->item('UISC_GROUP_ID'));
        $CI->db->where('users.zilla',$zilla);
        $CI->db->where('users.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_approval_upazilla($zilla,$upazilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->where('users.user_group_id',$CI->config->item('UISC_GROUP_ID'));
        $CI->db->where('users.upazila',$upazilla);
        $CI->db->where('users.zilla',$zilla);
        $CI->db->where('users.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }


    // GET NOTICE COUNT
    public static function get_total_notice_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_notice').' notice');
        $CI->db->where('notice.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();

        return $total;
    }
    public static function get_total_notice_division()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_notice_view').' notice_view');
        $CI->db->where('notice_view.viewer_group_id',$CI->config->item('DIVISION_GROUP_ID'));
        $CI->db->where('notice_view.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();

        return $total;
    }
    public static function get_total_notice_zilla()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_notice_view').' notice_view');
        $CI->db->where('notice_view.viewer_group_id',$CI->config->item('DISTRICT_GROUP_ID'));
        $CI->db->where('notice_view.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();

        return $total;
    }
    public static function get_total_notice_upazila()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_notice_view').' notice_view');
        $CI->db->where('notice_view.viewer_group_id',$CI->config->item('UPAZILLA_GROUP_ID'));
        $CI->db->where('notice_view.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();

        return $total;
    }


    // GET FAQs COUNT
    public static function get_total_faqs_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_faqs').' faqs');
        $CI->db->where('faqs.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();

        return $total;
    }
    public static function get_total_faqs_division($division)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->join($CI->config->item('table_faqs').' faqs' ,'faqs.uisc_id = uisc_infos.id','LEFT' );
        $CI->db->where('uisc_infos.division',$division);
        $CI->db->where('uisc_infos.status',$CI->config->item('STATUS_ACTIVE'));
        $CI->db->where('faqs.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_faqs_zilla($zilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->join($CI->config->item('table_faqs').' faqs' ,'faqs.uisc_id = uisc_infos.id','LEFT' );
        $CI->db->where('uisc_infos.zilla',$zilla);
        $CI->db->where('uisc_infos.status',$CI->config->item('STATUS_ACTIVE'));
        $CI->db->where('faqs.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }
    public static function get_total_faqs_upazila($zilla,$upazilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->join($CI->config->item('table_faqs').' faqs' ,'faqs.uisc_id = uisc_infos.id','LEFT' );
        $CI->db->where('uisc_infos.zilla',$zilla);
        $CI->db->where('uisc_infos.upazilla',$upazilla);
        $CI->db->where('uisc_infos.status',$CI->config->item('STATUS_ACTIVE'));
        $CI->db->where('faqs.status',$CI->config->item('STATUS_ACTIVE'));
        $total = $CI->db->count_all_results();
        return $total;
    }




    //total male & female Count For pie chart
    public static function get_total_male_female_user_all()
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_men');
        $CI->db->select_sum('total_women');
        $total = $CI->db->get()->result_array();
        if(isset($total[0]['total_men']))
        {
            $total_user = $total[0]['total_men'] + $total[0]['total_women'];
            $data['male']= round(($total[0]['total_men']*100)/$total_user, 2);
            $data['female']= round(($total[0]['total_women']*100)/$total_user, 2);
        }
        else
        {
            $data['male'] = 0;
            $data['female'] = 0;
        }
        return $data;
    }
    public static function get_total_male_female_user_division($division)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_men');
        $CI->db->select_sum('total_women');
        $CI->db->where('divid',$division);
        $total = $CI->db->get()->result_array();
        if(isset($total[0]['total_men']))
        {
            $total_user = $total[0]['total_men'] + $total[0]['total_women'];
            $data['male']= round(($total[0]['total_men']*100)/$total_user, 2);
            $data['female']= round(($total[0]['total_women']*100)/$total_user, 2);
        }
        else
        {
            $data['male'] = 0;
            $data['female'] = 0;
        }
        return $data;
    }
    public static function get_total_male_female_user_zilla($zilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_men');
        $CI->db->select_sum('total_women');
        $CI->db->where('zillaid',$zilla);
        $total = $CI->db->get()->result_array();
        if(isset($total[0]['total_men']))
        {
            $total_user = $total[0]['total_men'] + $total[0]['total_women'];
            $data['male']= round(($total[0]['total_men']*100)/$total_user, 2);
            $data['female']= round(($total[0]['total_women']*100)/$total_user, 2);
        }
        else
        {
            $data['male'] = 0;
            $data['female'] = 0;
        }
        return $data;
    }
    public static function get_total_male_female_user_upazila($zilla,$upazilla)
    {
        $CI = & get_instance();
        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select_sum('total_men');
        $CI->db->select_sum('total_women');
        $CI->db->where('upazilaid',$upazilla);
        $CI->db->where('zillaid',$zilla);
        $total = $CI->db->get()->result_array();
        if(isset($total[0]['total_men']))
        {
            $total_user = $total[0]['total_men'] + $total[0]['total_women'];
            $data['male']= round(($total[0]['total_men']*100)/$total_user, 2);
            $data['female']= round(($total[0]['total_women']*100)/$total_user, 2);
        }
        else
        {
            $data['male'] = 0;
            $data['female'] = 0;
        }
        return $data;
    }


    // total income for highcharts
    public static function get_division_wise_income()
    {
        $week_start_date = date('Y-m-d',strtotime("-7 day"));
        $today = date('Y-m-d',time());
        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.divid,SUM(invoices.total_income) as income, ');
        $CI->db->where('invoices.invoice_date >=',$week_start_date);
        $CI->db->where('invoices.invoice_date <=',$today);
        $CI->db->group_by('invoices.divid');
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_divisions').' divisions');
        $CI->db->select('divisions.divname  name, invoices.income');
        $CI->db->join('('.$sub_query.') invoices','invoices.divid = divisions.divid','LEFT');
        $divisions = $CI->db->get()->result_array();
        return $divisions;
    }
    public static function get_district_wise_income($division_id)
    {
        $week_start_date = date('Y-m-d',strtotime("-7 day"));
        $today = date('Y-m-d',time());

        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.zillaid,SUM(invoices.total_income) as income, ');
        $CI->db->where('invoices.invoice_date >=',$week_start_date);
        $CI->db->where('invoices.invoice_date <=',$today);
        $CI->db->group_by('invoices.zillaid');
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_zillas').' zillas');
        $CI->db->select('zillas.zillaname  name, invoices.income');
        $CI->db->where('zillas.divid',$division_id);
        $CI->db->join('('.$sub_query.') invoices','invoices.zillaid = zillas.zillaid','LEFT');
        $districts = $CI->db->get()->result_array();

        return $districts;
    }
    public static function get_upazilla_wise_income($zilla_id)
    {
        $week_start_date = date('Y-m-d',strtotime("-7 day"));
        $today = date('Y-m-d',time());
        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.upazilaid,SUM(invoices.total_income) as income, ');
        $CI->db->where('invoices.invoice_date >=',$week_start_date);
        $CI->db->where('invoices.invoice_date <=',$today);
        $CI->db->group_by('invoices.upazilaid');
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_upazilas').' upazilas');
        $CI->db->select('upazilas.upazilaname  name, invoices.income');
        $CI->db->where('upazilas.zillaid',$zilla_id);
        $CI->db->join('('.$sub_query.') invoices','invoices.upazilaid = upazilas.upazilaid','LEFT');
        $upazilas = $CI->db->get()->result_array();
        return $upazilas;
    }
    public static function get_union_wise_income($zilla_id,$upazilla_id)
    {
        $week_start_date = date('Y-m-d',strtotime("-7 day"));
        $today = date('Y-m-d',time());

        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_invoices').' invoices');
        $CI->db->select('invoices.unionid,SUM(invoices.total_income) as income, ');
        $CI->db->where('invoices.invoice_date >=',$week_start_date);
        $CI->db->where('invoices.invoice_date <=',$today);
        $CI->db->group_by('invoices.unionid');
        $sub_query = $CI->db->get_compiled_select();

        $CI->db->from($CI->config->item('table_unions').' unions');
        $CI->db->select('unions.unionname  name, invoices.income');
        $CI->db->where('unions.upazilaid',$upazilla_id);
        $CI->db->where('unions.zillaid',$zilla_id);
        $CI->db->join('('.$sub_query.') invoices','invoices.unionid = unions.unionid','LEFT');
        $unions = $CI->db->get()->result_array();

        return $unions;
    }

    // UISC CHART
    public static function  get_uisc_weekly_income($user)
    {
        $CI = & get_instance();
        for($i=1; $i<=7; $i++)
        {
            $day= date('Y-m-d',strtotime("-$i day"));

            $CI->db->from($CI->config->item('table_invoices'));
            $CI->db->select('total_income');
            $CI->db->where('zillaid',$user->zilla);
            $CI->db->where('upazilaid',$user->upazila);
            $CI->db->where('unionid',$user->unioun);
            $CI->db->where('invoice_date',$day);
            $query = $CI->db->get();
            $data = $query->row();

            $days[$i]['day']= date('d-m-Y',strtotime("-$i day"));
            $days[$i]['income']= isset($data->total_income) ? $data->total_income : 0;
        }
     return $days;
    }
    public static function get_max_income_uisc($zilla, $upazilla, $union)
    {
        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_invoices'));
        $CI->db->select_max('total_income');
        $CI->db->where('zillaid',$zilla);
        $CI->db->where('upazilaid',$upazilla);
        $CI->db->where('unionid',$union);
        $data = $CI->db->get()->result_array();
        return isset($data[0]['total_income']) ? $data[0]['total_income'] : 0;
    }
    public static function get_min_income_uisc($zilla, $upazilla, $union)
    {
        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_invoices'));
        $CI->db->select_min('total_income');
        $CI->db->where('zillaid',$zilla);
        $CI->db->where('upazilaid',$upazilla);
        $CI->db->where('unionid',$union);
        $data = $CI->db->get()->result_array();
        return isset($data[0]['total_income']) ? $data[0]['total_income'] : 0;
    }
    public static function get_investment_uisc($uisc_id,$user_id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_investment').' invest');
        $CI->db->select('invest.*');
        $CI->db->where('invest.uisc_id', $uisc_id);
        $CI->db->where('invest.user_id', $user_id);
        $data = $CI->db->get()->row_array();

        return isset($data['invested_money']) ? $data['invested_money'] : 0;
    }
    public static function get_electricity_info_uisc($uisc_id,$user_id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_electricity').' electricity');
        $CI->db->select('electricity.electricity');
        $CI->db->where('electricity.uisc_id', $uisc_id);
        $CI->db->where('electricity.user_id', $user_id);
        $results = $CI->db->get()->row_array();

        return $results;
    }
    public static function get_loacation_info_uisc($uisc_id,$user_id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_center_location').' location');
        $CI->db->select('location.*');
        $CI->db->where('location.uisc_id', $uisc_id);
        $CI->db->where('location.user_id', $user_id);
        $results = $CI->db->get()->row_array();
        return $results;
    }

}