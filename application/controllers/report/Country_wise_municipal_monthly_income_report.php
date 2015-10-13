<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_wise_municipal_monthly_income_report extends CI_Controller
{
    public $permissions;
    function __construct()
    {
        parent::__construct();
        //TODO
        //check security and loged user
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
        $this->lang->load("my", $this->config->item('GET_LANGUAGE'));
        $this->load->model("report/uisc_registration_model");
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
            $data['title']=$this->lang->line("REPORT_COUNTRY_WISE_MUNICIPAL_MONTHLY_INCOME_TITLE");
            $month=$this->input->get('month');
            $year=$this->input->get('year');
            $data['report_lists']=$this->uisc_registration_model->get_country_wise_municipal_monthly_income_info($month, $year);
            $this->load->view('default/report/country_wise_municipal_monthly_income_report',$data);
        }
        else
        {
            $html='create report pdf';
            echo 'hi';
            //System_helper::get_pdf($html);
        }
    }

}