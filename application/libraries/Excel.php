<?php
/**
 * Created by PhpStorm.
 * User: Mazba
 * Date: 6/4/15
 * Time: 12:25 PM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel/PHPExcel.php";
//require_once APPPATH."/third_party/PHPExcel/PHPExcel/IOFactory.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}