<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_wise_municipal_monthly_income_list extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('report/country_wise_municipal_monthly_income_list');
        $this->controller_url='report/country_wise_municipal_monthly_income_list';
        $this->lang->load("report", $this->get_language());
        //$this->load->model("basic_setup/country_wise_municipal_monthly_income_list_model");

    }

    public function index()
    {
        $ajax['status']=true;
        $data['title']=$this->lang->line("REPORT_COUNTRY_WISE_MUNICIPAL_MONTHLY_INCOME_TITLE");

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/country_wise_municipal_monthly_income_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/country_wise_municipal_monthly_income_list');
        $this->jsonReturn($ajax);
    }

}
