<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

class Test extends CI_Controller
{
    public function index()
    {
        $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);

        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        echo $start_week.' '.$end_week ;
    }

}
