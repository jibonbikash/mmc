<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_direction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->lang->load('my');
        //$this->load->model("user/Service_template_model");
    }

    public function index()
    {
        $this->load->helper('download');

        $data = file_get_contents(base_url().'download/' . 'instructions.pdf');
        $name = 'রেজিস্ট্রেশন নির্দেশনা.pdf';
        force_download($name, $data);
    }
}
