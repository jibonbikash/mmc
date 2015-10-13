<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

class Test_maraj extends CI_Controller
{
    public function index()
    {
        //        $start_date = strtotime("2015-09-01");
        //        $end_date = strtotime("2015-09-31");
        //        $ts=strtotime($date);
        //        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        //echo $start_date = date('Y-m-d', $start_date);
        //echo $end_date = date('Y-m-d', strtotime('next saturday', $start_date));

        $s_date="2015-09-01";
        $e_date="2015-09-31";
        $start_date = strtotime($s_date);
        $end_date = strtotime($e_date);

        $first_start_date = date('Y-m-d', $start_date);
        echo $first_end_date = date('Y-m-d', strtotime('next saturday', $first_start_date));

//        $second_start_date = date('Y-m-d', $first_end_date);
//        $second_end_date = date('Y-m-d', strtotime('next saturday', $first_start_date));
//
//        echo $first_start_date."-".$first_end_date;
//        echo $second_start_date."-".$second_end_date;

    }

}
