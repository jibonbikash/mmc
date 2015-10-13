<?php
class Query_helper
{
    public static function add($tablename,$data)
    {
        $CI =& get_instance();
        $CI->db->insert($tablename, $data);
        $query=$CI->db->last_query();
        $user = User_helper::get_user();

        if($user)
        {
            if($CI->db->affected_rows() >0)
            {
                $id = $CI->db->insert_id();

                $historyData = Array(
                    'table_id'=>$id,
                    'table_name'=>$tablename,
                    'data'=>json_encode($data),
                    'user_id'=>$user->id,
                    'action'=>'INSERT',
                    'date'=>time(),
                    'query'=>$query,
                    'status'=>0
                );

                $CI->db->insert($CI->config->item('table_history'), $historyData);
                return $id;
            }
            else
            {
                return false;
            }
        }
        else
        {
            if($CI->db->affected_rows() >0)
            {
                $id = $CI->db->insert_id();

                $historyData = Array(
                    'table_id'=>$id,
                    'table_name'=>$tablename,
                    'data'=>json_encode($data),
                    'user_id'=>'',
                    'action'=>'INSERT',
                    'date'=>time(),
                    'query'=>$query,
                    'status'=>0
                );

                $CI->db->insert($CI->config->item('table_history'), $historyData);
                return $id;
            }
            else
            {
                return false;
            }
        }
    }

    public static  function update($tablename,$data,$conditions)
    {
        $CI =& get_instance();
        foreach($conditions as $condition)
        {
            $CI->db->where($condition);

        }
        $rows=$CI->db->get($tablename)->result_array();


        foreach($conditions as $condition)
        {
            $CI->db->where($condition);

        }
        $CI->db->update($tablename, $data);
        $query=$CI->db->last_query();

        if($CI->db->affected_rows() >0)
        {
            $user = User_helper::get_user();
            $time=time();
            $pk='id';
            if(!$CI->db->field_exists($pk, $tablename))
            {
                $pk='';
                $fields = $CI->db->field_data($tablename);
                foreach ($fields as $field)
                {
                    if($field->primary_key)
                    {
                        $pk=$field->name;
                        break;
                    }
                }

            }
            if(!$pk)
            {
                return true;
            }

            foreach($rows as $row)
            {
                $historyData = Array(
                    'table_id'=>$row[$pk],
                    'table_name'=>$tablename,
                    'data'=>json_encode($data),
                    'user_id'=>$user->id,
                    'action'=>'UPDATE',
                    'date'=>$time,
                    'query'=>$query,
                    'status'=>0
                );
                $CI->db->insert($CI->config->item('table_history'), $historyData);
            }

            return true;

        }
        else
        {

            return false;
        }

    }

    public static  function delete($tablename,$conditions)
    {
        //delete query no need for our system

    }



    public static function get_info($tablename,$fieldnames,$conditions,$limit=0,$start=0)
    {
        $CI =& get_instance();

        if(is_array($fieldnames))
        {
            foreach($fieldnames as $fieldname)
            {
                $CI->db->select($fieldname);

            }
        }
        else
        {
            $CI->db->select($fieldnames);

        }

        foreach($conditions as $condition)
        {
            $CI->db->where($condition);
        }
        if($limit==0)
        {
            return $CI->db->get($tablename)->result_array();
        }
        if($limit==1)
        {
            return $CI->db->get($tablename)->row_array();
        }
        else
        {
            $CI->db->limit($limit,$start);
            return $CI->db->get($tablename)->result_array();
        }

    }

}