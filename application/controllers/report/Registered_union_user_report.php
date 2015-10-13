<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registered_union_user_report extends CI_Controller
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
            $data['title']=$this->lang->line("REPORT_UISC_REGISTRATION_UNION_USER_TITLE");
            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $upazila=$this->input->get('upazila');
            $union=$this->input->get('union');
            $data['getUiscInfos']=$this->uisc_registration_model->get_uisc_registration_union_user_info($division, $zilla, $upazila, $union);
            $this->load->view('default/report/registered_union_user_report',$data);
        }
        else
        {
            $data['title']=$this->lang->line("REPORT_UISC_REGISTRATION_TITLE");
            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $upazila=$this->input->get('upazila');
            $union=$this->input->get('union');
            $uisc_status=$this->input->get('status');
            $data['getUiscInfos']=$this->uisc_registration_model->get_uisc_registration_union_user_info($division, $zilla, $upazila, $union, $uisc_status);
            $html=$this->load->view('default/report/registered_union_user_report',$data,true);
            //echo $html;
            System_helper::get_pdf($html);
        }
    }

}