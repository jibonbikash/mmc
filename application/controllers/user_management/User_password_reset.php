<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_password_reset extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('user_management/User_password_reset');
        $this->controller_url='user_management/User_password_reset';
        $this->load->model("user_management/User_password_reset_model");
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='list')
        {
            $this->dcms_list();
        }
        elseif($action=='add')
        {
            $this->dcms_add();
        }
        elseif($action=='edit')
        {
            $this->dcms_edit($id);
        }
        elseif($action=='save')
        {
            $this->dcms_save();
        }
        else
        {
            $this->current_action='list';
            $this->dcms_list();
        }
    }

    private function dcms_list()
    {
        if($this->permissions['list'])
        {
            $this->current_action='list';
            $ajax['status']=true;

            $user = User_helper::get_user();

            $div_post = $this->input->post('division');
            $zilla_post = $this->input->post('zilla');
            $upazilla_post = $this->input->post('upazilla');

            if($user->user_group_id == $this->config->item('DIVISION_GROUP_ID') && $div_post == '')
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("SELECT_DIVISION");
                $this->jsonReturn($ajax);
            }
            elseif($user->user_group_id == $this->config->item('DISTRICT_GROUP_ID') && $zilla_post == '')
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("SELECT_DISTRICT");
                $this->jsonReturn($ajax);
            }
            elseif($user->user_group_id == $this->config->item('UPAZILLA_GROUP_ID') && $upazilla_post == '')
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("SELECT_UPAZILLA");
                $this->jsonReturn($ajax);
            }
            else
            {
                $session_data['userInfo'] = $this->input->post();
                $this->session->set_userdata($session_data);

                $ajax['system_content'][]=array("id"=>"#load_list","html"=>$this->load_view("user_management/user_password_reset/dcms_list",'',true));

                if($this->message)
                {
                    $ajax['system_message']=$this->message;
                }

                $ajax['system_page_url']=$this->get_encoded_url('user_management/User_password_reset');
                $ajax['system_page_title']=$this->lang->line("USER_PASSWORD_RESET");
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_add()
    {
        if($this->permissions['add'])
        {
            $this->current_action='add';
            $ajax['status']=true;
            $data=array();

            $data['divisions'] = $this->User_password_reset_model->get_divisions_by_user();
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_management/user_password_reset/dcms_search",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('user_management/user_password_reset/index/add');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_edit($id)
    {
        $data['password_detail'] = $this->User_password_reset_model->get_password_detail($id);
        $data['questions'] = Query_helper::get_info($this->config->item('table_questions'),array('id value','question text'),array('status = 1'));

        if($this->permissions['edit'])
        {
            if($data['password_detail'])
            {
                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#modal_data","html"=>$this->load_view("user_management/user_password_reset/dcms_edit",$data,true));
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#modal_data","html"=>'',array(),true);
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_save()
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

            if($userDetail['ques_id']=='')
            {
                unset($userDetail['ques_id']);
                unset($userDetail['ques_ans']);
            }
        }

        if($id>0)
        {
            $userDetail['update_by']=$user->id;
            $userDetail['update_date']=time();

            $this->db->trans_start();  //DB Transaction Handle START

            Query_helper::update($this->config->item('table_users'),$userDetail,array("id = ".$id));
            // Mail Function
            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
                $save_and_new=$this->input->post('system_save_new_status');
                if($save_and_new==1)
                {
                    $this->dcms_list();
                }
                else
                {
                    $this->dcms_list();
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

    public function get_users()
    {
        $session_data = $this->session->userdata('userInfo');
        $passwords = array();

        if($this->permissions['list'])
        {
            $uisc_type = isset($session_data['uisc_type'])?$session_data['uisc_type']:0;
            $division = isset($session_data['division'])?$session_data['division']:0;
            $zilla = isset($session_data['zilla'])?$session_data['zilla']:0;
            $upazilla = isset($session_data['upazilla'])?$session_data['upazilla']:0;
            $municipal = isset($session_data['municipal'])?$session_data['municipal']:0;
            $municipalward = isset($session_data['municipalward'])?$session_data['municipalward']:0;
            $citycorporation = isset($session_data['citycorporation'])?$session_data['citycorporation']:0;
            $citycorporationward = isset($session_data['citycorporationward'])?$session_data['citycorporationward']:0;
            $union = isset($session_data['union'])?$session_data['union']:0;
            $user_id = isset($session_data['user_id'])?$session_data['user_id']:0;
        }

        $passwords = $this->User_password_reset_model->get_users($uisc_type, $division, $zilla, $upazilla, $municipal, $municipalward, $citycorporation, $citycorporationward, $union, $user_id);
        $this->session->unset_userdata('userInfo');
        $this->jsonReturn($passwords);
    }

    public function get_zilla()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $division_id=$this->input->post('division_id');

        if($user_group_id == $this->config->item('DISTRICT_GROUP_ID') || $user_group_id == $this->config->item('UPAZILLA_GROUP_ID') || $user_group_id == $this->config->item('UNION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID') || $user_group_id == $this->config->item('UISC_GROUP_ID'))
        {
            $zillas = Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id, 'zillaid = '.$user->zilla));
        }
        else
        {
            $zillas = Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
        }

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_zilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$zillas),true));
        $this->jsonReturn($ajax);
    }

    public function get_upazila()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;
        $zilla_id=$this->input->post('zilla_id');

        if($user_group_id == $this->config->item('UPAZILLA_GROUP_ID') || $user_group_id == $this->config->item('UNION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID') || $user_group_id == $this->config->item('UISC_GROUP_ID'))
        {
            $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'upazilaid = '.$user->upazila));
        }
        else
        {
            $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        }

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_upazila_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$upazilas),true));
        $this->jsonReturn($ajax);
    }

    public function get_union()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $zilla_id=$this->input->post('zilla_id');
        $upazila_id=$this->input->post('upazila_id');
        $unions=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'upazilaid='.$upazila_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_unioun_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$unions),true));
        $this->jsonReturn($ajax);
    }

    public function get_city_corporation()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $division_id=$this->input->post('division_id');
        $zilla_id=$this->input->post('zilla_id');

        if($user_group_id == $this->config->item('UPAZILLA_GROUP_ID') || $user_group_id == $this->config->item('UNION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID') || $user_group_id == $this->config->item('UISC_GROUP_ID'))
        {
            $city_corporations=Query_helper::get_info($this->config->item('table_city_corporations'),array('citycorporationid value', 'citycorporationname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'divid='.$division_id, 'citycorporationid = '.$user->citycorporation));
        }
        else
        {
            $city_corporations=Query_helper::get_info($this->config->item('table_city_corporations'),array('citycorporationid value', 'citycorporationname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'divid='.$division_id));
        }

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_citycorporation_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$city_corporations),true));
        $this->jsonReturn($ajax);
    }

    public function get_city_corporation_word()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $division_id=$this->input->post('division_id');
        $zilla_id=$this->input->post('zilla_id');
        $city_corporation_id=$this->input->post('city_corporation_id');
        $city_corporation_words=Query_helper::get_info($this->config->item('table_city_corporation_wards'),array('citycorporationwardid value', 'wardname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'divid='.$division_id, 'citycorporationid = '.$city_corporation_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_city_corporation_ward_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$city_corporation_words),true));
        $this->jsonReturn($ajax);
    }

    public function get_municipal()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $zilla_id=$this->input->post('zilla_id');

        if($user_group_id == $this->config->item('UPAZILLA_GROUP_ID') || $user_group_id == $this->config->item('UNION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID') || $user_group_id == $this->config->item('UISC_GROUP_ID'))
        {
            $municipals=Query_helper::get_info($this->config->item('table_municipals'),array('municipalid value', 'municipalname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'municipalid = '.$user->municipal));
        }
        else
        {
            $municipals=Query_helper::get_info($this->config->item('table_municipals'),array('municipalid value', 'municipalname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        }

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_municipal_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$municipals),true));
        $this->jsonReturn($ajax);
    }

    public function get_municipal_ward()
    {
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $zilla_id=$this->input->post('zilla_id');
        $municipal_id=$this->input->post('municipal_id');
        $municipal_wards=Query_helper::get_info($this->config->item('table_municipal_wards'),array('wardid value', 'wardname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'municipalid = '.$municipal_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_municipal_ward_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$municipal_wards),true));
        $this->jsonReturn($ajax);
    }


}
