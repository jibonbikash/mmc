<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uisc_invested_money_report extends CI_Controller
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
        $this->load->model("report/invested_money_model");
        if($format!="pdf")
        {
            $data['title']=$this->lang->line("REPORT_INVESTED_MONEY_TITLE");

            $user=User_helper::get_user();
            if($user->uisc_type == $this->config->item('ONLINE_UNION_GROUP_ID'))
            {
                $data['getUiscInfos']=$this->invested_money_model->get_invested_money_union_info($user->division, $user->zilla, $user->upazila, $user->unioun);
            }
            elseif($user->uisc_type == $this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'))
            {
                $data['getUiscInfos']=$this->invested_money_model->get_invested_money_municipal_info($user->division, $user->zilla, $user->municipal, $user->municipalward);
            }
            elseif($user->uisc_type == $this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'))
            {
                $data['getUiscInfos']=$this->invested_money_model->get_invested_money_union_info($user->division, $user->zilla, $user->citycorporation, $user->citycorporationward);
            }

            $this->load->view('default/report/uisc_invested_money_report',$data);
        }
        else
        {
            $html='create report pdf';
            echo 'hi';
            //System_helper::get_pdf($html);
        }
    }

}