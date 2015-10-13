<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_create_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_question_list()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $user_id = $user->id;
        $uisc_id = $user->uisc_id;

        $CI->db->select('faqs.*');
        $CI->db->select('groups.name_bn question_made_to');
        $CI->db->from($CI->config->item('table_faqs').' faqs');
        $CI->db->where('faqs.user_id', $user_id);
        $CI->db->where('faqs.uisc_id', $uisc_id);
        $CI->db->join($CI->config->item('table_user_group').' groups', 'groups.id = faqs.user_type', 'LEFT');
        $results = $this->db->get()->result_array();

        foreach($results as &$result)
        {
            $result['edit_link']=$CI->get_encoded_url('faq_management/Question_create/index/batch_details/'.$result['id']);
            if($result['answer']!='')
            {
                $result['ans_status'] = $CI->lang->line('ANSWERED');
            }
            else
            {
                $result['ans_status'] = $CI->lang->line('NOT_ANSWERED');
            }
        }
        return $results;
    }

    public function get_question_user_groups()
    {
        $CI =& get_instance();
        $skip = array
        (
            $this->config->item('SUPER_ADMIN_GROUP_ID'),
            $this->config->item('UNION_GROUP_ID'),
            $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
            $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
            $this->config->item('UISC_GROUP_ID')
        );

        $CI->db->from($CI->config->item('table_user_group').' groups');
        $CI->db->select('groups.*');

        $CI->db->where_not_in('groups.id',$skip);
        $result = $CI->db->get()->result_array();
        return $result;
    }

    public function get_faq_detail($id)
    {
        $CI =& get_instance();

        $CI->db->select('faqs.*');
        $CI->db->from($CI->config->item('table_faqs').' faqs');
        $CI->db->where('faqs.id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }
}