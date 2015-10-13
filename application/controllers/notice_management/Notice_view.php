<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_view extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        //
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('notice_management/notice_view');
        $this->controller_url='notice_management/notice_view';
        $this->load->model("notice_management/notice_view_model");
        $this->lang->load("notice_management", $this->get_language());
        if($this->permissions)
        {
            $this->permissions['add']=0;
            $this->permissions['delete']=0;
            $this->permissions['view']=0;
            $this->permissions['edit']=0;
        }
    }

    public function index($action='list',$id=0)
    {
        $this->current_action=$action;

        if($action=='list')
        {
            $this->system_list();
        }
        elseif($action=='batch_details')
        {
            $this->system_batch_details($id);
        }
        else
        {
            $this->system_list();
        }
    }

    private function system_list()
    {
        if($this->permissions['list'])
        {
            $this->current_action='list';
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice_management/notice_view/list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('notice_management/notice_view');
            $ajax['system_page_title']=$this->lang->line("NOTICE_VIEW_TITLE");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_batch_details($id)
    {
        $this->current_action='batch_details';
        $selected_ids=$id;//$this->input->post('selected_ids');
        $data['title']=$this->lang->line("NOTICE_VIEW_TITLE");
        $data['NoticeInfo']=$this->notice_view_model->get_notice_info($selected_ids);
        $ajax['status']=true;

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice_management/notice_view/detail",$data,true));
        if($this->message)
        {
            $ajax['system_message']=$this->message;
        }
        $ajax['system_page_url']=$this->get_encoded_url('notice_management/notice_view/index/batch_details/'.$selected_ids);
        $this->jsonReturn($ajax);
    }

    public function get_list()
    {
        $divisions = array();
        if($this->permissions['list'])
        {
            $divisions = $this->notice_view_model->get_record_list();
        }
        $this->jsonReturn($divisions);
    }



}
