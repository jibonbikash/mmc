<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_role_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_roles_info()//for list page
    {
        $CI =& get_instance();
        $language_code=$CI->get_language_code();
        $this->db->from($CI->config->item('table_user_group_role').' ugr');
        $this->db->select('ugr.user_group_id');
        $this->db->select('Count(DISTINCT ugr.component_id) total_component');
        $this->db->select('Count(DISTINCT ugr.module_id) total_module');
        $this->db->select('Count(DISTINCT ugr.task_id) total_task');
        $this->db->select('Max(ugr.create_date) last_create_date');
        $this->db->select('Max(ugr.update_date) last_update_date');
        $this->db->group_by('ugr.user_group_id');

        $this->db->where('ugr.list',1);
        $sub_query=$this->db->get_compiled_select();

        $this->db->from($CI->config->item('table_user_group').' ug');
        $this->db->select('ug.id,ug.name_'.$language_code.' group_name');
        $this->db->select('ugr.total_component,ugr.total_module,ugr.total_task,ugr.last_create_date,ugr.last_update_date');
        $this->db->join('('.$sub_query.') ugr','ugr.user_group_id = ug.id','LEFT');

        $results=$this->db->get()->result_array();
        foreach($results as &$result)
        {
            $result['edit_link']=$CI->get_encoded_url('user_group/user_role/index/edit/'.$result['id']);
            $result['last_modified']='';
            if(($result['last_create_date'])>0 || ($result['last_update_date'])>0)
            {
                if($result['last_create_date']>$result['last_update_date'])
                {
                    $result['last_modified']=date($this->config->item('DATE_DISPLAY_FORMAT'),$result['last_create_date']);
                }
                else
                {
                    $result['last_modified']=date($this->config->item('DATE_DISPLAY_FORMAT'),$result['last_update_date']);
                }

            }
            if(!$result['total_component'])
            {
                $result['total_component']=0;
                $result['total_module']=0;
                $result['total_task']=0;
            }
        }
        return $results;

    }
    public function get_my_tasks($user_group_id)
    {
        $CI =& get_instance();
        $language_code=$CI->get_language_code();
        $user=User_helper::get_user();
        //SUPER_ADMIN_GROUP_ID
        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
        {
            $this->db->from($CI->config->item('table_task').' task');
            $this->db->select('task.component_id,task.module_id,task.id task_id,task.name_'.$language_code.' task_name');
            $this->db->select('c.name_'.$language_code.' component_name');
            $this->db->select('m.name_'.$language_code.' module_name');
            $this->db->join($CI->config->item('table_component').' c','c.id = task.component_id',"INNER");
            $this->db->join($CI->config->item('table_module').' m','m.id = task.module_id',"INNER");
            if($user->user_group_id==$user_group_id)
            {
                $this->db->where('task.controller NOT LIKE "user_group/User_role%"');
            }
            $results=$this->db->get()->result_array();
            foreach($results as &$result)
            {
                $result['list']=1;
                $result['view']=1;
                $result['add']=1;
                $result['edit']=1;
                $result['delete']=1;
                $result['report']=1;
                $result['print']=1;
            }
            return $results;
        }
        else
        {
            $this->db->from($CI->config->item('table_user_group_role').' ugr');
            $this->db->select('ugr.component_id,ugr.module_id,ugr.task_id');

            $this->db->select('c.name_'.$language_code.' component_name');
            $this->db->select('m.name_'.$language_code.' module_name');
            $this->db->select('task.name_'.$language_code.' task_name');
            $this->db->select('ugr.list,ugr.view,ugr.add,ugr.edit,ugr.delete,ugr.report,ugr.print');
            $this->db->join($CI->config->item('table_component').' c','c.id = ugr.component_id',"INNER");
            $this->db->join($CI->config->item('table_module').' m','m.id = ugr.module_id',"INNER");
            $this->db->join($CI->config->item('table_task').' task','task.id = ugr.task_id',"INNER");
            $this->db->where('ugr.user_group_id',$user->user_group_id);
            $this->db->where('ugr.list',1);
            if(($user->user_group_id==$user_group_id)||($user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID')))
            {
                $this->db->where('task.controller NOT LIKE "user_group/User_role%"');
            }
            $results=$this->db->get()->result_array();
            return $results;
        }
    }
    public function get_role_status($user_group_id)
    {
        $CI =& get_instance();
        $this->db->from($CI->config->item('table_user_group_role').' ugr');
        $this->db->select('ugr.id ugr_id,ugr.list,ugr.view,ugr.add,ugr.edit,ugr.delete,ugr.report,ugr.print,ugr.component_id,ugr.module_id,ugr.task_id');
        $this->db->where('ugr.user_group_id',$user_group_id);
        $this->db->order_by('ugr.component_id ASC');
        $this->db->order_by('ugr.module_id ASC');
        $this->db->order_by('ugr.module_id ASC');
        $results=$this->db->get()->result_array();
        $roles=array();
        $roles['list']=array();
        $roles['view']=array();
        $roles['add']=array();
        $roles['edit']=array();
        $roles['delete']=array();
        $roles['report']=array();
        $roles['print']=array();
        $roles['ugr_id']=array();
        foreach($results as $result)
        {
            $roles['ugr_id'][$result['task_id']]=$result['ugr_id'];
            if($result['list'])
            {
                $roles['list'][]=$result['task_id'];
            }
            if($result['view'])
            {
                $roles['view'][]=$result['task_id'];
            }
            if($result['add'])
            {
                $roles['add'][]=$result['task_id'];
            }
            if($result['edit'])
            {
                $roles['edit'][]=$result['task_id'];
            }
            if($result['delete'])
            {
                $roles['delete'][]=$result['task_id'];
            }
            if($result['report'])
            {
                $roles['report'][]=$result['task_id'];
            }
            if($result['print'])
            {
                $roles['print'][]=$result['task_id'];
            }
        }

        return $roles;
    }
}