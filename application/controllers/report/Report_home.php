<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_home extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        //$this->permissions=Menu_helper::get_permission('report/registered_union_list');
        $this->controller_url='report/report_home';
        //$this->load->model("basic_setup/registered_union_list_model");

    }

    public function index()
    {
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/report_home","",true));
        $ajax['system_page_url']=$this->get_encoded_url('report/report_home');
        $this->jsonReturn($ajax);
    }

}
