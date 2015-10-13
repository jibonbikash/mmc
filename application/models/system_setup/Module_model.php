<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_modules()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_module').' module');
        $this->db->select('module.id,module.component_id,module.icon module_icon,module.description,module.ordering,module.status');
        $this->db->select('module.name_'.$CI->get_language_code().' module_name');
        $this->db->select('c.name_'.$CI->get_language_code().' component_name');
        $this->db->join($CI->config->item('table_component').' c','c.id = module.component_id',"INNER");
        $this->db->where('module.status != 99');
        $this->db->where('c.status != 99');
        $this->db->order_by('c.ordering ASC');
        $this->db->order_by('module.ordering ASC');

        $modules = $this->db->get()->result_array();
        foreach($modules as &$module)
        {
            $module['edit_link']=$CI->get_encoded_url('system_setup/module/index/edit/'.$module['id']);
            //for displaying status as active/inactive
            if($module['status']==1)
            {
                $module['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($module['status']==0)
            {
                $module['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $module['status_text']=$module['status'];
            }
        }
        return $modules;
    }
    public function get_module_details($ids)
    {
        if($ids)
        {
            $CI =& get_instance();

            $this->db->from($CI->config->item('table_module').' module');
            $this->db->select('module.id,module.icon,module.description,module.ordering,module.name_en,module.name_bn,module.status');
            $this->db->select('c.name_'.$CI->get_language_code().' component_name');
            $CI->db->join($CI->config->item('table_component').' c','c.id = module.component_id',"INNER");
            $this->db->where_in('module.id',$ids);
            $this->db->where('module.status != 99');
            $this->db->where('c.status != 99');
            $this->db->order_by('module.ordering ASC');
            $modules=$this->db->get()->result_array();

            return $modules;
        }
        else
        {
            return null;
        }

    }
}