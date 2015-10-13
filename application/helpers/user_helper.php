<?php

class User_helper
{
    public static $logged_user = null;
    function __construct($user)
    {
        $CI = & get_instance();
        foreach ($user as $key => $value)
        {
            $this->$key = $value;
        }
        $this->template_name='default';
        $template = $CI->db->get_where($CI->config->item('table_template'), array('id' => $this->template_id,'status'=>1))->row();
        if($template)
        {
            $this->template_name=$template->name;
        }
        $this->language_name='english';
        $this->language_code='en';
        $language = $CI->db->get_where($CI->config->item('table_language'), array('id' => $this->language_id,'status'=>1))->row();
        if($language)
        {
            $this->language_name=$language->name;
            $this->language_code=$language->language_code;
        }


    }
    public static function login($username, $password)
    {
        $CI = & get_instance();
        $user = $CI->db->get_where($CI->config->item('table_users'), array('username' => $username, 'password' => md5($password),'status'=>2))->row();
        if ($user)
        {
            $CI->session->set_userdata("system_user_id", $user->id);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }



    public static function get_user()
    {
        $CI = & get_instance();
        if (User_helper::$logged_user)
        {
            return User_helper::$logged_user;
        }
        else
        {
            if($CI->session->has_userdata("system_user_id"))
            {
                $CI->db->from($CI->config->item('table_users').' users');
                $CI->db->where('id',$CI->session->userdata("system_user_id"));
                $CI->db->where('status',2);
                $user = $CI->db->get()->row();
                if ($user)
                {
                    /*foreach ($user as $key => $value)
                    {
                        $this->$key = $value;
                    }*/
                    User_helper::$logged_user = new User_helper($user);
                    return User_helper::$logged_user;
                }
                else
                {
                    return null;
                }

            }
            else
            {
                return null;
            }

        }
    }
    public static function get_task($position=null,$action='list')
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        $CI->db->from($CI->config->item('table_task').' task');
        $CI->db->select('task.id,task.component_id,task.module_id,task.controller,task.icon task_icon');
        $CI->db->select('task.name_'.$CI->get_language_code().' task_name');
        $CI->db->select('c.name_'.$CI->get_language_code().' component_name , c.icon component_icon');
        $CI->db->select('m.name_'.$CI->get_language_code().' module_name, m.icon module_icon');

        $CI->db->select('ugr.id role_id,ugr.user_group_id');
        $CI->db->join($CI->config->item('table_user_group_role').' ugr','ugr.task_id = task.id',"INNER");
        $CI->db->join($CI->config->item('table_component').' c','c.id = task.component_id',"INNER");
        $CI->db->join($CI->config->item('table_module').' m','m.id = task.module_id',"INNER");
        $CI->db->where('ugr.user_group_id',$user->user_group_id);
        $CI->db->where('c.id !=',$CI->config->item('report_component_id'));

        $CI->db->where('task.status',1);
        $CI->db->where('m.status',1);
        $CI->db->where('c.status',1);
        if($position)
        {
            $CI->db->where('task.'.$position,1);
        }
        if($action)
        {
            $CI->db->where('ugr.'.$action,1);
        }
        $CI->db->order_by('c.ordering ASC');
        $CI->db->order_by('m.ordering ASC');
        $CI->db->order_by('task.ordering ASC');
        $tasks=$CI->db->get()->result_array();
        return $tasks;

    }
    public static function get_task_module($position=null,$action='list')
    {
        $tasks=User_helper::get_task($position,$action);
        $modules=array();
        foreach($tasks as $task)
        {
            $modules[$task['module_id']]['component_id']=$task['component_id'];
            $modules[$task['module_id']]['component_name']=$task['component_name'];
            $modules[$task['module_id']]['module_name']=$task['module_name'];
            $modules[$task['module_id']]['id']=$task['module_id'];
            $modules[$task['module_id']]['module_icon']=$task['module_icon'];
            $modules[$task['module_id']]['component_icon']=$task['component_icon'];
            $modules[$task['module_id']]['tasks'][]=$task;
        }
        return $modules;
    }
    public static function get_task_module_component($position=null,$action='list')
    {
        $modules=User_helper::get_task_module($position,$action);
        $components=array();
        foreach($modules as $module)
        {
            $components[$module['component_id']]['id']=$module['component_id'];
            $components[$module['component_id']]['component_name']=$module['component_name'];
            $components[$module['component_id']]['component_icon']=$module['component_icon'];
            $components[$module['component_id']]['modules'][]=$module;
        }
        return $components;
    }

