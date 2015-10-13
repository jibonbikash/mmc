<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registered_city_corporation_user_report extends CI_Controller
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
            $data['title']=$this->lang->line("REPORT_UISC_REGISTRATION_CITY_CORPORATION_USER_TITLE");
            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $city_corporation=$this->input->get('city_corporation');
            $city_corporation_ward=$this->input->get('city_corporation_ward');
            $data['getUiscInfos']=$this->uisc_registration_model->get_uisc_registration_city_corporation_user_info($division, $zilla, $city_corporation, $city_corporation_ward);
            $this->load->view('default/report/registered_city_corporation_user_report',$data);
        }
        else
        {
            $html='create report pdf';
            echo 'hi';
            //System_helper::get_pdf($html);
        }
    }

}