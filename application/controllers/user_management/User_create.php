<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_create extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('user_management/User_create');
        $this->controller_url='user_management/User_create';
        $this->load->model("user_management/User_create_model");
        $this->lang->load("user_create", $this->get_language());
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
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_management/user_create/system_list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('user_management/User_create');
            $ajax['system_page_title']=$this->lang->line("USER_CREATE");
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

            $data['title']=$this->lang->line("CREATE_NEW_USER");

            $data['userInfo'] = array
            (
                'id'=>'',
                'username'=>'',
                'password'=>'',
                'name_bn'=>'',
                'division'=>'',
                'zilla'=>'',
                'upazila'=>'',
                'unioun'=>'',
                'citycorporation'=>'',
                'citycorporationward'=>'',
                'municipal'=>'',
                'municipalward'=>'',
                'mobile'=>'',
                'email'=>'',
            );

            $data['groups']=Query_helper::get_info($this->config->item('table_user_group'),array('id value','name_'.$this->get_language_code().' text'),array('status !=99'), 12);
            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_management/user_create/system_add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('user_management/user_create/index/add');
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

            $data['title']=$this->lang->line("EDIT_USER");
            $data['userInfo']=Query_helper::get_info($this->config->item('table_users'),'*',array('id ='.$id),1);

            $user_group_id = $data['userInfo']['user_group_id'];
            $division_id = $data['userInfo']['division'];
            $zilla_id = $data['userInfo']['zilla'];
            $upazila_id = $data['userInfo']['upazila'];
            //$unioun_id = $data['userInfo']['unioun'];
            $city_corporation_id = $data['userInfo']['citycorporation'];
            //$city_corporation_ward_id = $data['userInfo']['citycorporationward'];
            $municipal_id = $data['userInfo']['municipal'];
            //$municipal_ward_id = $data['userInfo']['municipalward'];

            $data['groups']=Query_helper::get_info($this->config->item('table_user_group'),array('id value','name_'.$this->get_language_code().' text'),array('status !=99'), 12);
            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
            $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
            $data['upazilas']=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
            $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'upazilaid='.$upazila_id));
            $data['city_corporations']=Query_helper::get_info($this->config->item('table_city_corporations'),array('citycorporationid value', 'citycorporationname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'divid='.$division_id));
            $data['city_corporation_words']=Query_helper::get_info($this->config->item('table_city_corporation_wards'),array('citycorporationwardid value', 'wardname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'divid='.$division_id, 'citycorporationid = '.$city_corporation_id));
            $data['municipals']=Query_helper::get_info($this->config->item('table_municipals'),array('municipalid value', 'municipalname text'), array('visible = 1', 'zillaid = '.$zilla_id));
            $data['municipal_wards']=Query_helper::get_info($this->config->item('table_municipal_wards'),array('wardid value', 'wardname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'municipalid = '.$municipal_id));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_management/user_create/system_add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('user_management/user_create/index/edit/'.$id);
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


            if($this->input->post("user_detail[user_group_id]") == $this->config->item('SUPER_ADMIN_GROUP_ID') || $this->input->post("user_detail[user_group_id]")== $this->config->item('A_TO_I_GROUP_ID') || $this->input->post("user_detail[user_group_id]")== $this->config->item('DONOR_GROUP_ID') || $this->input->post("user_detail[user_group_id]")== $this->config->item('MINISTRY_GROUP_ID'))
            {
                $userDetail['division']='';
                $userDetail['zilla']='';
                $userDetail['upazila']='';
                $userDetail['unioun']='';
                $userDetail['citycorporation']='';
                $userDetail['citycorporationward']='';
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('DIVISION_GROUP_ID'))
            {
                $userDetail['zilla']='';
                $userDetail['upazila']='';
                $userDetail['unioun']='';
                $userDetail['citycorporation']='';
                $userDetail['citycorporationward']='';
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('DISTRICT_GROUP_ID'))
            {
                $userDetail['upazila']='';
                $userDetail['unioun']='';
                $userDetail['citycorporation']='';
                $userDetail['citycorporationward']='';
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('UPAZILLA_GROUP_ID'))
            {
                $userDetail['unioun']='';
                $userDetail['citycorporation']='';
                $userDetail['citycorporationward']='';
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('UNION_GROUP_ID'))
            {
                $userDetail['citycorporation']='';
                $userDetail['citycorporationward']='';
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('CITY_CORPORATION_GROUP_ID'))
            {
                $userDetail['citycorporationward']='';
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'))
            {
                $userDetail['municipal']='';
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('MUNICIPAL_GROUP_ID'))
            {
                $userDetail['municipalward']='';
                $userDetail['uisc_id']=0;
            }
            else if($this->input->post("user_detail[user_group_id]") == $this->config->item('MUNICIPAL_WORD_GROUP_ID'))
            {
                $userDetail['uisc_id']=0;
            }

            //            $dir=$this->config->item("system_upload");
            //            $uploaded_img = System_helper::upload_file($dir['user'],10240,'jpg|jpeg|png');
            //
            //            if(is_array($uploaded_img) && sizeof($uploaded_img)>0)
            //            {
            //                foreach($uploaded_img as $img)
            //                {
            //                    $userDetail['picture_name'] = $img['info']['file_name'];
            //                }
            //            }
            //            else
            //            {
            //                $userDetail['picture_name'] = 'no_image.jpg';
            //            }

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
                $userDetail['create_by']=$user->id;
                $userDetail['create_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->config->item('table_users'),$userDetail);

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
                Query_helper::update($this->config->item('table_users'),array('status'=>99,'update_by'=>$user->id,'update_date'=>time()),array("id = ".$id));
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
        if($this->User_create_model->check_username_existence($this->input->post("user_detail[username]"),$this->input->post('id')))
        {
            $this->message = $this->lang->line('USERNAME_EXISTS');
            return false;
        }

        if($this->input->post("id")>0)
        {
            //            if($this->input->post("user_detail[password]") !="" && $this->input->post("user_detail[confirm_password]")=="")
            //            {
            //                $this->form_validation->set_rules('user_detail[confirm_password]',$this->lang->line('CONFIRM_PASSWORD'),'required');
            //            }
            //            if($this->input->post("user_detail[password]") != $this->input->post("user_detail[confirm_password]"))
            //            {
            //                $this->message = $this->lang->line('PASSWORD_NOT_MATCH');
            //                return false;
            //            }
        }
        else
        {
            //            if($this->input->post("user_detail[password]")=="")
            //            {
            //                $this->form_validation->set_rules('user_detail[password]',$this->lang->line('PASSWORD'),'required');
            //            }
            //            else if($this->input->post("user_detail[password]") != $this->input->post("user_detail[confirm_password]"))
            //            {
            //                $this->message = $this->lang->line('PASSWORD_NOT_MATCH');
            //                return false;
            //            }
            //            else
            //            {
            //                  return true;
            //            }
        }

        $this->load->library('form_validation');
        $user_table =$this->config->item('table_users');
        if (!$this->db->table_exists($user_table))
        {
            $this->message = $this->lang->line('USER_TABLE_NOT_AVAILABLE');
            return false;
        }

        if($this->input->post("user_detail[user_group_id]") == $this->config->item('SUPER_ADMIN_GROUP_ID') || $this->input->post("user_detail[user_group_id]")== $this->config->item('A_TO_I_GROUP_ID') || $this->input->post("user_detail[user_group_id]")== $this->config->item('DONOR_GROUP_ID') || $this->input->post("user_detail[user_group_id]")== $this->config->item('MINISTRY_GROUP_ID'))
        {

        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('DIVISION_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('DISTRICT_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('UPAZILLA_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
            $this->form_validation->set_rules('user_detail[upazila]',$this->lang->line('UPAZILLA_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('UNION_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
            $this->form_validation->set_rules('user_detail[upazila]',$this->lang->line('UPAZILLA_NAME'),'required');
            $this->form_validation->set_rules('user_detail[unioun]',$this->lang->line('UNION_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('CITY_CORPORATION_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
            $this->form_validation->set_rules('user_detail[citycorporation]',$this->lang->line('CITY_CORPORATION_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
            $this->form_validation->set_rules('user_detail[citycorporation]',$this->lang->line('CITY_CORPORATION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[citycorporationward]',$this->lang->line('CITY_CORPORATION_WORD_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('MUNICIPAL_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
            $this->form_validation->set_rules('user_detail[municipal]',$this->lang->line('MUNICIPAL_NAME'),'required');
        }
        else if($this->input->post("user_detail[user_group_id]") == $this->config->item('MUNICIPAL_WORD_GROUP_ID'))
        {
            $this->form_validation->set_rules('user_detail[division]',$this->lang->line('DIVISION_NAME'),'required');
            $this->form_validation->set_rules('user_detail[zilla]',$this->lang->line('DISTRICT_NAME'),'required');
            $this->form_validation->set_rules('user_detail[municipal]',$this->lang->line('MUNICIPAL_NAME'),'required');
            $this->form_validation->set_rules('user_detail[municipalward]',$this->lang->line('MUNICIPAL_WORD_NAME'),'required');
        }

        $this->form_validation->set_rules('user_detail[name_bn]',$this->lang->line('NAME_BN'),'required');
        $this->form_validation->set_rules('user_detail[username]',$this->lang->line('USER_NAME'),'required');
        //$this->form_validation->set_rules('user_detail[password]',$this->lang->line('PASSWORD'),'required');
        //$this->form_validation->set_rules('user_detail[confirm_password]',$this->lang->line('PASSWORD'),'required');
        $this->form_validation->set_rules('user_detail[email]',$this->lang->line('EMAIL'),'required|valid_email');
        $this->form_validation->set_rules('user_detail[mobile]',$this->lang->line('MOBILE_NUMBER'),'required');
        $this->form_validation->set_rules('user_detail[user_group_id]',$this->lang->line('USER_GROUP'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

    public function check_username_existence()
    {
        $username = $this->input->post('username');
        $existence = $this->User_create_model->check_username_existence($username,0);

        if($existence)
        {
            $ajax['status']=false;
            $ajax['system_content'][]=array("id"=>"#user_check","html"=>$this->lang->line('USERNAME_EXISTS'),array(),true);
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#user_check","html"=>'',array(),true);
            $this->jsonReturn($ajax);
        }
    }

    public function get_users()
    {
        $users = array();
        if($this->permissions['list'])
        {
            $users = $this->User_create_model->get_users_info();

        }
        $this->jsonReturn($users);
    }



}
