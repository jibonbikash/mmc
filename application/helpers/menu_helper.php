<?php

class Menu_helper
{
    public static function get_permission($controller_name)
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        $CI->db->from($CI->config->item('table_user_group_role').' ugr');
        $CI->db->select('ugr.*');

        $CI->db->join($CI->config->item('table_task').' task','task.id = ugr.task_id','INNER');
        $CI->db->like("controller",$controller_name,"after");
        $CI->db->where("user_group_id",$user->user_group_id);
        $result=$CI->db->get()->row_array();
        return $result;
    }

    public static function convert_dropDown_array($array)
    {
        $dropDown  = Array();
        foreach($array as $value=>$text)
        {
            $dropDown[] = array('value'=>$value, 'text'=>$text);
        }
        return $dropDown;
    }
}