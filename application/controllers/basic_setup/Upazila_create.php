<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upazila_create extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('basic_setup/Upazila_create');
        $this->controller_url='basic_setup/Upazila_create';
        $this->load->model("basic_setup/Upazila_create_model");
        $this->lang->load("basic_setup", $this->get_language());
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("basic_setup/Upazila_create/list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('basic_setup/Upazila_create');
            $ajax['system_page_title']=$this->lang->line("UPAZILA_CREATE_TITLE");
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

            $data['title']=$this->lang->line("UPAZILA_CREATE_TITLE");

            $data['UpazilaInfo'] = array
            (
                'id'=>0,
                'upazilaid'=>'',
                'upazilaname'=>'',
                'upazilanameeng'=>'',
                'zillaid'=>'',
                'divid'=>'',
                'visible'=>1,
            );
            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("basic_setup/Upazila_create/add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('basic_setup/Upazila_create/index/add');
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

            $data['title']=$this->lang->line("UPAZILA_CREATE_TITLE");

            $data['UpazilaInfo']=Query_helper::get_info($this->config->item('table_zillas'),'*',array('id ='.$id),1);

            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("basic_setup/Upazila_create/add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('basic_setup/Upazila_create/index/edit/'.$id);
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
            $upazila_detail = $this->input->post('upazila_detail');
            unset($upazila_detail['divid']);

            if($id>0)
            {
                //$upazila_detail['update_by']=$user->id;
                //$upazila_detail['update_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_upazilas'),$upazila_detail,array("id = ".$id));

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
                //$upazila_detail['create_by']=$user->id;
                //$upazila_detail['create_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->config->item('table_upazilas'),$upazila_detail);

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

    private function system_batch_delete()
    {
        if($this->permissions['delete'])
        {
            $user=User_helper::get_user();
            $selected_ids=$this->input->post('selected_ids');
            $this->db->trans_start();  //DB Transaction Handle START
            foreach($selected_ids as $id)
            {
                Query_helper::update($this->config->item('table_divisions'),array('status'=>99,'update_by'=>$user->id,'update_date'=>time()),array("id = ".$id));
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
        /*
        $table_name =$this->config->item('table_divisions');
        if (!$this->db->table_exists($table_name))
        {
            $this->message = $this->lang->line('TABLE_NOT_AVAILABLE');
            return false;
        }
        */
        //        if($this->Upazila_create_model->check_existence($this->input->post("zilla_detail[zillaname]"),$this->input->post('divid'), "zillaname"))
        //        {
        //            $this->message = $this->lang->line('ZILLA_NAME_BN_EXISTS');
        //            return false;
        //        }

        $this->form_validation->set_rules('upazila_detail[divid]',$this->lang->line('DIVISION_NAME'),'required');
        $this->form_validation->set_rules('upazila_detail[zillaid]',$this->lang->line('ZILLA_NAME_BN'),'required');
        $this->form_validation->set_rules('upazila_detail[upazilaname]',$this->lang->line('UPAZILA_NAME_BN'),'required');
        $this->form_validation->set_rules('upazila_detail[upazilanameeng]',$this->lang->line('UPAZILA_NAME_EN'),'required');
        $this->form_validation->set_rules('upazila_detail[upazilaid]',$this->lang->line('GO_CODE'),'required');
        $this->form_validation->set_rules('upazila_detail[visible]',$this->lang->line('STATUS'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }



    public function get_list()
    {
        $divisions = array();
        if($this->permissions['list'])
        {
            $divisions = $this->Upazila_create_model->get_record_list();
        }
        $this->jsonReturn($divisions);
    }



}
