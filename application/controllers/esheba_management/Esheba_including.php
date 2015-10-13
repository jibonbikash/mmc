<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esheba_including extends Root_Controller
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
        $this->permissions=Menu_helper::get_permission('esheba_management/Esheba_including');
        $this->controller_url='esheba_management/Esheba_including';
        $this->load->model("esheba_management/Esheba_including_model");
        $this->lang->load("esheba_management", $this->get_language());
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='add')
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

    private function system_add()
    {

        if($this->permissions['add'])
        {

            $this->current_action='add';
            $ajax['status']=true;
            $data=array();

            $data['title']=$this->lang->line("TITLE_ESHEBA_INCLUDING");

            //$data['ServiceInfo']=Query_helper::get_info($this->config->item('table_services'),'*',array());
            $data['ServiceInfo'] = $this->Esheba_including_model->get_service_list();
            $data['uisc_service_list'] = $this->Esheba_including_model->get_user_service_list();
            $data['uisc_services'] = $this->Esheba_including_model->get_user_services();
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("esheba_management/Esheba_including/add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('esheba_management/Esheba_including/index/add');
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

            $data['title']=$this->lang->line("TITLE_ESHEBA_INCLUDING");
            //$data['ServiceInfo']=Query_helper::get_info($this->config->item('table_services'),'*',array('service_id ='.$id),1);

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("esheba_management/Esheba_including/add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('esheba_management/Esheba_including/index/edit/'.$id);
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
        $uisc=User_helper::get_uisc_info();
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

            //$service_detail['createdby']=$user->id;
            $service_detail['created_time']=time();
            $service_detail['uisc_id']=$uisc->id;
            $service_detail['user_id']=$user->id;
            //$service_detail['status']=$this->config->item('SERVICES_STATUS_PROPOSED');

            $this->db->trans_start();  //DB Transaction Handle START

            $all_update['status']=$this->config->item('STATUS_INACTIVE');
            Query_helper::update($this->config->item('table_services_uisc'),$all_update,array("user_id = ".$user->id));

            $number_of_service=sizeof($this->input->post("service_id"));
            $service_id=$this->input->post('service_id');
            $uisc_service_id=$this->input->post('uisc_service_id');
            for($i=0; $i<$number_of_service; $i++)
            {
                $check_post=$service_id[$i];
                if($this->input->post($check_post))
                {
                    $uisc_service_post_id=$uisc_service_id[$i];
                    //                    $single_data['remaining']="'remaining'+1";
                    //                    Query_helper::update($this->config->item('table_services_uisc'),$single_data,array("user_id = ".$user->id, "service_id = ".$uisc_service_post_id));

                    $update_sql="update ".$this->config->item('table_services_uisc')." set remaining=remaining+1 where user_id='".$user->id."' AND service_id='$uisc_service_post_id'";
                    $this->db->query($update_sql);

                    $service_detail['service_id']=$check_post;
                    $service_detail['remaining']=1;
                    Query_helper::add($this->config->item('table_services_uisc'),$service_detail);
                }
            }
/*
            $number_of_own_service=sizeof($this->input->post("own_service_id"));
            $service_id=$this->input->post('service_id');
            $uisc_service_id=$this->input->post('uisc_service_id');
            for($i=0; $i<$number_of_service; $i++)
            {
                $check_post=$service_id[$i];
                if($this->input->post($check_post))
                {
                    $uisc_service_post_id=$uisc_service_id[$i];
                    //                    $single_data['remaining']="'remaining'+1";
                    //                    Query_helper::update($this->config->item('table_services_uisc'),$single_data,array("user_id = ".$user->id, "service_id = ".$uisc_service_post_id));

                    $update_sql="update ".$this->config->item('table_services_uisc')." set remaining=remaining+1 where user_id='".$user->id."' AND service_id='$uisc_service_post_id'";
                    $this->db->query($update_sql);

                    $service_detail['service_id']=$check_post;
                    $service_detail['remaining']=1;
                    Query_helper::add($this->config->item('table_services_uisc'),$service_detail);
                }
            }
*/
            //                $service_detail_uisc['uisc_id']=$user->id;
            //                $service_detail_uisc['service_id']=$service_last_id;
            //                $service_detail_uisc['user_id']=$user->id;
            //                $service_detail_uisc['created_time']=time();
            //                Query_helper::add($this->config->item('table_services_uisc'),$service_detail_uisc);

            $this->db->trans_complete();   //DB Transaction Handle END
            //die();
            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
                $this->system_add();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                $this->jsonReturn($ajax);
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
                Query_helper::update($this->config->item('table_services'),array('status'=>99,'update_by'=>$user->id,'update_date'=>time()),array("id = ".$id));
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

        //$this->load->library('form_validation');
        /*
        $table_name =$this->config->item('table_services');
        if (!$this->db->table_exists($table_name))
        {
            $this->message = $this->lang->line('TABLE_NOT_AVAILABLE');
            return false;
        }
        */
        //        if($this->Esheba_including_model->check_existence($this->input->post("service_detail[service_name]"),$this->input->post('id'), "service_name"))
        //        {
        //            $this->message = $this->lang->line('SERVICE_NAME_EXISTS');
        //            return false;
        //        }
        //
        //        $this->form_validation->set_rules('service_detail[service_name]',$this->lang->line('SERVICE_NAME'),'required');
        //        $this->form_validation->set_rules('service_detail[service_type]',$this->lang->line('SERVICE_TYPE'),'required');
        //        $this->form_validation->set_rules('service_detail[service_amount]',$this->lang->line('SERVICE_AMOUNT'),'required');
        //        $this->form_validation->set_rules('service_detail[website]',$this->lang->line('WEBSITE'),'required');

        //        if($this->form_validation->run() == FALSE)
        //        {
        //            $this->message=validation_errors();
        //            return false;
        //        }
        return true;
    }

}
