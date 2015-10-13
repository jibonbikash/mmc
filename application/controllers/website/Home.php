<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->controller_url='website/home';
        $this->load->model("website/home_model");
        $this->lang->load('my', $this->config->item('GET_LANGUAGE'));
        $this->lang->load('website', $this->config->item('GET_LANGUAGE'));
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
    }
    //    public function PrintPageA4Eng()
    //    {
    //        $this->load->view('website/home/Print_a4_Eng');
    //    }

    public function get_top_service_yesterday()
    {
        $ajax['status']=true;
        $data['title']=$this->lang->line("YESTERDAY_TOP_SERVICE_PROVIDER_TITLE");
        //$data['report_records']=$this->home_model->get_top_service_yesterday();
        $this->load->view('default/website/home/yesterday_top_service_provider',$data);
        //$ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website/home/yesterday_top_service_provider",$data,true));
        //$ajax['system_page_url']=$this->get_encoded_url('website/home/get_top_service_yesterday');
        //$this->jsonReturn($ajax);
    }

    public function get_top_income_yesterday()
    {
        $ajax['status']=true;
        $data['title']=$this->lang->line("YESTERDAY_TOP_INCOME_PROVIDER_TITLE");
        //$data['report_records']=$this->home_model->get_top_income_yesterday();
        $this->load->view('default/website/home/yesterday_top_income',$data);

    }

    public function get_top_service_last_seven_days()
    {
        $ajax['status']=true;
        //$data['title']=$this->lang->line("LAST_SEVEN_DAYS_TOP_INCOME_PROVIDER_TITLE");
        //$data['report_records']=$this->home_model->get_top_service_last_seven_days();
        $this->load->view('default/website/home/last_seven_day_service_provider',$data);

    }

    public function get_top_income_last_seven_days()
    {
        $ajax['status']=true;
        //$data['title']=$this->lang->line("LAST_SEVEN_DAYS_TOP_INCOME_PROVIDER_TITLE");
        //$data['report_records']=$this->home_model->get_top_income_last_seven_days();
        $this->load->view('default/website/home/last_seven_day_top_income',$data);

    }

    public function get_top_service_last_month()
    {
        $ajax['status']=true;
        //$data['title']=$this->lang->line("LAST_SEVEN_DAYS_TOP_INCOME_PROVIDER_TITLE");
        //$data['report_records']=$this->home_model->get_top_service_last_month();
        $this->load->view('default/website/home/last_month_top_service_provider',$data);

    }

    public function get_top_income_last_month()
    {
        $ajax['status']=true;
        //$data['title']=$this->lang->line("LAST_SEVEN_DAYS_TOP_INCOME_PROVIDER_TITLE");
        //$data['report_records']=$this->home_model->get_top_income_last_month();
        $this->load->view('default/website/home/last_month_top_income',$data);

    }


}
