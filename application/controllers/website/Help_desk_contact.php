<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help_desk_contact extends Root_Controller
{
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->controller_url='website/Help_desk_contact';
        $this->lang->load('my_lang');
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='add')
        {
            $this->dcms_add();
        }
        else
        {
            $this->current_action='add';
            $this->dcms_add();
        }
    }

    private function dcms_add()
    {
        $this->current_action='add';
        $ajax['status']=true;
        $data=array();
        $data['title']=$this->lang->line("HELP_DESK_CONTACT");

        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website/help_desk/list",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));

        if($this->message)
        {
            $ajax['system_message']=$this->message;
        }

        $ajax['system_page_url']=$this->get_encoded_url('website/help_desk_contact/index/list');
        $this->jsonReturn($ajax);
    }



}
