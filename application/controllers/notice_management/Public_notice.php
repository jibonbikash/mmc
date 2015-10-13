<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_notice extends Root_Controller
{
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->controller_url='notice_management/Public_notice';
        $this->load->model("notice_management/Public_notice_model");
    }

    public function index($action='edit',$id=0)
    {
        $this->current_action=$action;

        if($action=='edit')
        {
            $this->system_edit();
        }
        elseif($action=='save')
        {
            $this->system_save();
        }
        else
        {
            $this->system_edit();
        }
    }

    private function system_edit()
    {
        $user = User_helper::get_user();

        $this->current_action = 'edit';
        $ajax['status'] = true;
        $data = array();

        $data['title'] = $this->lang->line("PUBLIC_NOTICE");
        $data['notices'] = Website_helper::get_all_public_notices();

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice_management/public_notice/system_add_edit",$data,true));

        if($this->message)
        {
            $ajax['system_message']=$this->message;
        }

        $ajax['system_page_url']=$this->get_encoded_url('notice_management/public_notice/index/view/');
        $this->jsonReturn($ajax);
    }

}
