<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_create extends Root_Controller
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
        $this->permissions=Menu_helper::get_permission('notice_management/notice_create');
        $this->controller_url='notice_management/notice_create';
        $this->load->model("notice_management/notice_create_model");
        $this->lang->load("notice_management", $this->get_language());
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice_management/notice_create/list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('notice_management/notice_create');
            $ajax['system_page_title']=$this->lang->line("TITLE");
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

            $data['title']=$this->lang->line("NOTICE_CREATE_TITLE");

            $data['NoticeInfo'] = array
            (
                'id'=>'',
                'notice_title'=>'',
                'notice_details'=>'',
                'upload_file'=>'',
                'viewer_group_id'=>'',
                'status'=>$this->config->item('STATUS_ACTIVE'),
            );
            $data['notice_viewers']=array('');
            $data['user_groups']=$this->notice_create_model->get_user_group();
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice_management/notice_create/add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('notice_management/notice_create/index/add');
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

            $data['title']=$this->lang->line("NOTICE_CREATE_TITLE");
            $data['NoticeInfo']=Query_helper::get_info($this->config->item('table_notice'),'*',array('id ='.$id),1);
            $data['user_groups']=$this->notice_create_model->get_user_group();
            $data['notice_viewers']=$this->notice_create_model->get_notice_view_group($id);
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice_management/notice_create/add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('notice_management/notice_create/index/edit/'.$id);
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

            $notice_detail = $this->input->post('notice_detail');

            $dir = $this->config->item("dcms_upload");
            $uploaded = System_helper::upload_file($dir['notice'],1024,'gif|jpg|png|pdf');

            if(array_key_exists('upload_file',$uploaded))
            {
                if($uploaded['upload_file']['status'])
                {
                    $notice_detail['upload_file'] = $uploaded['upload_file']['info']['file_name'];
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['desk_message']=$this->message.=$uploaded['upload_file']['message'].'<br>';
                    $this->jsonReturn($ajax);
                }
            }

            if($this->input->post('public_notice') && $this->input->post('public_notice')==1)
            {
                $notice_detail['public_status'] = 1;
            }
            else
            {
                $notice_detail['public_status'] = 0;
            }

            if($id>0)
            {
                unset($notice_detail['id']);

                $notice_detail['update_by']=$user->id;
                $notice_detail['update_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_notice'),$notice_detail,array("id = ".$id));

                $notice_inactive['status']=$this->config->item('STATUS_INACTIVE');
                Query_helper::update($this->config->item('table_notice_view'),$notice_inactive,array("notice_id = ".$id));

                $user_group_id=$this->input->post('user_group_id');

                $count=sizeof($user_group_id);

                for($i=0; $i<$count; $i++)
                {
                    $check_box_elm="viewer_group_id_".$user_group_id[$i];

                    if($this->input->post($check_box_elm))
                    {
                        $check_box_id=$this->input->post($check_box_elm);
                        $notice_view_detail['viewer_group_id']=$check_box_id;
                        $notice_view_detail['create_group_id']=$user->user_group_id;
                        $notice_view_detail['notice_id']=$id;
                        $notice_view_detail['status']=$notice_detail['status'];

                        Query_helper::add($this->config->item('table_notice_view'),$notice_view_detail);
                    }
                }

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
                $notice_detail['create_by']=$user->id;
                $notice_detail['create_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                $notice_id=Query_helper::add($this->config->item('table_notice'),$notice_detail);

                $user_group_id=$this->input->post('user_group_id');
                $count=sizeof($user_group_id);

                for($i=0; $i<$count; $i++)
                {
                    $check_box_elm="viewer_group_id_".$user_group_id[$i];
                    if($this->input->post($check_box_elm))
                    {
                        $check_box_id=$this->input->post($check_box_elm);
                        $notice_view_detail['viewer_group_id']=$check_box_id;
                        $notice_view_detail['create_group_id']=$user->user_group_id;
                        $notice_view_detail['notice_id']=$notice_id;
                        $notice_view_detail['status']=$notice_detail['status'];
                        Query_helper::add($this->config->item('table_notice_view'),$notice_view_detail);
                    }
                }

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

        $this->load->library('form_validation');

        //        if($this->Esheba_create_model->check_existence($this->input->post("service_detail[service_name]"),$this->input->post('id'), "service_name"))
        //        {
        //            $this->message = $this->lang->line('SERVICE_NAME_EXISTS');
        //            return false;
        //        }
        //
        $this->form_validation->set_rules('notice_detail[notice_title]',$this->lang->line('NOTICE_TITLE'),'required');
        $this->form_validation->set_rules('notice_detail[status]',$this->lang->line('STATUS'),'required');


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
            $divisions = $this->notice_create_model->get_record_list();
        }
        $this->jsonReturn($divisions);
    }



}
