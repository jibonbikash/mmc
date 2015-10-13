<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class system_Keyword extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('system_setup/system_keyword');
        $this->controller_url='system_setup/system_keyword';
        $this->load->model("system_setup/system_keyword_model");
        $this->config->load('key_config');
        $this->permissions['view']='';
        $this->permissions['delete']='';
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
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load_view("system_setup/system_keyword/system_list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('system_setup/system_keyword');
            $ajax['system_page_title']=$this->lang->line("KEYWORD_SETUP");
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
            $data['title']=$this->lang->line("CREATE_NEW_KEYWORD");

            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load_view("system_setup/system_keyword/system_add",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('system_setup/system_keyword/index/add');
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
            $data['title']=$this->lang->line("EDIT_KEYWORD");

            $data['keywordDetail']=Query_helper::get_info($this->config->item('table_system_keyword'),'*',array('id ='.$id,'status !=99'),1);

            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load_view("system_setup/system_keyword/system_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('system_setup/system_keyword/index/edit/'.$id);
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

        $data = $this->input->post('key');
        $keyConfig = $this->config->item('KEY_TYPE');

        if($id>0)
        {
            if(!$this->permissions['edit'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            if(!$this->permissions['add'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
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
            if($data['parent']==$keyConfig['CAMPUS'] || $data['parent']==$keyConfig['SESSION'])
            {
                $data['description'] = json_encode($this->input->post('description'));
            }

            if($id>0)
            {
                $data['update_by']=$user->id;
                $data['update_date']=time();
                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_system_keyword'),$data,array("id = ".$id));
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
                Query_helper::add($this->config->item('table_system_keyword'),$data);
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

    private function system_batch_edit()
    {
        $selected_ids=$this->input->post('selected_ids');
        $this->system_edit($selected_ids[0]);
    }

    private function check_validation()
    {
        $post = $this->input->post('description');
        if(isset($post['primary']))
        {
            if($this->system_keyword_model->check_main_campus_existence())
            {
                $this->message = $this->lang->line('MAIN_CAMPUS_EXISTS');
                return false;
            }
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('key[parent]',$this->lang->line('KEYWORD_TYPE'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }

        return true;
    }

    public function get_system_keywords()
    {
        $keyword=array();
        if($this->permissions['list'])
        {
            $keyword=$this->system_keyword_model->get_system_keywords();

        }
        $this->jsonReturn($keyword);
    }

    public function ajax_type()
    {
        $keyConfig = $this->config->item('KEY_TYPE');

        $type = $this->input->post('type');

        if($type == $keyConfig['MEDIUM'])
        {
            $data['title'] = $this->lang->line('NEW_MEDIUM');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/medium_add_edit",$data,true));
        }
        elseif($type == $keyConfig['VERSION'])
        {
            $data['title'] = $this->lang->line('NEW_VERSION');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/version_add_edit",$data,true));
        }
        elseif($type == $keyConfig['SHIFT'])
        {
            $data['title'] = $this->lang->line('NEW_SHIFT');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/shift_add_edit",$data,true));
        }
        elseif($type == $keyConfig['DEPARTMENT'])
        {
            $data['title'] = $this->lang->line('NEW_DEPARTMENT');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/department_add_edit",$data,true));
        }
        elseif($type == $keyConfig['GROUP'])
        {
            $data['title'] = $this->lang->line('NEW_GROUP');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/group_add_edit",$data,true));
        }
        elseif($type == $keyConfig['FACULTY'])
        {
            $data['title'] = $this->lang->line('NEW_FACULTY');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/group_add_edit",$data,true));
        }
        elseif($type == $keyConfig['DEGREE'])
        {
            $data['title'] = $this->lang->line('NEW_DEGREE');
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/degree_add_edit",$data,true));
        }
        elseif($type == $keyConfig['SESSION'])
        {
            $data['title'] = $this->lang->line('NEW_SESSION');
            $description['description_en'] = '';
            $description['description_bn'] = '';
            $data['description'] = json_encode($description);
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/session_add_edit",$data,true));
        }
        elseif($type == $keyConfig['CAMPUS'])
        {
            $data['title'] = $this->lang->line('NEW_CAMPUS');
            $description['description_en'] = '';
            $description['description_bn'] = '';
            $description['address'] = '';
            $description['phone'] = '';
            $description['primary'] = '';
            $data['description'] = json_encode($description);
            $data['status'] = 1;
            $ajax['system_content'][]=array("id"=>"#view_container","html"=>$this->load_view("system_setup/system_keyword/campus_add_edit",$data,true));
        }
        else
        {
            $ajax['system_message']=$this->lang->line("UNDER_CONSTRUCTION");
            $this->jsonReturn($ajax);
        }

        $this->jsonReturn($ajax);
    }

}
