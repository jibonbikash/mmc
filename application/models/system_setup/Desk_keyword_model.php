<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class system_keyword_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_system_keywords()
    {
        $CI =& get_instance();
        $keyConfig = $this->config->item('KEY_TYPE');

        $this->db->from($CI->config->item('table_system_keyword').' keyword');
        $this->db->select('keyword.id,keyword.parent,keyword.ordering,keyword.status');
        $this->db->select('keyword.name_'.$CI->get_language_code().' keyword_name');
        $this->db->order_by('keyword.ordering ASC');
        $this->db->where('status != 99');
        $keywords=$this->db->get()->result_array();

        foreach($keywords as &$keyword)
        {
            $keyword['edit_link']=$CI->get_encoded_url('system_setup/system_keyword/index/edit/'.$keyword['id']);
            if($keyword['status']==1)
            {
                $keyword['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($keyword['status']==0)
            {
                $keyword['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $keyword['status_text']=$keyword['status'];
            }

            foreach($keyConfig as $key=>$value)
            {
                if($keyword['parent'] == $value)
                {
                    $keyword['parent_name'] = $key;
                    break;
                }
            }

        }
        return $keywords;
    }

    public function get_system_keywords_details($ids)
    {
        if($ids)
        {
            $CI =& get_instance();

            $this->db->from($CI->config->item('table_system_keyword').' keyword');
            $this->db->select('keyword.type,keyword.type_code,keyword.name_en,keyword.name_bn,keyword.key_value,keyword.description_en,description_bn,keyword.ordering,keyword.status');
            $this->db->where_in('id',$ids);
            $this->db->where('status != 99');
            $this->db->order_by('keyword.ordering ASC');
            $components=$this->db->get()->result_array();

            return $components;
        }
        else
        {
            return null;
        }
    }

    public function check_main_campus_existence()
    {
        $CI =& get_instance();
        $keyConfig = $this->config->item('KEY_TYPE');

        $CI->db->from($CI->config->item('table_system_keyword').' keyword');
        $CI->db->select('keyword.description');

        $CI->db->where('keyword.status != 99');
        $CI->db->where('keyword.parent', $keyConfig['CAMPUS']);
        $campuses = $this->db->get()->result_array();

        foreach($campuses as $campus)
        {
            $description = json_decode($campus['description'], true);
            foreach($description as $des)
            {
                if(isset($des['primary']) && ($des['primary']==1))
                {
                    $ex = 1;
                }
                else
                {
                    $ex = 0;
                }
            }
        }

        if($ex==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}