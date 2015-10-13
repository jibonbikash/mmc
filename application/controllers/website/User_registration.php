<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_registration extends Root_Controller
{
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->controller_url='website/User_registration';
        $this->load->model("website/User_registration_model");
        $this->lang->load('website_lang');
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='add')
        {
            $this->dcms_add();
        }
        elseif($action=='save')
        {
            $this->dcms_save();
        }
        else
        {
            $this->current_action='add';
            $this->dcms_add();
        }
    }

    private function dcms_add()
    {
        $this->current_action='add';
        $ajax['status']=true;
        $data=array();
        $data['title']=$this->lang->line("USER_REGISTRATION");

        $data['questions'] = Query_helper::get_info($this->config->item('table_questions'),array('id value','question text'),array('status = 1'));
        $data['resources'] = Query_helper::get_info($this->config->item('table_resources'),array('res_id value','res_name text'),array('visible = 1'));

        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website/user_registration/dcms_add_edit",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));

        if($this->message)
        {
            $ajax['system_message']=$this->message;
        }

        $ajax['system_page_url']=$this->get_encoded_url('website/user_registration/index/add');
        $this->jsonReturn($ajax);
    }

    private function dcms_save()
    {
        $time = time();
        $user_data = array();
        $secretary_data = array();
        $entrepreneur_data = array();
        $device_data = array();
        $resource_data = array();
        $investment_data = array();
        $training_data = array();
        $electricity_data = array();
        $location_data = array();
        $academic_data = array();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $user_data['uisc_type'] = $this->input->post('entrepreneur_type');
            $user_data['user_group_id'] = $this->config->item('UISC_GROUP_ID');
            $user_data['uisc_id'] = $this->input->post('uisc_name');
            $user_data['division'] = $this->input->post('division');
            $user_data['zilla'] = $this->input->post('zilla');
            $user_data['status'] = 0;
            $user_data['name_bn'] = $this->input->post('entrepreneur_name');

            if($this->input->post('entrepreneur_type')==$this->config->item('ONLINE_UNION_GROUP_ID'))
            {
                $user_data['upazila'] = $this->input->post('upazilla');
                $user_data['unioun'] = $this->input->post('union');

                $serial = $this->User_registration_model->CountUnionServiceCenter($this->input->post('division'), $this->input->post('zilla'), $this->input->post('upazilla'), $this->input->post('union'));

                $user_data['username'] = $user_data['division'].'-'.$user_data['zilla'].'-'.$user_data['upazila'].'-'.$user_data['unioun'].'-'.str_pad($serial, 2, "0", STR_PAD_LEFT);
                $user_data['password'] = md5($user_data['username']);
            }
            elseif($this->input->post('entrepreneur_type')==$this->config->item('ONLINE_CITY_CORPORATION_WORD_GROUP_ID'))
            {
                $user_data['citycorporation'] = $this->input->post('citycorporation');
                $user_data['citycorporationward'] = $this->input->post('citycorporationward');

                $serial = $this->User_registration_model->countCityServiceCenter($this->input->post('division'), $this->input->post('zilla'), $this->input->post('citycorporation'), $this->input->post('citycorporationward'));

                $user_data['username'] = $user_data['division'].'-'.$user_data['zilla'].'-'.$user_data['citycorporation'].'-'.$user_data['citycorporationward'].'-'.str_pad($serial, 2, "0", STR_PAD_LEFT);
                $user_data['password'] = md5($user_data['username']);
            }
            elseif($this->input->post('entrepreneur_type')==$this->config->item('ONLINE_MUNICIPAL_WORD_GROUP_ID'))
            {
                $user_data['municipal'] = $this->input->post('municipal');
                $user_data['municipalward'] = $this->input->post('municipalward');

                $serial = $this->User_registration_model->countMunicipalServiceCenter($this->input->post('division'), $this->input->post('zilla'), $this->input->post('municipal'), $this->input->post('municipalward'));

                $user_data['username'] = $user_data['division'].'-'.$user_data['zilla'].'-'.$user_data['municipal'].'-'.$user_data['municipalward'].'-'.str_pad($serial, 2, "0", STR_PAD_LEFT);
                $user_data['password'] = md5($user_data['username']);
            }

            $user_data['email'] = $this->input->post('uisc_email');
            $user_data['mobile'] = $this->input->post('uisc_mobile_no');
            $user_data['ques_id'] = $this->input->post('ques_id');
            $user_data['ques_ans'] = $this->input->post('ques_ans');

            $dir = $this->config->item("dcms_upload");
            $uploaded = System_helper::upload_file($dir['entrepreneur'],10240,'gif|jpg|png');

            if(array_key_exists('profile_image',$uploaded))
            {
                if($uploaded['profile_image']['status'])
                {
                    $user_data['picture_name'] = $uploaded['profile_image']['info']['file_name'];
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['desk_message']=$this->message.=$uploaded['profile_image']['message'].'<br>';
                    $this->jsonReturn($ajax);
                }
            }

            $user_data['create_by']='';
            $user_data['create_date']=$time;

            $secretary_data['user_id'] = $user_data['username'];
            $secretary_data['secretary_name'] = $this->input->post('secretary_name');
            $secretary_data['secretary_email'] = $this->input->post('secretary_email');
            $secretary_data['secretary_mobile'] = $this->input->post('secretary_mobile');
            $secretary_data['secretary_address'] = $this->input->post('secretary_address');


            $entrepreneur_data['user_id'] = $user_data['username'];
            $entrepreneur_data['entrepreneur_type'] = $this->input->post('entrepreneur_exp_type');
            $entrepreneur_data['entrepreneur_name'] = $this->input->post('entrepreneur_name');
            $entrepreneur_data['entrepreneur_father_name'] = $this->input->post('entrepreneur_father_name');
            $entrepreneur_data['entrepreneur_mother_name'] = $this->input->post('entrepreneur_mother_name');
            $entrepreneur_data['entrepreneur_qualification'] = $this->input->post('entrepreneur_qualification');
            $entrepreneur_data['entrepreneur_mobile'] = $this->input->post('entrepreneur_mobile');
            $entrepreneur_data['entrepreneur_email'] = $this->input->post('entrepreneur_email');
            $entrepreneur_data['entrepreneur_sex'] = $this->input->post('entrepreneur_sex');
            $entrepreneur_data['entrepreneur_address'] = $this->input->post('entrepreneur_address');

            $device_data['connection_type'] = $this->input->post('connection_type');
            $device_data['ip_address'] = $this->input->post('ip_address');
            $device_data['modem'] = $this->input->post('modem');

            $investment_data['invested_money'] = $this->input->post('invested_money');
            $investment_data['self_investment'] = $this->input->post('self_investment');
            $investment_data['invest_debt'] = $this->input->post('invest_debt');
            $investment_data['invest_sector'] = $this->input->post('invest_sector');

            $electricity_data['electricity'] = $this->input->post('electricity');
            $electricity_data['solar'] = $this->input->post('solar');
            $electricity_data['ips'] = $this->input->post('ips');

            $location_data['center_type'] = $this->input->post('center_location');

            $academic_data['latest_education'] = $this->input->post('latest_education');
            $academic_data['passing_year'] = $this->input->post('passing_year');

            $coursePost = $this->input->post('training_course');
            $institutePost = $this->input->post('training_institute');
            $timePost = $this->input->post('training_time');

            $resPost = $this->input->post('res_id');
            $res_detailPost = $this->input->post('res_detail');
            $quantityPost = $this->input->post('quantity');
            $statusPost = $this->input->post('status');

            $this->db->trans_start();  //DB Transaction Handle START
            $user_id = Query_helper::add($this->config->item('table_users'),$user_data);

            $secretary_data['uisc_id'] = $this->input->post('uisc_name');
            $secretary_data['user_id'] = $user_id;
            $secretary_data['create_by']='';
            $secretary_data['create_date']=$time;
            Query_helper::add($this->config->item('table_secretary_infos'),$secretary_data);

            $entrepreneur_data['uisc_id'] = $this->input->post('uisc_name');
            $entrepreneur_data['user_id'] = $user_id;
            $entrepreneur_data['create_by']='';
            $entrepreneur_data['create_date']=$time;
            Query_helper::add($this->config->item('table_entrepreneur_infos'),$entrepreneur_data);

            $device_data['uisc_id'] = $this->input->post('uisc_name');
            $device_data['user_id'] = $user_id;
            $device_data['create_by']='';
            $device_data['create_date']=$time;
            Query_helper::add($this->config->item('table_device_infos'),$device_data);

            $investment_data['uisc_id'] = $this->input->post('uisc_name');
            $investment_data['user_id'] = $user_id;
            $investment_data['create_by']='';
            $investment_data['create_date']=$time;
            Query_helper::add($this->config->item('table_investment'),$investment_data);

            $electricity_data['uisc_id'] = $this->input->post('uisc_name');
            $electricity_data['user_id'] = $user_id;
            $electricity_data['create_by']='';
            $electricity_data['create_date']=$time;
            Query_helper::add($this->config->item('table_electricity'),$electricity_data);

            $location_data['uisc_id'] = $this->input->post('uisc_name');
            $location_data['user_id'] = $user_id;
            $location_data['create_by']='';
            $location_data['create_date']=$time;
            Query_helper::add($this->config->item('table_center_location'),$location_data);

            $academic_data['uisc_id'] = $this->input->post('uisc_name');
            $academic_data['user_id'] = $user_id;
            $academic_data['create_by']='';
            $academic_data['create_date']=$time;
            Query_helper::add($this->config->item('table_entrepreneur_education'),$academic_data);

            if(sizeof($resPost)>0 && is_array($resPost))
            {
                for($i=0; $i<sizeof($resPost); $i++)
                {
                    $resource_data['uisc_id'] = $this->input->post('uisc_name');
                    $resource_data['user_id'] = $user_id;
                    $resource_data['res_id'] = $resPost[$i];
                    $resource_data['res_detail'] = $res_detailPost[$i];
                    $resource_data['quantity'] = $quantityPost[$i];
                    $resource_data['status'] = $statusPost[$i];
                    $resource_data['create_by']='';
                    $resource_data['create_date']=$time;
                    Query_helper::add($this->config->item('table_uisc_resources'),$resource_data);
                }
            }

            if(sizeof($coursePost)>0 && is_array($coursePost))
            {
                for($i=0; $i<sizeof($coursePost); $i++)
                {
                    $training_data['uisc_id'] = $this->input->post('uisc_name');
                    $training_data['user_id'] = $user_id;
                    $training_data['course_name'] = $coursePost[$i];
                    $training_data['institute_name'] = $institutePost[$i];
                    $training_data['timespan'] = $timePost[$i];
                    $training_data['create_by']='';
                    $training_data['create_date']=$time;
                    Query_helper::add($this->config->item('table_training'),$training_data);
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
                $this->dcms_add();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                $this->jsonReturn($ajax);
            }

        }
    }

    private function check_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('entrepreneur_type',$this->lang->line('TYPE'),'required');
        $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
        $this->form_validation->set_rules('zilla',$this->lang->line('ZILLA'),'required');

        if($this->input->post('entrepreneur_type')==$this->config->item('UNION_GROUP_ID'))
        {
            $this->form_validation->set_rules('upazilla',$this->lang->line('UPAZILLA'),'required');
            $this->form_validation->set_rules('union',$this->lang->line('UNION'),'required');
        }
        elseif($this->input->post('entrepreneur_type')==$this->config->item('CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $this->form_validation->set_rules('citycorporation',$this->lang->line('CITY_CORPORATION'),'required');
            $this->form_validation->set_rules('citycorporationward',$this->lang->line('WARD_NO'),'required');
        }
        elseif($this->input->post('entrepreneur_type')==$this->config->item('MUNICIPAL_WORD_GROUP_ID'))
        {
            $this->form_validation->set_rules('municipal',$this->lang->line('MUNICIPALITY'),'required');
            $this->form_validation->set_rules('municipalward',$this->lang->line('MUNICIPALITY_WARD'),'required');
        }

        $this->form_validation->set_rules('uisc_email',$this->lang->line('EMAIL'),'required');
        $this->form_validation->set_rules('uisc_mobile_no',$this->lang->line('MOBILE_NO'),'required');
        $this->form_validation->set_rules('uisc_address',$this->lang->line('ADDRESS'),'required');
        $this->form_validation->set_rules('ques_id',$this->lang->line('SECRET_QUESTION'),'required');
        $this->form_validation->set_rules('ques_ans',$this->lang->line('QUESTION_ANSWER'),'required');
        $this->form_validation->set_rules('secretary_name',$this->lang->line('SECRETARY_NAME'),'required');
        $this->form_validation->set_rules('secretary_mobile',$this->lang->line('SECRETARY_MOBILE_NO'),'required');
        $this->form_validation->set_rules('secretary_email',$this->lang->line('SECRETARY_EMAIL'),'required');
        $this->form_validation->set_rules('secretary_address',$this->lang->line('SECRETARY_ADDRESS'),'required');

        $this->form_validation->set_rules('entrepreneur_exp_type',$this->lang->line('ENTREPRENEUR_TYPE'),'required');
        $this->form_validation->set_rules('entrepreneur_name',$this->lang->line('ENTREPRENEUR_NAME'),'required');
        $this->form_validation->set_rules('entrepreneur_mother_name',$this->lang->line('MOTHERS_NAME'),'required');
        //$this->form_validation->set_rules('entrepreneur_qualification',$this->lang->line('ENTREPRENEUR_ACADEMIC_QUALIFICATION'),'required');
        $this->form_validation->set_rules('entrepreneur_mobile',$this->lang->line('ENTREPRENEUR_MOBILE_NO'),'required');
        $this->form_validation->set_rules('entrepreneur_email',$this->lang->line('ENTREPRENEUR_EMAIL'),'required');
        $this->form_validation->set_rules('entrepreneur_sex',$this->lang->line('ENTREPRENEUR_GENDER'),'required');
        $this->form_validation->set_rules('entrepreneur_address',$this->lang->line('ENTREPRENEUR_ADDRESS'),'required');
        $this->form_validation->set_rules('connection_type',$this->lang->line('CONNECTION_TYPE'),'required');
        $this->form_validation->set_rules('modem',$this->lang->line('MODEM'),'required');
        $this->form_validation->set_rules('ip_address',$this->lang->line('IP_ADDRESS'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

    public function get_zilla()
    {
        $division_id=$this->input->post('division_id');
        $zillas=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_zilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$zillas),true));
        $this->jsonReturn($ajax);
    }

    public function get_upazila()
    {
        $zilla_id=$this->input->post('zilla_id');
        $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_upazila_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$upazilas),true));
        $this->jsonReturn($ajax);
    }

    public function get_union()
    {
        $zilla_id=$this->input->post('zilla_id');
        $upazila_id=$this->input->post('upazila_id');
        $unions=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'upazilaid='.$upazila_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_unioun_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$unions),true));
        $this->jsonReturn($ajax);
    }

    public function get_city_corporation()
    {
        $division_id=$this->input->post('division_id');
        $zilla_id=$this->input->post('zilla_id');
        $city_corporations=Query_helper::get_info($this->config->item('table_city_corporations'),array('citycorporationid value', 'citycorporationname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'divid='.$division_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_citycorporation_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$city_corporations),true));
        $this->jsonReturn($ajax);
    }

    public function get_city_corporation_word()
    {
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
        $zilla_id=$this->input->post('zilla_id');
        $municipals=Query_helper::get_info($this->config->item('table_municipals'),array('municipalid value', 'municipalname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_municipal_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$municipals),true));
        $this->jsonReturn($ajax);
    }

    public function get_municipal_ward()
    {
        $zilla_id=$this->input->post('zilla_id');
        $municipal_id=$this->input->post('municipal_id');
        $municipal_wards=Query_helper::get_info($this->config->item('table_municipal_wards'),array('wardid value', 'wardname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'municipalid = '.$municipal_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#user_municipal_ward_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$municipal_wards),true));
        $this->jsonReturn($ajax);
    }

    public function getUnionServiceCenter()
    {
        $division_id = $this->input->post('division_id');
        $zilla_id = $this->input->post('zilla_id');
        $upazilla_id = $this->input->post('upazilla_id');
        $union_id = $this->input->post('union_id');

        $uisc = $this->User_registration_model->getUnionServiceCenter($division_id, $zilla_id, $upazilla_id, $union_id);

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#uisc_name","html"=>$this->load_view("dropdown",array('drop_down_options'=>$uisc),true));
        $this->jsonReturn($ajax);
    }

    public function getCityServiceCenter()
    {
        $division_id = $this->input->post('division_id');
        $zilla_id = $this->input->post('zilla_id');
        $citycorporation_id = $this->input->post('citycorporation_id');
        $city_corporation_ward_id = $this->input->post('city_corporation_ward_id');

        $uisc = $this->User_registration_model->getCityServiceCenter($division_id, $zilla_id, $citycorporation_id, $city_corporation_ward_id);

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#uisc_name","html"=>$this->load_view("dropdown",array('drop_down_options'=>$uisc),true));
        $this->jsonReturn($ajax);
    }

    public function getMunicipalServiceCenter()
    {
        $division_id = $this->input->post('division_id');
        $zilla_id = $this->input->post('zilla_id');
        $municipal_id = $this->input->post('municipal_id');
        $municipal_ward_id = $this->input->post('municipal_ward_id');

        $uisc = $this->User_registration_model->getMunicipalServiceCenter($division_id, $zilla_id, $municipal_id, $municipal_ward_id);

        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#uisc_name","html"=>$this->load_view("dropdown",array('drop_down_options'=>$uisc),true));
        $this->jsonReturn($ajax);
    }

}
