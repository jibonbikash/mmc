<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Eservice_list_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_service_list()
    {
        $CI =& get_instance();
        $this->db->from($CI->config->item('table_services').' service');
        $this->db->select('service.*');
        $this->db->where('service.status !=',99);
        $this->db->where('status', $this->config->item('STATUS_ACTIVE'));
        $services = $this->db->get()->result_array();
        return $services;
    }


}