    public static function get_uisc_info()
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->where('uisc_infos.id', $user->uisc_id);
        $uisc = $CI->db->get()->row();
        return $uisc;
    }
    public static function get_report_tasks()
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        $CI->db->from($CI->config->item('table_task').' task');
        $CI->db->select('task.id,task.component_id,task.module_id,task.controller,task.icon task_icon');
        $CI->db->select('task.name_'.$CI->get_language_code().' task_name');
        $CI->db->select('c.name_'.$CI->get_language_code().' component_name , c.icon component_icon');
        $CI->db->select('m.name_'.$CI->get_language_code().' module_name, m.icon module_icon');

        $CI->db->select('ugr.id role_id,ugr.user_group_id');
        $CI->db->join($CI->config->item('table_user_group_role').' ugr','ugr.task_id = task.id',"INNER");
        $CI->db->join($CI->config->item('table_component').' c','c.id = task.component_id',"INNER");
        $CI->db->join($CI->config->item('table_module').' m','m.id = task.module_id',"INNER");
        $CI->db->where('ugr.user_group_id',$user->user_group_id);
        $CI->db->where('c.id =',$CI->config->item('report_component_id'));

        $CI->db->where('task.status',1);
        $CI->db->where('m.status',1);
        $CI->db->where('c.status',1);
        $CI->db->where('ugr.view',1);
        $CI->db->order_by('c.ordering ASC');
        $CI->db->order_by('m.ordering ASC');
        $CI->db->order_by('task.ordering ASC');
        $tasks=$CI->db->get()->result_array();
        return $tasks;

    }
    public static function get_reports_task_module()
    {
        $tasks=User_helper::get_report_tasks();
        $modules=array();
        foreach($tasks as $task)
        {
            $modules[$task['module_id']]['component_id']=$task['component_id'];
            $modules[$task['module_id']]['component_name']=$task['component_name'];
            $modules[$task['module_id']]['module_name']=$task['module_name'];
            $modules[$task['module_id']]['id']=$task['module_id'];
            $modules[$task['module_id']]['module_icon']=$task['module_icon'];
            $modules[$task['module_id']]['component_icon']=$task['component_icon'];
            $modules[$task['module_id']]['tasks'][]=$task;
        }
        return $modules;
    }
    /*public static function get_center_count()
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        if($user->user_group_id==$CI->config->item('UISC_GROUP_ID'))
        {
            return 1;
        }

        $CI->db->from($CI->config->item('table_uisc_infos').' uisc_infos');
        $CI->db->where('uisc_infos.status', 1);
        if($user->user_group_id==$CI->config->item('DIVISION_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
        }
        else if($user->user_group_id==$CI->config->item('DISTRICT_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
        }
        else if($user->user_group_id==$CI->config->item('UPAZILLA_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
            $CI->db->where('uisc_infos.upazilla', $user->upazilla);
        }
        else if($user->user_group_id==$CI->config->item('UNION_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
            $CI->db->where('uisc_infos.upazilla', $user->upazilla);
            $CI->db->where('uisc_infos.union', $user->union);
        }
        else if($user->user_group_id==$CI->config->item('CITY_CORPORATION_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
            $CI->db->where('uisc_infos.citycorporation', $user->citycorporation);
        }
        else if($user->user_group_id==$CI->config->item('CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
            $CI->db->where('uisc_infos.citycorporation', $user->citycorporation);
            $CI->db->where('uisc_infos.citycorporationward', $user->citycorporationward);
        }
        else if($user->user_group_id==$CI->config->item('MUNICIPAL_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
            $CI->db->where('uisc_infos.municipal', $user->municipal);
        }
        else if($user->user_group_id==$CI->config->item('MUNICIPAL_WORD_GROUP_ID'))
        {
            $CI->db->where('uisc_infos.division', $user->division);
            $CI->db->where('uisc_infos.zilla', $user->zilla);
            $CI->db->where('uisc_infos.municipal', $user->municipal);
            $CI->db->where('uisc_infos.municipalward', $user->municipalward);
        }
        return $CI->db->count_all_results();
    }*/

    /*public static function get_uisc_user_count($gender=0)
    {
        $CI = & get_instance();
        $user=User_helper::get_user();


        $CI->db->from($CI->config->item('core_01_users').' users');
        $CI->db->where('users.status', 1);
        $CI->db->where('users.user_group_id', $CI->config->item('UISC_GROUP_ID'));
        if($gender)
        {
            $CI->db->where('users.gender', $gender);
        }

        if($user->user_group_id==$CI->config->item('DIVISION_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
        }
        else if($user->user_group_id==$CI->config->item('DISTRICT_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
        }
        else if($user->user_group_id==$CI->config->item('UPAZILLA_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
            $CI->db->where('users.upazilla', $user->upazilla);
        }
        else if($user->user_group_id==$CI->config->item('UNION_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
            $CI->db->where('users.upazilla', $user->upazilla);
            $CI->db->where('users.union', $user->union);
        }
        else if($user->user_group_id==$CI->config->item('CITY_CORPORATION_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
            $CI->db->where('users.citycorporation', $user->citycorporation);
        }
        else if($user->user_group_id==$CI->config->item('CITY_CORPORATION_WORD_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
            $CI->db->where('users.citycorporation', $user->citycorporation);
            $CI->db->where('users.citycorporationward', $user->citycorporationward);
        }
        else if($user->user_group_id==$CI->config->item('MUNICIPAL_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
            $CI->db->where('users.municipal', $user->municipal);
        }
        else if($user->user_group_id==$CI->config->item('MUNICIPAL_WORD_GROUP_ID'))
        {
            $CI->db->where('users.division', $user->division);
            $CI->db->where('users.zilla', $user->zilla);
            $CI->db->where('users.municipal', $user->municipal);
            $CI->db->where('users.municipalward', $user->municipalward);
        }
        return $CI->db->count_all_results();
    }*/
    /*public static function get_total_services()
    {
        $CI = & get_instance();
        $user=User_helper::get_user();

        $CI->db->from($CI->config->item('table_services').' services');
        $CI->db->where('services.status', 1);
        $total=$CI->db->count_all_results();
        //need to count proposed services
        return $total;
    }*/

}