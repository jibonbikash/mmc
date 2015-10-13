<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_create extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('faq_management/Question_create');
        $this->controller_url='faq_management/Question_create';
        $this->load->model("faq_management/Question_create_model");

        $this->permissions['view']='';
    }

    public function index($action='list',$id=0)
    {
        $this->current_action=$action;

        if($action=='list')
        {
            $this->system_list();
        }
        elseif($action=='add')
        {
            $this->system_add();
        }
        elseif($action=='save')
        {
            $this->system_save();
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("faq_management/question_create/list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('faq_management/Question_create');
            $ajax['system_page_title']=$this->lang->line("QUESTION_CREATE");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function system_add()
    {
        if($this->permissions['add'])
        {
            $this->current_action='add';
            $ajax['status']=true;
            $data=array();

            $data['title'] = $this->lang->line("QUESTION_CREATE");
            $data['groups'] = $this->Question_create_model->get_question_user_groups();

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("faq_management/question_create/add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('faq_management/Question_create/index/add');
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
        else
        {
            if(!$this->permissions['add'])
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
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
                $this->jsonReturn($ajax);
            }
            else
            {
                $data = array();
                $user_id = $user->id;
                $uisc_id = $user->uisc_id;

                $data['uisc_id'] = $uisc_id;
                $data['user_id'] = $user_id;
                $data['question'] = $this->input->post('question');
                $data['user_type'] = $this->input->post('user_group');
                $data['create_by'] = $user_id;
                $data['create_date'] = time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->config->item('table_faqs'), $data);

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
        }
    }

    private function system_batch_details($id)
    {
        $this->current_action='batch_details';

        $data['title'] = $this->lang->line('QUESTION_DETAIL');
        $data['groups'] = $this->Question_create_model->get_question_user_groups();
        $data['faqs']=$this->Question_create_model->get_faq_detail($id);
        $ajax['status']=true;

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("faq_management/question_create/detail",$data,true));
        $this->jsonReturn($ajax);
    }

    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_group',$this->lang->line('USER_GROUP'),'required');
        $this->form_validation->set_rules('question',$this->lang->line('QUESTION'),'required');

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
            $questions = $this->Question_create_model->get_question_list();
        }
        $this->jsonReturn($questions);
    }

}
