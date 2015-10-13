<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions = Menu_helper::get_permission('system_setup/Task');
        $this->controller_url = 'system_setup/Task';
        $this->load->model("system_setup/Task_model");
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
        elseif($action=='batch_details')
        {
            $this->system_batch_details();
        }
        elseif($action=='batch_delete')
        {
            $this->system_batch_delete();
        }
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("system_setup/task/system_list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('system_setup/task');
            $ajax['system_page_title']=$this->lang->line("TASK_SETUP");
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
            $data['title']=$this->lang->line("CREATE_NEW_TASK");
            $data['task_info']['id']=0;
            $data['task_info']['component_id']='';
            $data['task_info']['module_id']='';
            $data['task_info']['controller']='';
            $data['task_info']['name_en']='';
            $data['task_info']['name_bn']='';
            $data['task_info'][$this->config->item('system_sidebar01')]=1;
            $data['task_info'][$this->config->item('system_sidebar02')]=1;
            $data['task_info']['icon']='';
            $data['task_info']['description']='';
            $data['task_info']['ordering']=1;
            $data['task_info']['status']=1;
            $data['components_list']=Query_helper::get_info($this->config->item('table_component'),array('id value','name_'.$this->get_language_code().' text'),array('status !=99'));
            $data['module_list']=array();

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("system_setup/task/system_add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('system_setup/task/index/add');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
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
            $data['title']=$this->lang->line("EDIT_TASK");
            $data['task_info']=Query_helper::get_info($this->config->item('table_task'),'*',array('id ='.$id,'status !=99'),1);
            $data['components_list']=Query_helper::get_info($this->config->item('table_component'),array('id value','name_'.$this->get_language_code().' text'),array('status !=99'));
            $data['module_list']=Query_helper::get_info($this->config->item('table_module'),array('id value','name_'.$this->get_language_code().' text'),array('status !=99','component_id ='.$data['task_info']['component_id']));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("system_setup/task/system_add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('system_setup/task/index/edit/'.$id);
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
            //$data['task_info'][$this->config->item('system_sidebar01')]=1;
            //$data['task_info'][$this->config->item('system_sidebar02')]=1;
            $data = Array(
                'name_en'=>$this->input->post('name_en'),
                'name_bn'=>$this->input->post('name_bn'),
                'component_id'=>$this->input->post('component_id'),
                'module_id'=>$this->input->post('module_id'),
                'controller'=>$this->input->post('controller'),
                'icon'=>$this->input->post('icon'),
                $this->config->item('system_sidebar01')=>$this->input->post($this->config->item('system_sidebar01')) ? 1:0,
                $this->config->item('system_sidebar02')=>$this->input->post($this->config->item('system_sidebar02')) ? 1:0,
                'description'=>$this->input->post('description'),
                'status'=>$this->input->post('status'),
                'ordering'=>$this->input->post('ordering')
            );
//            print_r($data);
//            die();
            if($id>0)
            {
                $data['update_by']=$user->id;
                $data['update_date']=time();
                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_task'),$data,array("id = ".$id));
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
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
                    $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
                    $this->jsonReturn($ajax);

                }
            }
            else
            {
                $data['create_by']=$user->id;
                $data['create_date']=time();
                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_task'),$data);
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
    private function system_batch_details()
    {
        if($this->permissions['view'])
        {
            $this->current_action='batch_details';
            $selected_ids=$this->input->post('selected_ids');
            $data['tasks']=$this->Task_model->get_task_details($selected_ids);
            $ajax['status']=true;

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("system_setup/task/system_details",$data,true));
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
                Query_helper::update($this->config->item('table_task'),array('status'=>99,'update_by'=>$user->id,'update_date'=>time()),array("id = ".$id));
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
    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_en',$this->lang->line('NAME_EN'),'required');
        $this->form_validation->set_rules('name_bn',$this->lang->line('NAME_BN'),'required');
        $this->form_validation->set_rules('component_id',$this->lang->line('COMPONENT_NAME'),'required');
        $this->form_validation->set_rules('module_id',$this->lang->line('MODULE_NAME'),'required');
        $this->form_validation->set_rules('controller',$this->lang->line('CONTROLLER'),'required');
        $this->form_validation->set_rules('ordering',$this->lang->line('ORDERING'),'integer|max_length[3]');
        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
    public function get_tasks()
    {
        $tasks=array();
        if($this->permissions['list'])
        {
            $tasks=$this->Task_model->get_tasks();

        }
        $this->jsonReturn($tasks);


    }
    public function get_modules_by_component_id()
    {
        $component_id=$this->input->post('component_id');
        $modules=Query_helper::get_info($this->config->item('table_module'),array('id value','name_'.$this->get_language_code().' text'),array('component_id = '.$component_id,'status !=99'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#module_options","html"=>$this->load_view("dropdown",array('drop_down_options'=>$modules),true));
        $this->jsonReturn($ajax);

    }

}
