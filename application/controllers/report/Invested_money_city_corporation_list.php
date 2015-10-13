<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invested_money_city_corporation_list extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('report/invested_money_city_corporation_list');
        $this->controller_url='report/invested_money_city_corporation_list';
        $this->lang->load("report", $this->get_language());
        //$this->load->model("basic_setup/invested_money_city_corporation_list_model");

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

        $data['municipal']=array();
        $data['display_city_corporation']=false;
        $data['default_city_corporation']=true;

        $data['city_corporation_ward']=array();
        $data['display_city_corporation_ward']=false;
        $data['default_city_corporation_ward']=true;

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
                $data['display_city_corporation']=false;
            }
            else
            {
                $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$user->division,'zillaid ='.$user->zilla));
                $data['default_zillas']=false;
                $data['display_city_corporation']=true;
                if($user->user_group_id==$this->config->item('DISTRICT_GROUP_ID'))
                {
                    $data['city_corporations']=Query_helper::get_info($this->config->item('table_city_corporations'),array('citycorporationid value', 'citycorporationname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'divid='.$user->division));
                    $data['default_city_corporation']=true;
                    //$data['display_unions']=true;
                }
                else
                {
                    $data['city_corporations']=Query_helper::get_info($this->config->item('table_city_corporations'),array('citycorporationid value', 'citycorporationname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'divid='.$user->division, 'citycorporationid='.$user->citycorporation));
                    $data['default_city_corporation']=false;
                    $data['display_city_corporation_ward']=true;
                    $data['city_corporation_words']=Query_helper::get_info($this->config->item('table_city_corporation_wards'),array('citycorporationwardid value', 'wardname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'divid='.$user->division, 'citycorporationid = '.$user->citycorporation));
                    $data['default_city_corporation_ward']=true;
                    //TODO
                    //increase report menu for union users
                }
            }
        }
        $ajax['status']=true;
        $data['title']=$this->lang->line("REPORT_INVESTED_MONEY_CITY_CORPORATION_TITLE");

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/invested_money_city_corporation_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/invested_money_city_corporation_list');
        $this->jsonReturn($ajax);
    }

}
