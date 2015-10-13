<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Component_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_components()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_component').' component');
        $this->db->select('component.id,component.icon component_icon,component.description,component.ordering,component.status');
        $this->db->select('component.name_'.$CI->get_language_code().' component_name');
        $this->db->order_by('component.ordering ASC');
        $this->db->where('status != 99');
        $components=$this->db->get()->result_array();
        foreach($components as &$component)
        {
            $component['edit_link']=$CI->get_encoded_url('system_setup/component/index/edit/'.$component['id']);
            if($component['status']==1)
            {
                $component['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($component['status']==0)
            {
                $component['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $component['status_text']=$component['status'];
            }
        }
        return $components;
    }
    public function get_component_details($ids)
    {
        if($ids)
        {
            $CI =& get_instance();

            $this->db->from($CI->config->item('table_component').' component');
            $this->db->select('component.id,component.icon,component.description,component.ordering,name_en,name_bn,component.status');
            $this->db->where_in('id',$ids);
            $this->db->where('status != 99');
            $this->db->order_by('component.ordering ASC');
            $components=$this->db->get()->result_array();

            return $components;
        }
        else
        {
            return null;
        }

    }
}