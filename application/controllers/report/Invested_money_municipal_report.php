<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invested_money_municipal_report extends CI_Controller
{
    public $permissions;
    function __construct()
    {
        parent::__construct();
        //TODO
        //check security and loged user
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
        $this->lang->load("my", $this->config->item('GET_LANGUAGE'));
        $this->load->model("report/invested_money_model");
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
            $data['title']=$this->lang->line("REPORT_INVESTED_MONEY_MUNICIPAL_TITLE");
            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $municipal=$this->input->get('municipal');
            $municipal_ward=$this->input->get('municipal_ward');
            $data['getUiscInfos']=$this->invested_money_model->get_invested_money_municipal_info($division, $zilla, $municipal, $municipal_ward);
            $this->load->view('default/report/invested_money_municipal_report',$data);
        }
        else
        {
            $data['title']=$this->lang->line("REPORT_INVESTED_MONEY_MUNICIPAL_TITLE");
            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $municipal=$this->input->get('municipal');
            $municipal_ward=$this->input->get('municipal_ward');
            $data['getUiscInfos']=$this->invested_money_model->get_invested_money_municipal_info($division, $zilla, $municipal, $municipal_ward);
            $html=$this->load->view('default/report/invested_money_municipal_report',$data,true);
            System_helper::get_pdf($html);
        }
    }

}