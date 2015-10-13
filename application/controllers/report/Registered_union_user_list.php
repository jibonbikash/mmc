<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registered_union_user_list extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('report/registered_union_user_list');
        $this->controller_url='report/registered_union_user_list';
        $this->lang->load("report", $this->get_language());
        //$this->load->model("basic_setup/registered_union_user_list_model");

    }

    public function index()
    {
        $user=User_helper::get_user();
        $data['divisions']=array();
        $data['display_divisions']=false;
        $data['default_divisions']=true;

        $data['zillas']=array();
        $data['display_zillas']=false;
        $data['default_zillas']=true;
        $data['upazilas']=array();
        $data['display_upazilas']=false;
        $data['default_upazilas']=true;
        $data['unions']=array();
        $data['display_unions']=false;
        $data['default_unions']=true;
        if(($user->user_group_id==$this->config->item('SUPER_ADMIN_GROUP_ID'))||($user->user_group_id==$this->config->item('A_TO_I_GROUP_ID'))||($user->user_group_id==$this->config->item('DONOR_GROUP_ID'))||($user->user_group_id==$this->config->item('MINISTRY_GROUP_ID')))
        {
            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
            $data['display_divisions']=true;
            $data['default_divisions']=true;
        }
        else
        {
            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array('divid ='.$user->division));
            $data['display_divisions']=true;
            $data['default_divisions']=false;
            $data['display_zillas']=true;
            if($user->user_group_id==$this->config->item('DIVISION_GROUP_ID'))
            {
                $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$user->division));
                $data['default_zillas']=true;
                $data['display_upazilas']=false;
            }
            else
            {
                $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$user->division,'zillaid ='.$user->zilla));
                $data['default_zillas']=false;
                $data['display_upazilas']=true;
                if($user->user_group_id==$this->config->item('DISTRICT_GROUP_ID'))
                {
                    $data['upazilas']=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$user->zilla));
                    $data['default_upazilas']=true;
                    //$data['display_unions']=true;
                }
                else
                {
                    $data['upazilas']=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid = '.$user->upazila));
                    $data['default_upazilas']=false;
                    $data['display_unions']=true;
                    $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid='.$user->upazila));
                    $data['default_unions']=true;
                    //TODO
                    //increase report menu for union users
                }
            }
        }
        $ajax['status']=true;
        $data['title']=$this->lang->line("REPORT_UISC_REGISTRATION_UNION_USER_TITLE");

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/registered_union_user_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/registered_union_user_list');
        $this->jsonReturn($ajax);
    }

}
