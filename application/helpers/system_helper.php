<?php
class System_helper
{
    public static function display_date($time)
    {
        if($time>0)
        {
            return date('Y-m-d',$time);
        }
        else
        {
            return '';
        }

    }

    public static function get_time($str)
    {
        $time=strtotime($str);
        if($time===false)
        {
            return 0;
        }
        else
        {
            return $time;
        }
    }

    public static function display_time($time)
    {
        if(isset($time) && !empty($time))
        {
            return date("h:i:s", $time);
        }
        else
        {
            return false;
        }
    }

    public static function getDateRangeArray($sStartDate, $sEndDate)
    {
        $sStartDate = date("Y-m-d", strtotime($sStartDate));
        $sEndDate = date("Y-m-d", strtotime($sEndDate));

        $aDays[] = $sStartDate;
        $sCurrentDate = $sStartDate;

        while($sCurrentDate < $sEndDate)
        {
            $sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
            $aDays[] = $sCurrentDate;
        }

        return $aDays;
    }

    public static function cal_date_config($dat, $mon, $yr)
    {
        if (strlen($dat) == 1)
        {
            $day = "0" . $dat;
        }
        else
        {
            $day = $dat;
        }

        if(strlen($mon) == 1)
        {
            $month = "0" . $mon;
        }
        else
        {
            $month = $mon;
        }

        $date = $yr . "-" . $month . "-" . $day;
        return $date;
    }

    public static function get_class_value($class_id)
    {
        $CI = & get_instance();

        $CI->db->from($CI->config->item('table_class').' tc');
        $CI->db->select('tc.value');
        $CI->db->where('tc.id',$class_id);
        $result = $CI->db->get()->row_array();
        if($result)
        {
            return $result['value'];
        }
        else
        {
            null;
        }
    }

    public static function upload_file($save_dir="images",$max_size=10240,$types='gif|jpg|png')
    {
        $CI = & get_instance();
        $CI->load->library('upload');
        $config=array();
        $config['upload_path'] = FCPATH.$save_dir;
        $config['allowed_types'] = $types;
        $config['max_size'] = $max_size;
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;

        $uploaded_files=array();
        foreach ($_FILES as $key => $value)
        {
            if(strlen($value['name'])>0)
            {
                $CI->upload->initialize($config);
                if (!$CI->upload->do_upload($key))
                {
                    $uploaded_files[$key]=array("status"=>false,"message"=>$value['name'].': '.$CI->upload->display_errors());
                }
                else
                {
                    $uploaded_files[$key]=array("status"=>true,"info"=>$CI->upload->data());
                }

            }
        }

        return $uploaded_files;
    }

    public static function upload_excel_file($fileName, $save_dir="uploads/excel",$max_size=60000,$types='xls|xlsx')
    {
        $CI = & get_instance();
        $CI->load->library('upload');
        $config=array();
        $config['upload_path'] = FCPATH.$save_dir;
        $config['allowed_types'] = $types;
        $config['max_size'] = $max_size;
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['file_name'] = "$fileName";

        $uploaded_files=array();
        foreach ($_FILES as $key => $value)
        {
            if(strlen($value['name'])>0)
            {
                $CI->upload->initialize($config);
                if (!$CI->upload->do_upload($key))
                {
                    $uploaded_files[$key]=array("status"=>false,"message"=>$value['name'].': '.$CI->upload->display_errors());
                }
                else
                {
                    $uploaded_files[$key]=array("status"=>true,"info"=>$CI->upload->data());
                }
            }
        }

        return $uploaded_files;
    }

    public static function get_time_string($hour, $minute,$date="2001-01-01")
    {
        if(empty($hour))
        {
            $hour="00";
        }
        else
        {
            $hour=$hour;
        }
        if(empty($minute))
        {
            $minute="00";
        }
        else
        {
            $minute=$minute;
        }
        $time=$date.' '.$hour.":".$minute.":00";
        if(strtotime($time))
        {
            return strtotime($time);
        }
        else
        {
            return false;
        }
    }

    public static function Get_Eng_to_Bng($str = NULL)
    {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, '');
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', '');
        $converted = str_replace($engNumber, $bangNumber, $str);
        return $converted;
    }


    public static function Get_Bng_to_Eng($str = NULL)
    {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, '');
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', '');
        $converted = str_replace($bangNumber, $engNumber, $str);
        return $converted;
    }


    public static function Get_Bangla_Month($Month = NULL)
    {
        $monthName = array('01' => 'জানুয়ারি',
            '02' => 'ফেব্রুয়ারি',
            '03' => 'মার্চ',
            '04' => 'এপ্রিল',
            '05' => 'মে',
            '06' => 'জুন',
            '07' => 'জুলাই',
            '08' => 'আগষ্ট',
            '09' => 'সেপ্টেম্বর',
            '10' => 'অক্টোবর',
            '11' => 'নভেম্বর',
            '12' => 'ডিসেম্বর',
            '1' => 'জানুয়ারি',
            '2' => 'ফেব্রুয়ারি',
            '3' => 'মার্চ',
            '4' => 'এপ্রিল',
            '5' => 'মে',
            '6' => 'জুন',
            '7' => 'জুলাই',
            '8' => 'আগষ্ট',
            '9' => 'সেপ্টেম্বর');
        return $monthName[$Month];
    }

    public static function get_pdf($html)
    {
        include(FCPATH."mpdf/mpdf.php");
        $mpdf=new mPDF();
        $mpdf->useAdobeCJK=true;
        $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->WriteHTML(file_get_contents(base_url().'assets/templates/default/fonts/mpdf.css'),1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();

    }

    public static function ExcelToPHPDate($invDate = 0)
    {
        $myExcelBaseDate = 25569;

        if($invDate < 60)
        {
            --$myExcelBaseDate;
        }

        if ($invDate >= 1)
        {
            $utcDays = $invDate - $myExcelBaseDate;
            $returnValue = round($utcDays * 86400);
            if(($returnValue <= PHP_INT_MAX) && ($returnValue >= -PHP_INT_MAX))
            {
                $returnValue = (integer) $returnValue;
            }
        }
        else
        {
            $hours = round($invDate * 24);
            $mins = round($invDate * 1440) - round($hours * 60);
            $secs = round($invDate * 86400) - round($hours * 3600) - round($mins * 60);
            $returnValue = (integer) gmmktime($hours, $mins, $secs);
        }

        return $returnValue;
    }
}