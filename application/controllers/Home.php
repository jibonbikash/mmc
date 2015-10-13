<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Root_Controller
{
    function __construct()
    {
        //
        parent::__construct();
   //     $this->load->model("nstitute/Institute");
        $this->load->model("institute/Institute_model");
       
        $this->load->helper('url');
       
    }
    
    public function index()
    {
        $ajax['status']=true;

        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));

        $ajax['system_page_url']=base_url();
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $this->jsonReturn($ajax);
    }
    public function dashboard()
    {
        $CI =& get_instance();
        $user=User_helper::get_user();
        if($user)
        {
        //    $this->dashboard_page();
          $data['userinfo']=$this->Institute_model->get_user_information($user->id);
     //     $instituteinfo=$this->Institute_model->get_user_information($user->id);
         // print_r($instituteinfo);
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/dashboard",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->login_page();
        }
    }
    public function login()
    {
        $user=User_helper::get_user();
        if($user)
        {
            $this->dashboard_page();
        }
        else
        {
            if($this->input->post())
            {
                if(User_helper::login($this->input->post("username"),$this->input->post("password")))
                {
                            //          $user=User_helper::get_user();
                         //              $user_info['user_id']=$user->id;
                         //              $user_info['login_time']=time();
                        //             $user_info['ip_address']=$this->input->ip_address();
                        //              $user_info['request_headers']=json_encode($this->input->request_headers());
                       //                Query_helper::add($this->config->item('table_user_login_history'),$user_info);
                    $this->dashboard_page($this->lang->line("MSG_LOGIN_SUCCESS"));
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_USERNAME_PASSWORD_INVALID");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $this->login_page();//login page view
            }

        }

    }
    public function logout()
    {
        $this->session->sess_destroy();
        //$this->login_page($this->lang->line("MSG_LOGOUT_SUCCESS"));
        //$this->logout_page();//logout
        //$this->website();
        redirect(base_url());
    }
    
    public function registration(){
    //    $this->load->library('form');
            $this->load->library('form_validation');
            $ajax['status']=true;
            $data=array();
            $data['title']=$this->lang->line("REGISTRATION_TITLE");
            
       if($this->input->post())
            {
           
           if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        
        else {
  //     $this->load->model("institute/Institute");   
    $data = array(
    'name' => $this->input->post('registration[institute]'),
    'code' => $this->input->post('registration[em]'),
    'inipassword' => $this->input->post('registration[password]'),
    'email' => $this->input->post('registration[email]'),
    'education_type_ids' => $this->input->post('registration[education_type]'),
    'divid' => $this->input->post('registration[divid]'),
    'zillaid' => $this->input->post('registration[zilla]'),
    'upozillaid' => $this->input->post('registration[upozilla]'),
    'applied_date' => date('Y-m-d'),
    'is_primary' => $this->input->post('registration[primary]'),
    'is_secondary' => $this->input->post('registration[secondary]'),
    'is_higher' => $this->input->post('registration[higher]'),
    'user_id' => 999999,
    'mobile' => $this->input->post('registration[mobile]'),
    'status' => 1,
    'approved_by' => NULL,
    'approved_date' => NULL,
    'comment' => NULL
    
);
     $this->Institute->form_insert($data);
   // $data['message'] = 'Data Inserted Successfully';
      $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE");
   //   $this->jsonReturn($ajax);    
    //  redirect("/home/registration","refresh");
            $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
            $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'), array());        
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));       
            $this->jsonReturn($ajax);
        }

       }
        
           $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
           $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'), array());
             
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));   
        
         $this->jsonReturn($ajax);
    }

    
    public function getZilla()
    {
        $division_id=$this->input->post('division_id');
        $zillas=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#zilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$zillas),true));
        $this->jsonReturn($ajax);
    }
    
     public function getUpazila()
    {
        $zilla_id=$this->input->post('zilla_id');
        $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#upozilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$upazilas),true));
        $this->jsonReturn($ajax);
    }
    
    public function education_level(){
        
    $education_level=$this->input->post('education_level');
    $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$education_level));
    $ajax['status']=true;
    $ajax['system_content'][]=array("id"=>"#classes","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
    $this->jsonReturn($ajax);   
        
    }
    
     public function education_classes(){
        
    $education_level=$this->input->post('education_level');
    $classes=$this->input->post('classes');
    $education_type_ids=$this->input->post('education_type_ids');
   
    if ($classes) {
             if ($classes < 6) {
                 $education_level = 5;
             }elseif( 5< $classes && $classes< 11){
                 $education_level = 6;
             }elseif( $classes > 10){
                 $education_level = 7 ;
             }
         }
         
        $this->db->where(array('class_id' => $classes, 'education_level_id' => $education_level, 'education_type_id' => $education_type_ids));
        $query = $this->db->get($this->config->item('table_subject'));
        $subjects = array();
        $subjectname = '';
        if($query->result()){
            foreach ($query->result() as $subject) {
            $subjects[$subject->id] = $subject->name;
         
            $subjectname .= '<input name="subject['.$subject->id.']['.$subject->name.']" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label>';
            }
        //    return $subjects;
            
            $this->jsonReturn($subjectname); 
        }

    }

    
    public function education_classescollege(){
        
    $classes=$this->input->post('classes');
    $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$classes));
    $ajax['status']=true;
    $ajax['system_content'][]=array("id"=>"#classes","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
    $this->jsonReturn($ajax);   
        
    }
    
    private function check_validation()
    {

        $this->load->library('form_validation');
       

        $this->form_validation->set_rules('registration[divid]',$this->lang->line('DIVISION_NAME_SELECT'),'required');
        $this->form_validation->set_rules('registration[zilla]',$this->lang->line('ZILLA_NAME_SELECT_BN'),'required');
        $this->form_validation->set_rules('registration[upozilla]',$this->lang->line('UPOZILLA_SELECT'),'required');
        $this->form_validation->set_rules('registration[education_type]',$this->lang->line('EDUCATION_TYPE'),'required');
        $this->form_validation->set_rules('registration[institute]',$this->lang->line('SCHOOL_NAME'),'required');
        $this->form_validation->set_rules('registration[email]',$this->lang->line('SCHOOL_EMAIL'),'trim|required|valid_email');
        $this->form_validation->set_rules('registration[mobile]',$this->lang->line('SCHOOL_MOBILE'),'required');
       // $this->form_validation->set_rules('registration[em]',$this->lang->line('SCHOOL_EM'),'required');
       $this->form_validation->set_rules('registration[em]',$this->lang->line('SCHOOL_EM'),'trim|required|callback_isEMExist');
        $this->form_validation->set_rules('registration[password]',$this->lang->line('SCHOOL_PASSWORD'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
    
    
    public function isEMExist($key) {
  //$this->Institute->EM_exists($key);
        
        $CI =& get_instance();
        $this->db->where('code', $key);
	$query = $this->db->get($CI->config->item('table_institute'));
        
 
    if ($query->num_rows() > 0){
        $this->form_validation->set_message('isEMExist', 'This %s already registred');
        return FALSE;
    }
    else{
        return TRUE;
    }
}

    
}
