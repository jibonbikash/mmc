<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secret_question_change extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('profile/Secret_question_change');
        $this->controller_url='profile/Secret_question_change';
        $this->load->model("profile/Secret_question_change_model");
        $this->lang->load("user_create", $this->get_language());
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
        if($this->permissions['edit'])
        {
            $user = User_helper::get_user();
            $id = $user->id;
            $this->current_action = 'edit';
            $ajax['status'] = true;
            $data = array();

            $data['title']=$this->lang->line("SECRET_QUESTION_CHANGE");
            $data['userInfo']=Query_helper::get_info($this->config->item('table_users'),'*',array('id ='.$id),1);
            $data['questions'] = Query_helper::get_info($this->config->item('table_questions'),array('id value','question text'),array('status = 1'));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("profile/secret_question_change/system_add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('profile/secret_question_change/index/edit/'.$id);
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
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
            $userDetail = $this->input->post('user_detail');

            if($id>0)
            {
                $userDetail['update_by']=$user->id;
                $userDetail['update_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_users'),$userDetail,array("id = ".$id));

                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
                    $save_and_new=$this->input->post('system_save_new_status');
                    if($save_and_new==1)
                    {
                        $this->system_edit();
                    }
                    else
                    {
                        $this->system_edit();
                    }
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
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

    private function check_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_detail[ques_id]',$this->lang->line('SECRET_QUESTION'),'required');
        $this->form_validation->set_rules('user_detail[ques_ans]',$this->lang->line('ANSWER'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

}
