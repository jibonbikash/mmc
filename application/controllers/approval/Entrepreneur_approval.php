<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrepreneur_approval extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('approval/Entrepreneur_approval');
        $this->controller_url='approval/Entrepreneur_approval';
        $this->load->model("approval/Entrepreneur_approval_model");
        $this->lang->load('website_lang');
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

            $session_data['approval'] = $this->input->post();
            $this->session->set_userdata($session_data);

            $ajax['system_content'][]=array("id"=>"#load_list","html"=>$this->load_view("approval/entrepreneur_approval/dcms_list",'',true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('approval/Entrepreneur_approval');
            $ajax['system_page_title']=$this->lang->line("ENTREPRENEUR_APPROVAL");
            $this->jsonReturn($ajax);
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

            $data['divisions'] = $this->Entrepreneur_approval_model->get_divisions_by_user();
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("approval/entrepreneur_approval/dcms_search",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('approval/entrepreneur_approval/index/add');
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
        $detail_info = $this->Entrepreneur_approval_model->fetch_uisc_detail_info($id);
        $detail_info['equips'] = $this->Entrepreneur_approval_model->fetch_uisc_equipments($id);
        $data['uisc_detail'] = $detail_info;

        if($this->permissions['edit'])
        {
            if($data['uisc_detail'])
            {
                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#modal_data","html"=>$this->load_view("approval/entrepreneur_approval/dcms_edit",$data,true));
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
        $time=time();
        $user = User_helper::get_user();

        $id = $this->input->post("uisc_id");
        $status = $this->input->post("approval_status");
        $uisc_type = $this->input->post("uisc_type");
        $division = $this->input->post("division");
        $zilla = $this->input->post("zilla");
        $image = $this->input->post("user_image");
        $upazilla = 0;
        $union = 0;

        $citycorporation = 0;
        $citycorporationward = 0;
        $municipal = 0;
        $municipalward = 0;

        $union_name = $this->input->post("union_name");
        $city_corporation_name = $this->input->post("city_corporation_name");
        $city_corporation_ward_name = $this->input->post("city_corporation_ward_name");
        $municipal_name = $this->input->post("municipal_name");
        $municipal_ward_name = $this->input->post("municipal_ward_name");

        $entrepreneur_gender = $this->input->post("gender");

        $uisc_center_name='';

        $ques_id = $this->input->post("ques_id");
        $ques_ans = $this->input->post("ques_ans");

        if($uisc_type == $this->config->item('ONLINE_UNION_GROUP_ID'))
        {
            $upazilla = $this->input->post("upazilla");
            $union = $this->input->post("union");
            $serial = $this->Entrepreneur_approval_model->CountUnionServiceCenter($division, $zilla, $upazilla, $union);
            $number_of_user = $this->Entrepreneur_approval_model->Number_of_uisc_user($id);
            $user_id = $zilla.'-'.$upazilla.'-'.$union.'-'.str_pad($serial, 2, "0", STR_PAD_LEFT).'-'.str_pad($number_of_user, 2, "0", STR_PAD_LEFT);
            $uisc_center_name=$union_name." ".$this->lang->line('UNION_PARISHAD')." ".$this->lang->line('DIGITAL_CENTER')." - ".$serial;
        }
        elseif($uisc_type == $this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $citycorporation = $this->input->post("citycorporation");
            $citycorporationward = $this->input->post("citycorporationward");
            $serial = $this->Entrepreneur_approval_model->countCityServiceCenter($division, $zilla, $citycorporation, $citycorporationward);
            $number_of_user = $this->Entrepreneur_approval_model->Number_of_uisc_user($id);
            $user_id = $zilla.'-'.$citycorporation.'-'.$citycorporationward.'-'.str_pad($serial, 2, "0", STR_PAD_LEFT).'-'.str_pad($number_of_user, 2, "0", STR_PAD_LEFT);
            $uisc_center_name=$city_corporation_name." ".$city_corporation_ward_name." ".$this->lang->line('CITY_CORPORATION')." ".$this->lang->line('DIGITAL_CENTER')." - ".$serial;

        }
        elseif($uisc_type == $this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'))
        {
            $municipal = $this->input->post("municipal");
            $municipalward = $this->input->post("municipalward");
            $serial = $this->Entrepreneur_approval_model->countMunicipalServiceCenter($division, $zilla, $municipal, $municipalward);
            $number_of_user = $this->Entrepreneur_approval_model->Number_of_uisc_user($id);
            $user_id = $zilla.'-'.$municipal.'-'.$municipalward.'-'.str_pad($serial, 2, "0", STR_PAD_LEFT).'-'.str_pad($number_of_user, 2, "0", STR_PAD_LEFT);
            $uisc_center_name=$municipal_name." ".$municipal_ward_name." ".$this->lang->line('MUNICIPALITY')." ".$this->lang->line('DIGITAL_CENTER')." - ".$serial;
        }

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $uisc_info_update_data = Array('status'=>$status);
            //$entrepreneur_info_update_data = Array('user_id'=>$user_id);
            //$secretary_info_update_data = Array('user_id'=>$user_id);

            $user_data = Array
            (
                'username'=>$user_id,
                'password'=>md5($user_id),
                'user_group_id'=>$this->config->item('UISC_GROUP_ID'),
                'uisc_type'=>$uisc_type,
                'uisc_id'=>$id,
                'ques_id'=>$ques_id,
                'ques_ans'=>$ques_ans,
                'division'=>$division,
                'zilla'=>$zilla,
                'upazila'=>$upazilla,
                'unioun'=>$union,
                'citycorporation'=>$citycorporation,
                'citycorporationward'=>$citycorporationward,
                'municipal'=>$municipal,
                'municipalward'=>$municipalward,
                'gender'=>$entrepreneur_gender,
                'picture_name'=>$image,
                'create_by'=>$user->id,
                'create_date'=>$time
            );

            if($id>0)
            {
                $uisc_info_update_data['update_by']=$user->id;
                $uisc_info_update_data['update_date']=$time;

                $this->db->trans_start();  //DB Transaction Handle START

                if($status==1)
                {
                    $uisc_user_id=Query_helper::add($this->config->item('table_users'),$user_data);

                    //$uisc_info_update_data['uisc_name']=$uisc_center_name;

                    $entrepreneur_info_update_data['user_id']=$uisc_user_id;
                    $entrepreneur_info_update_data['update_by']=$user->id;
                    $entrepreneur_info_update_data['update_date']=$time;

                    $secretary_info_update_data['user_id']=$uisc_user_id;
                    $secretary_info_update_data['update_by']=$user->id;
                    $secretary_info_update_data['update_date']=$time;

                    $resources_info_update_data['user_id']=$uisc_user_id;
                    $resources_info_update_data['update_by']=$user->id;
                    $resources_info_update_data['update_date']=$time;

                    $device_info_update_data['user_id']=$uisc_user_id;
                    $device_info_update_data['update_by']=$user->id;
                    $device_info_update_data['update_date']=$time;

                    $center_location_info_update_data['user_id']=$uisc_user_id;
                    $center_location_info_update_data['update_by']=$user->id;
                    $center_location_info_update_data['update_date']=$time;

                    $education_info_update_data['user_id']=$uisc_user_id;
                    $education_info_update_data['update_by']=$user->id;
                    $education_info_update_data['update_date']=$time;

                    $electricity_info_update_data['user_id']=$uisc_user_id;
                    $electricity_info_update_data['update_by']=$user->id;
                    $electricity_info_update_data['update_date']=$time;

                    $investment_info_update_data['user_id']=$uisc_user_id;
                    $investment_info_update_data['update_by']=$user->id;
                    $investment_info_update_data['update_date']=$time;

                    $training_info_update_data['user_id']=$uisc_user_id;
                    $training_info_update_data['update_by']=$user->id;
                    $training_info_update_data['update_date']=$time;

                    Query_helper::update($this->config->item('table_uisc_infos'),$uisc_info_update_data,array("id = ".$id));
                    Query_helper::update($this->config->item('table_entrepreneur_infos'),$entrepreneur_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_secretary_infos'),$secretary_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_uisc_resources'),$resources_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_device_infos'),$device_info_update_data,array("uisc_id = ".$id));

                    Query_helper::update($this->config->item('table_center_location'),$center_location_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_entrepreneur_education'),$education_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_electricity'),$electricity_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_investment'),$investment_info_update_data,array("uisc_id = ".$id));
                    Query_helper::update($this->config->item('table_training'),$training_info_update_data,array("uisc_id = ".$id));

                    $user_detail_info = $this->Entrepreneur_approval_model->get_user_detail_info_from_entrepreneur($uisc_user_id, $id);

                    $user_update_data['name_bn'] = $user_detail_info['entrepreneur_name'];
                    $user_update_data['mobile'] = $user_detail_info['entrepreneur_mobile'];
                    $user_update_data['email'] = $user_detail_info['entrepreneur_email'];
                    $user_update_data['present_address'] = $user_detail_info['entrepreneur_address'];

                    Query_helper::update($this->config->item('table_users'),$user_update_data,array("id = ".$uisc_user_id));
                }
                elseif($status==2)
                {
                    Query_helper::update($this->config->item('table_uisc_infos'),$uisc_info_update_data,array("id = ".$id));
                }

                $this->db->trans_complete();   //DB Transaction Handle END

                if($this->db->trans_status() === TRUE)
                {
                    $ajax['status']=true;

                    if($status==1)
                    {
                        $ajax['system_message']=$this->lang->line("MSG_SUCCESSFULLY_APPROVED");
                    }
                    else
                    {
                        $ajax['system_message']=$this->lang->line("MSG_SUCCESSFULLY_DENIED");
                    }

                    $this->jsonReturn($ajax);
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

    private function check_validation()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('uisc_id',$this->lang->line('UISC_ID'),'required');
        $this->form_validation->set_rules('approval_status',$this->lang->line('APPROVAL_STATUS'),'required');
        $this->form_validation->set_rules('uisc_type',$this->lang->line('UISC_TYPE'),'required');
        $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
        $this->form_validation->set_rules('zilla',$this->lang->line('ZILLA'),'required');

        $division_id=$this->input->post("division");
        $zilla_id=$this->input->post("zilla");
        $upazilla_id=$this->input->post("upazilla");
        $union_id=$this->input->post("union");
        $city_corporation_id=$this->input->post("citycorporation");
        $city_corporation_word_id=$this->input->post("citycorporationward");
        $municipal_id=$this->input->post("municipal");
        $municipal_word_id=$this->input->post("municipalward");
        if(!$this->Entrepreneur_approval_model->check_division($division_id))
        {
            $this->message=$this->lang->line('DIVISION_NOT_MATCH');
            return false;
        }
        if(!$this->Entrepreneur_approval_model->check_zilla($division_id, $zilla_id))
        {
            $this->message=$this->lang->line('DISTRICT_NOT_MATCH');
            return false;
        }
        if($this->input->post('uisc_type')==$this->config->item('ONLINE_UNION_GROUP_ID'))
        {
            $this->form_validation->set_rules('upazilla',$this->lang->line('UPAZILLA'),'required');
            $this->form_validation->set_rules('union',$this->lang->line('UNION'),'required');

            if(!$this->Entrepreneur_approval_model->check_upazilla($zilla_id, $upazilla_id))
            {
                $this->message=$this->lang->line('UPAZILLA_NOT_MATCH');
                return false;
            }
            if(!$this->Entrepreneur_approval_model->check_union($zilla_id, $upazilla_id, $union_id))
            {
                $this->message=$this->lang->line('UNION_NOT_MATCH');
                return false;
            }
        }
        elseif($this->input->post('uisc_type')==$this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $this->form_validation->set_rules('citycorporation',$this->lang->line('CITYCORPORATION'),'required');
            $this->form_validation->set_rules('citycorporationward',$this->lang->line('CITYCORPORATIONWARD'),'required');

            if(!$this->Entrepreneur_approval_model->check_city_corporation($zilla_id, $city_corporation_id))
            {
                $this->message=$this->lang->line('CITY_CORPORATION_NOT_MATCH');
                return false;
            }
            if(!$this->Entrepreneur_approval_model->check_city_corporation_word($zilla_id, $city_corporation_id, $city_corporation_word_id))
            {
                $this->message=$this->lang->line('CITY_CORPORATION_WORD_NOT_MATCH');
                return false;
            }
        }
        elseif($this->input->post('uisc_type')==$this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'))
        {
            $this->form_validation->set_rules('municipal',$this->lang->line('MUNICIPAL'),'required');
            $this->form_validation->set_rules('municipalward',$this->lang->line('MUNICIPALWARD'),'required');
            if(!$this->Entrepreneur_approval_model->check_municipal($zilla_id, $municipal_id))
            {
                $this->message=$this->lang->line('MUNICIPAL_NOT_MATCH');
                return false;
            }
            if(!$this->Entrepreneur_approval_model->check_municipal_word($zilla_id, $municipal_id, $municipal_word_id))
            {
                $this->message=$this->lang->line('MUNICIPAL_WORD_NOT_MATCH');
                return false;
            }
        }

        $this->form_validation->set_rules('ques_id',$this->lang->line('QUES_ID'),'required');
        $this->form_validation->set_rules('ques_ans',$this->lang->line('QUES_ANS'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

    public function get_uiscs()
    {
        $session_data = $this->session->userdata('approval');
        $uiscs = array();

        if($this->permissions['list'])
        {
            $entrepreneur_type = isset($session_data['entrepreneur_type'])?$session_data['entrepreneur_type']:0;
            $division = isset($session_data['division'])?$session_data['division']:0;
            $zilla = isset($session_data['zilla'])?$session_data['zilla']:0;
            $upazilla = isset($session_data['upazilla'])?$session_data['upazilla']:0;
            $municipal = isset($session_data['municipal'])?$session_data['municipal']:0;
            $municipalward = isset($session_data['municipalward'])?$session_data['municipalward']:0;
            $citycorporation = isset($session_data['citycorporation'])?$session_data['citycorporation']:0;
            $citycorporationward = isset($session_data['citycorporationward'])?$session_data['citycorporationward']:0;
            $union = isset($session_data['union'])?$session_data['union']:0;
            $year = isset($session_data['year'])?$session_data['year']:0;
            $month = isset($session_data['month'])?$session_data['month']:0;
            $date = isset($session_data['date'])?$session_data['date']:0;
            $status = isset($session_data['status'])?$session_data['status']:'';
        }

        $uiscs = $this->Entrepreneur_approval_model->get_approval_uisc_detail($entrepreneur_type, $division, $zilla, $upazilla, $municipal, $municipalward, $citycorporation, $citycorporationward, $union, $year, $month, $date, $status);
        $this->session->unset_userdata('approval'); // unset session approval data.
        $this->jsonReturn($uiscs);
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
