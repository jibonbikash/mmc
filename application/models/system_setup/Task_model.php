<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_tasks()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_task').' task');
        $this->db->select('task.id,task.component_id,task.module_id,task.icon task_icon,task.description,task.ordering,task.controller,task.status');
        $this->db->select('task.name_'.$CI->get_language_code().' task_name');
        $this->db->select('c.name_'.$CI->get_language_code().' component_name');
        $this->db->select('m.name_'.$CI->get_language_code().' module_name');
        $this->db->join($CI->config->item('table_component').' c','c.id = task.component_id',"INNER");
        $this->db->join($CI->config->item('table_module').' m','m.id = task.module_id',"INNER");
        $this->db->where('task.status !=99');
        $this->db->where('c.status !=99');
        $this->db->where('m.status !=99');
        $this->db->order_by('c.ordering ASC');
        $this->db->order_by('m.ordering ASC');
        $this->db->order_by('task.ordering ASC');
        $tasks=$this->db->get()->result_array();
        foreach($tasks as &$task)
        {
            $task['edit_link']=$CI->get_encoded_url('system_setup/task/index/edit/'.$task['id']);
            if($task['status']==1)
            {
                $task['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($task['status']==0)
            {
                $task['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $task['status_text']=$task['status'];
            }

        }
        return $tasks;
    }
    public function get_task_details($ids)
    {
        if($ids)
        {
            $CI =& get_instance();

            $this->db->from($CI->config->item('table_task').' task');
            $this->db->select('task.id,task.icon,task.description,task.ordering,task.name_en,task.name_bn,task.controller,task.status');
            $this->db->select('c.name_'.$CI->get_language_code().' component_name');
            $this->db->select('m.name_'.$CI->get_language_code().' module_name');
            $CI->db->join($CI->config->item('table_component').' c','c.id = task.component_id',"INNER");
            $CI->db->join($CI->config->item('table_module').' m','m.id = task.module_id',"INNER");
            $this->db->where_in('task.id',$ids);
            $this->db->where('task.status != 99');
            $this->db->where('m.status != 99');
            $this->db->where('c.status != 99');
            $this->db->order_by('task.ordering ASC');
            $task=$this->db->get()->result_array();

            return $task;
        }
        else
        {
            return null;
        }

    }
}