<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggestion extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('user/Suggestion');
        $this->controller_url='user/Suggestion';
        $this->load->model("user/Suggestion_model");
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='add')
        {
            $this->dcms_add();
        }
        elseif($action=='save')
        {
            $this->dcms_save();
        }
        else
        {
            $this->current_action='add';
            $this->dcms_add();
        }
    }

    private function dcms_add()
    {
        if($this->permissions['add'])
        {
            $this->current_action='add';
            $ajax['status']=true;
            $data=array();
            $data['title']=$this->lang->line("SUGGESTION");

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user/suggestion/dcms_add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('user/suggestion/index/add');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_save()
    {
        $user = User_helper::get_user();
        $data = array();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $data['suggestion'] = $this->input->post('suggestion');
            $data['date'] = date('Y-m-d');
            $data['uisc_id'] = $user->uisc_id;
            $data['created'] = $user->id;
            $data['user_id'] = $user->id;

            $this->db->trans_start();  //DB Transaction Handle START

            Query_helper::add($this->config->item('table_suggestion'), $data);

            $this->db->trans_complete();   //DB Transaction Handle END

            if($this->db->trans_status() === TRUE)
            {
                $this->message = $this->lang->line("MSG_CREATE_SUCCESS");
                $this->dcms_add();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                $this->jsonReturn($ajax);
            }
        }
    }

    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('suggestion','Suggestion','required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }

        return true;
    }

}
