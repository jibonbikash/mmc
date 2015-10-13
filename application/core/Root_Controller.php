<?php
//all design must contains following htm id
//system_content to display content of current page must
//system_sidebar_left
//header1
//header2
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Root_Controller extends CI_Controller
{
    private $template;
    private $default_template;
    private $language;
    private $language_code;
    public function __construct()
    {
        parent::__construct();
        $this->template='default';
        $this->default_template='default';

        $this->language='bangla';
        $this->language_code='bn';

        $this->set_template();
        $this->set_language();
        $this->config->set_item('language', $this->get_language());
        $this->lang->load('my', $this->get_language());
        if ($this->input->is_ajax_request())
        {
            $user=User_helper::get_user();
            if(!$user)
            {
                if(!in_array($this->router->class, $this->config->item('PUBLIC_CONTROLLERS')))
                {
                    $this->login_page($this->lang->line('SESSION_TIME_OUT'));
                }
            }
        }
        else
        {
            //echo $this->load_view('main','',true);
            echo $this->load->view($this->get_template()."/main",'',true);
            die();
        }
    }
    public function set_template()
    {
        /*$user=User_helper::get_user();
        if($user)
        {

            $file=VIEWPATH.$user->template_name.'/main.php';
            //echo $user->template_name;

            if (file_exists($file))
            {
                $this->template=$user->template_name;
            }
        }*/
    }
    public function get_template()
    {
        return $this->template;
    }
    public function set_language()
    {
        /*$user=User_helper::get_user();
        if($user)
        {
            $this->language=$user->language_name;
            $this->language_code=$user->language_code;
        }*/
    }
    public function get_language()
    {
        return $this->language;
    }
    public function get_language_code()
    {
        return $this->language_code;
    }
    public function jsonReturn($array)
    {
        header('Content-type: application/json');
        echo json_encode($array);
        exit();
    }
    public function get_encoded_url($url)
    {
       //       return site_url(bin2hex($url));
       return site_url(($url));
    }
    public function load_view($view_name,$data=null,$display=false)
    {
        $file=VIEWPATH.$this->get_template().'/'.$view_name.'.php';
        $view=$this->default_template.'/'.$view_name;

        if (file_exists($file))
        {
            $view=$this->get_template().'/'.$view_name;
        }
        //echo $file;
        //echo $view;
        return $this->load->view($view,$data,$display);
    }
    public function login_page($message="")
    {
        $ajax['status']=true;

        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("login","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_header","html"=>"","",true);

        if($message)
        {
            $ajax['system_message']=$message;
        }
        $ajax['system_page_url']=base_url().'home/login/';
        //$ajax['system_page_title']=$this->lang->line("LOGIN");
        $this->jsonReturn($ajax);
    }
    public function dashboard_page($message="")
    {
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_header","html"=>$this->load_view("header","",true));

        if($message)
        {
            $ajax['system_message']=$message;
        }

        $ajax['system_page_url']=base_url().'home/dashboard/';
        $ajax['system_page_title']=$this->lang->line("DASHBOARD");
        $this->jsonReturn($ajax);
    }

    public function logout_page()
    {
        $this->session->sess_destroy();
        $this->login_page($this->lang->line("MSG_LOGOUT_SUCCESS"));
    }
    
}