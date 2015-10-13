<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile_update extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('profile/User_profile_update');
        $this->controller_url='profile/User_profile_update';
        $this->load->model("profile/User_profile_update_model");
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

            $data['title']=$this->lang->line("PASSWORD_CHANGE");
            $data['userInfo']=Query_helper::get_info($this->config->item('table_users'),'*',array('id ='.$id),1);
            $data['groups']=Query_helper::get_info($this->config->item('table_user_group'),array('id value','name_'.$this->get_language_code().' text'),array('status !=99'));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("profile/user_profile_update/system_add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('profile/user_profile_update/index/edit/'.$id);
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
                if($userDetail['password']!="")
                {
                    $encryptPass = md5($userDetail['password']);
                    unset($userDetail['password']);
                    unset($userDetail['confirm_password']);
                    $userDetail['password'] = $encryptPass;
                }
                else
                {
                    unset($userDetail['password']);
                    unset($userDetail['confirm_password']);
                }
            }
            else
            {
                $encryptPass = md5($userDetail['password']);
                unset($userDetail['password']);
                unset($userDetail['confirm_password']);
                $userDetail['password'] = $encryptPass;
            }

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
        if($this->User_profile_update_model->check_username_existence($this->input->post("user_detail[username]"),$this->input->post('id')))
        {
            $this->message = $this->lang->line('USERNAME_EXISTS');
            return false;
        }

        $this->load->library('form_validation');
        $user_table =$this->config->item('table_users');

        if (!$this->db->table_exists($user_table))
        {
            $this->message = $this->lang->line('USER_TABLE_NOT_AVAILABLE');
            return false;
        }

        $this->form_validation->set_rules('user_detail[name_bn]',$this->lang->line('NAME_BN'),'required');
        $this->form_validation->set_rules('user_detail[username]',$this->lang->line('USER_NAME'),'required');
        //$this->form_validation->set_rules('user_detail[password]',$this->lang->line('PASSWORD'),'required');
        //$this->form_validation->set_rules('user_detail[confirm_password]',$this->lang->line('PASSWORD'),'required');
        $this->form_validation->set_rules('user_detail[email]',$this->lang->line('EMAIL'),'required|valid_email');
        $this->form_validation->set_rules('user_detail[mobile]',$this->lang->line('MOBILE_NUMBER'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

}
