<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_create extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('faq_management/Answer_create');
        $this->controller_url='faq_management/Answer_create';
        $this->load->model("faq_management/Answer_create_model");

        $this->permissions['view']='';
        $this->permissions['add']='';
    }

    public function index($action='list',$id=0)
    {
        $this->current_action=$action;

        if($action=='list')
        {
            $this->system_list();
        }
        elseif($action=='save')
        {
            $this->system_save();
        }
        elseif($action=='edit')
        {
            $this->system_edit($id);
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("faq_management/answer_create/list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('faq_management/Answer_create');
            $ajax['system_page_title']=$this->lang->line("ANSWER_CREATE");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function system_save()
    {
        $user=User_helper::get_user();
        $id = $this->input->post("id");

        if($id>0)
        {
            if(!$this->permissions['edit'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();
            }
        }

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            if($id>0)
            {
                $data = array();
                $user_id = $user->id;

                $data['answer'] = $this->input->post('answer');
                $data['update_by'] = $user_id;
                $data['update_date'] = time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_faqs'),$data,array("id = ".$id));

                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
                    $save_and_new=$this->input->post('system_save_new_status');
                    if($save_and_new==1)
                    {
                        $this->system_add();
                    }
                    else
                    {
                        $this->system_list();
                    }
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
                $this->jsonReturn($ajax);

            }
        }
    }

    private function system_edit($id)
    {
        if(!$this->permissions['edit'])
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->current_action='edit';

            $data['title'] = $this->lang->line('QUESTION_DETAIL');
            $data['groups'] = $this->Answer_create_model->get_question_user_groups();
            $data['faqs']=$this->Answer_create_model->get_faq_detail($id);
            $ajax['status']=true;

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("faq_management/answer_create/detail",$data,true));
            $this->jsonReturn($ajax);
        }
    }

    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id',$this->lang->line('QUESTION'),'required');
        $this->form_validation->set_rules('answer',$this->lang->line('ANSWER'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

    public function get_list()
    {
        $questions = array();
        if($this->permissions['list'])
        {
            $questions = $this->Answer_create_model->get_question_list();
        }
        $this->jsonReturn($questions);
    }

}
