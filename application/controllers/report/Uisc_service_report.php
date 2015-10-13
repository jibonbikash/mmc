<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uisc_service_report extends CI_Controller
{
    public $permissions;
    function __construct()
    {
        parent::__construct();
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
        $this->lang->load("my", $this->config->item('GET_LANGUAGE'));
        $this->load->model("report/uisc_report_model");
    }

    public function index($task="search",$id=0)
    {
        if($task=="list")
        {
            $this->report_list();
        }
        else if($task=="pdf")
        {
            $this->report_list("pdf");
        }
        else
        {
            $this->search();
        }
    }
    private function report_list($format="")
    {
        if($format!="pdf")
        {
            $data['title']=$this->lang->line("REPORT_SERVICE_RELATED_TITLE");
            $data['services']=$this->uisc_report_model->get_uisc_service_info();
            $this->load->view('default/report/uisc_service_report',$data);
        }
        else
        {
            $html='create report pdf';
            echo 'hi';
            //System_helper::get_pdf($html);
        }
    }

}