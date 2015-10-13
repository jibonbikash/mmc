<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uisc_invested_money_list extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('report/uisc_invested_money_list');
        $this->controller_url='report/uisc_invested_money_list';
        $this->lang->load("report", $this->get_language());
        $this->load->model("report/uisc_report_model");
    }

    public function index()
    {
        $ajax['status']=true;
        $data['title']=$this->lang->line("REPORT_INVESTED_MONEY_TITLE");

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/uisc_invested_money_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/uisc_invested_money_list');
        $this->jsonReturn($ajax);
    }

}
