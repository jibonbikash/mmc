<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice_create_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_record_list()
    {
        $user=User_helper::get_user();
        $CI =& get_instance();
        $this->db->select('notice_infos.id,
                            notice_infos.notice_title,
                            notice_infos.notice_details,
                            notice_infos.upload_file,
                            notice_infos.`status`,
                            notice_infos.create_by');
        $this->db->from($CI->config->item('table_notice')." notice_infos");
        $this->db->where('status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where('create_by', $user->id);
        $users = $this->db->get()->result_array();
        foreach($users as &$user)
        {
            $user['edit_link']=$CI->get_encoded_url('notice_management/notice_create/index/edit/'.$user['id']);
            if($user['status']==$this->config->item('STATUS_ACTIVE'))
            {
                $user['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($user['status']==$this->config->item('STATUS_INACTIVE'))
            {
                $user['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $user['status_text']=$user['status'];
            }

            if(!empty($user['upload_file']))
            {
                $user['upload_status']=$CI->lang->line('FILE_UPLOADED');
            }
            else
            {
                $user['upload_status']=$CI->lang->line('FILE_NOT_UPLOADED');
            }
        }
        return $users;
    }

    public function check_existence($value,$id, $field_name)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_services'));
        $CI->db->where($field_name,$value);
        if($id>0)
        {
            $CI->db->where('service_id !=',$id);
        }

        $result = $CI->db->get()->row_array();
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function get_user_group()
    {
        $CI =& get_instance();
        $user=User_helper::get_user();
        if($user->user_group_id == $this->config->item('SUPER_ADMIN_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('A_TO_I_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('DONOR_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('MINISTRY_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('DIVISION_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('DISTRICT_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('UPAZILLA_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
                $this->config->item('UPAZILLA_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
                $this->config->item('MUNICIPAL_GROUP_ID'),
                $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('UNION_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
                $this->config->item('UPAZILLA_GROUP_ID'),
                $this->config->item('UNION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
                $this->config->item('MUNICIPAL_GROUP_ID'),
                $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_GROUP_ID'),
                $this->config->item('UPAZILLA_GROUP_ID'),
                $this->config->item('UNION_GROUP_ID'),
                $this->config->item('MUNICIPAL_GROUP_ID'),
                $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
                $this->config->item('UPAZILLA_GROUP_ID'),
                $this->config->item('UNION_GROUP_ID'),
                $this->config->item('MUNICIPAL_GROUP_ID'),
                $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('MUNICIPAL_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
                $this->config->item('MUNICIPAL_GROUP_ID'),
                $this->config->item('UPAZILLA_GROUP_ID'),
                $this->config->item('UNION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else if($user->user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID'))
        {
            $names = array
            (
                $this->config->item('SUPER_ADMIN_GROUP_ID'),
                $this->config->item('A_TO_I_GROUP_ID'),
                $this->config->item('DONOR_GROUP_ID'),
                $this->config->item('MINISTRY_GROUP_ID'),
                $this->config->item('DIVISION_GROUP_ID'),
                $this->config->item('DISTRICT_GROUP_ID'),
                $this->config->item('MUNICIPAL_GROUP_ID'),
                $this->config->item('MUNICIPAL_WORD_GROUP_ID'),
                $this->config->item('UPAZILLA_GROUP_ID'),
                $this->config->item('UNION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_GROUP_ID'),
                $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'),
            );
            $CI->db->where_not_in('id',$names);
        }
        else
        {
            $CI->db->where_not_in('id','');
        }

        $CI->db->from($CI->config->item('table_user_group'));
        $CI->db->where('status',$CI->config->item('STATUS_ACTIVE'));
        $CI->db->limit(13);
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    public function get_notice_view_group($id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_notice_view'));
        $CI->db->where('status',$CI->config->item('STATUS_ACTIVE'));
        $CI->db->where('notice_id',$id);
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        $group_id=array();
        for($i=0; $i<sizeof($result); $i++)
        {
            $group_id[$i]=$result[$i]['viewer_group_id'];
        }
        return $group_id;
    }
}