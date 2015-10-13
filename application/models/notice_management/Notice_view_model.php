<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice_view_model extends CI_Model
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
        $this->db->select('notice_infos.notice_title,
                            notice_infos.upload_file,
                            notice_infos.`status`,
                            user_group.name_bn,
                            notice_infos.id');
        $this->db->from($CI->config->item('table_notice')." notice_infos");
        $this->db->join($CI->config->item('table_notice_view')." notice_view_infos",'notice_view_infos.notice_id = notice_infos.id', 'LEFT');
        $this->db->join($CI->config->item('table_user_group')." user_group",'user_group.id = notice_view_infos.create_group_id', 'LEFT');
        $this->db->where('notice_infos.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where('notice_view_infos.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where('notice_view_infos.viewer_group_id', $user->user_group_id);
        $users = $this->db->get()->result_array();

        foreach($users as &$user)
        {
            $user['edit_link']=$CI->get_encoded_url('notice_management/notice_view/index/batch_details/'.$user['id']);
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

    public function get_notice_info($id)
    {
        $user=User_helper::get_user();
        $CI =& get_instance();
        $this->db->select('notice_infos.notice_title,
                            notice_infos.notice_details,
                            notice_infos.upload_file,
                            notice_infos.`status`,
                            user_group.name_bn,
                            notice_infos.id');
        $this->db->from($CI->config->item('table_notice')." notice_infos");
        $this->db->join($CI->config->item('table_notice_view')." notice_view_infos",'notice_view_infos.notice_id = notice_infos.id', 'LEFT');
        $this->db->join($CI->config->item('table_user_group')." user_group",'user_group.id = notice_view_infos.create_group_id', 'LEFT');
        $this->db->where('notice_infos.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where('notice_view_infos.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where('notice_view_infos.viewer_group_id', $user->user_group_id);
        $this->db->where('notice_infos.id', $id);
        $result = $this->db->get()->row_array();
        //echo $this->db->last_query();
        return $result;
    }
}