<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('user_group/User_role');
        if($this->permissions)
        {
            $this->permissions['add']=0;
            $this->permissions['delete']=0;
            $this->permissions['view']=0;
        }


        $this->controller_url='user_group/User_role';
        $this->load->model("user_group/User_role_model");
    }
    public function index($action='list',$id=0)
    {
        $this->current_action=$action;

        if($action=='list')
        {
            $this->system_list();
        }
        elseif($action=='batch_edit')
        {
            $this->system_batch_edit();
        }
        elseif($action=='edit')
        {
            $this->system_edit($id);
        }

        elseif($action=='save')
        {
            $this->system_save();
        }
        /*elseif($action=='batch_details')
        {
            $this->system_batch_details();
        }
        */
        else
        {
            $this->current_action='list';
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_group/user_role/system_list","",true));


            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('user_group/User_role');
            $ajax['system_page_title']=$this->lang->line("USER_ROLE_SETUP");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }

    }

    private function system_edit($id)
    {
        if($this->permissions['edit'])
        {
            $this->current_action='edit';
            $ajax['status']=true;
            $data=array();
            $data['title']=$this->lang->line("EDIT_USER_ROLE");
            $data['role_status']=$this->User_role_model->get_role_status($id);
            $data['access_tasks']=$this->User_role_model->get_my_tasks($id);
            $data['id']=$id;
            //$data['component_info']=Query_helper::get_info($this->config->item('table_component'),'*',array('id ='.$id),1);

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_group/user_role/system_add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('user_group/user_role/index/edit/'.$id);
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_batch_edit()
    {
        $selected_ids=$this->input->post('selected_ids');
        $this->system_edit($selected_ids[0]);
    }
    private function system_save()
    {
        $user=User_helper::get_user();
        $id = $this->input->post("id");
        if(!$this->permissions['edit'])
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
            die();
        }

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $tasks=$this->input->post('tasks');
            $user_group_id=$this->input->post('id');
            $time=time();
            $this->db->trans_start();  //DB Transaction Handle START

            foreach($tasks as $task)
            {

                $data=array();

                if(isset($task['list'])&& ($task['list']==1))
                {
                    $data['list']=1;
                }
                else
                {
                    $data['list']=0;
                }
                if(isset($task['view'])&& ($task['view']==1))
                {
                    $data['view']=1;
                }
                else
                {
                    $data['view']=0;
                }
                if(isset($task['add'])&& ($task['add']==1))
                {
                    $data['add']=1;
                }
                else
                {
                    $data['add']=0;
                }
                if(isset($task['edit'])&& ($task['edit']==1))
                {
                    $data['edit']=1;
                }
                else
                {
                    $data['edit']=0;
                }
                if(isset($task['delete'])&& ($task['delete']==1))
                {
                    $data['delete']=1;
                }
                else
                {
                    $data['delete']=0;
                }
                if(isset($task['report'])&& ($task['report']==1))
                {
                    $data['report']=1;
                }
                else
                {
                    $data['report']=0;
                }
                if(isset($task['print'])&& ($task['print']==1))
                {
                    $data['print']=1;
                }
                else
                {
                    $data['print']=0;
                }
                if(($data['view'])||($data['add'])||($data['edit'])||($data['delete'])||($data['report'])||($data['print']))
                {
                    $data['list']=1;
                }
                if($task['ugr_id']>0)
                {
                    $data['update_by']=$user->id;
                    $data['update_date']=$time;
                    Query_helper::update($this->config->item('table_user_group_role'),$data,array("id = ".$task['ugr_id']));
                }
                else
                {
                    $data['user_group_id']=$user_group_id;
                    $data['component_id']=$task['component_id'];
                    $data['module_id']=$task['module_id'];
                    $data['task_id']=$task['task_id'];
                    $data['create_by']=$user->id;
                    $data['create_date']=$time;
                    Query_helper::add($this->config->item('table_user_group_role'),$data);
                }

            }
            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_ROLE_ASSIGN_SUCCESS");
                $this->system_list();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_ROLE_ASSIGN_FAIL");
                $this->jsonReturn($ajax);
            }
        }

    }
    /*private function system_batch_details()
    {
        if($this->permissions['view'])
        {
            $this->current_action='batch_details';
            $selected_ids=$this->input->post('selected_ids');
            $data['components']=$this->Component_model->get_component_details($selected_ids);
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("system_setup/component/system_details",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_batch_delete()
    {
        if($this->permissions['delete'])
        {
            $user=User_helper::get_user();
            $selected_ids=$this->input->post('selected_ids');
            $this->db->trans_start();  //DB Transaction Handle START
            foreach($selected_ids as $id)
            {
                Query_helper::update($this->config->item('table_component'),array('status'=>99,'update_by'=>$user->id,'update_date'=>time()),array("id = ".$id));
            }
            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_DELETE_SUCCESS");
                $this->system_list();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_DELETE_FAIL");
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    */
    private function check_validation()
    {
        //no validation checking at this stage
        return true;
    }

    public function get_roles_info()
    {
        $roles=array();
        if($this->permissions['list'])
        {
            $roles= $this->User_role_model->get_roles_info();
        }
        $this->jsonReturn($roles);

    }

}
