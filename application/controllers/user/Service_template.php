<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

class Service_template extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('user/Service_template');
        $this->controller_url='user/Service_template';
        $this->load->model("user/Service_template_model");
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='add')
        {
            $this->dcms_add();
        }
        elseif($action=='save')
        {
            $this->dcms_save();
        }
        elseif($action=='excel_download')
        {
            $this->excel_download();
        }
        else
        {
            $this->current_action='add';
            $this->dcms_add();
        }
    }

    private function dcms_add()
    {
        if($this->permissions['add'])
        {
            $this->current_action='add';
            $ajax['status']=true;
            $data=array();
            $data['title']=$this->lang->line("PROTIBEDON_DAKHIL");

            $data['services'] = $this->Service_template_model->get_uisc_services();
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user/service_template/dcms_add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('user/service_template/index/add');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_save()
    {
        $user = User_helper::get_user();

        $invoice_data = array();
        $zilla_invoice_data = array();
        $invoice_details_data = array();
        $zilla_invoice_details_data = array();

        $user_zilla = str_pad($user->zilla, 2, "0", STR_PAD_LEFT);
        $zilla_table_invoice = $user_zilla.'_invoices';
        $zilla_table_invoice_details = $user_zilla.'_invoice_details';

        $uisc_id = $user->uisc_id;
        $user_group_id = $user->user_group_id;
        $division = $user->division;
        $zilla = $user->zilla;
        $upazila = $user->upazila;
        $unioun = $user->unioun;
        $citycorporation = $user->citycorporation;
        //$citycorporationward = $user->citycorporationward;
        $municipal = $user->municipal;
        //$municipalward = $user->municipalward;

        $invoice_date = $this->input->post('report_date');
        $customerPost = $this->input->post('customer_name');
        $servicePost = $this->input->post('service_sername');
        $genderPost = $this->input->post('customer_gender');
        $earningPost = $this->input->post('service_earning');

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $count = sizeof($customerPost);
            $total_income = 0;
            $total_men = 0;
            $total_women = 0;
            $total_service = 0;

            for($i=0; $i<$count; $i++)
            {
                $total_income += System_helper::Get_Bng_to_Eng($earningPost[$i]);
                $receiver_sex = $genderPost[$i];
                $total_service++;

                if($receiver_sex == $this->lang->line('MALE_VAL'))
                {
                    $total_men++;
                }
                elseif($receiver_sex == $this->lang->line('FEMALE_VAL'))
                {
                    $total_women++;
                }
            }

            $invoice_data['uisc_id'] = $uisc_id;
            $invoice_data['unionid'] = $unioun;
            $invoice_data['municipalid'] = $municipal;
            $invoice_data['citycorporationid'] = $citycorporation;
            $invoice_data['upazilaid'] = $upazila;
            $invoice_data['zillaid'] = $zilla;
            $invoice_data['divid'] = $division;
            $invoice_data['type'] = $user_group_id;
            $invoice_data['invoice_date'] = $invoice_date;
            $invoice_data['total_income'] = $total_income;
            $invoice_data['total_service'] = $total_service;
            $invoice_data['total_men'] = $total_men;
            $invoice_data['total_women'] = $total_women;

            $zilla_invoice_data['uisc_id'] = $uisc_id;
            $zilla_invoice_data['unionid'] = $unioun;
            $zilla_invoice_data['municipalid'] = $municipal;
            $zilla_invoice_data['citycorporationid'] = $citycorporation;
            $zilla_invoice_data['upazilaid'] = $upazila;
            $zilla_invoice_data['zillaid'] = $zilla;
            $zilla_invoice_data['divid'] = $division;
            $zilla_invoice_data['type'] = $user_group_id;
            $zilla_invoice_data['invoice_date'] = $invoice_date;
            $zilla_invoice_data['total_income'] = $total_income;
            $zilla_invoice_data['total_service'] = $total_service;
            $zilla_invoice_data['total_men'] = $total_men;
            $zilla_invoice_data['total_women'] = $total_women;

            $this->db->trans_start();  //DB Transaction Handle START

            $invoice_id = Query_helper::add('invoices', $invoice_data);
            $zilla_invoice_id = Query_helper::add($zilla_table_invoice, $zilla_invoice_data);

            for($i=0; $i<$count; $i++)
            {
                $invoice_details_data['invoice_id'] = $invoice_id;
                $invoice_details_data['receiver_name'] = $customerPost[$i];
                $invoice_details_data['receiver_sex'] = $genderPost[$i];
                $invoice_details_data['service_id'] = $servicePost[$i];
                $invoice_details_data['income'] = System_helper::Get_Bng_to_Eng($earningPost[$i]);
                $invoice_details_data['service_name'] = $this->Service_template_model->get_service_name($servicePost[$i]);

                $zilla_invoice_details_data['invoice_id'] = $zilla_invoice_id;
                $zilla_invoice_details_data['receiver_name'] = $customerPost[$i];
                $zilla_invoice_details_data['receiver_sex'] = $genderPost[$i];
                $zilla_invoice_details_data['service_id'] = $servicePost[$i];
                $zilla_invoice_details_data['income'] = System_helper::Get_Bng_to_Eng($earningPost[$i]);
                $zilla_invoice_details_data['service_name'] = $this->Service_template_model->get_service_name($servicePost[$i]);

                Query_helper::add('invoice_details', $invoice_details_data);
                Query_helper::add($zilla_table_invoice_details, $zilla_invoice_details_data);
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if($this->db->trans_status() === TRUE)
            {
                $this->message = $this->lang->line("MSG_CREATE_SUCCESS");
                $this->dcms_add();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                $this->jsonReturn($ajax);
            }
        }
    }

    public function upload_excel_file()
    {
        $user = User_helper::get_user();

        if ($_FILES["file"]['name'] != "")
        {
            $arr = explode(".", $_FILES["file"]['name']);
            $ext = $arr[sizeof($arr)-1];
        }

        $size = $_FILES["file"]['size'];

        $this->load->library('upload');
        $fileName = 'template_' . $user->id . '_' . date('Ymdhis');

        if ($this->Service_template_model->chk_existing_uploded_excel_file() < 2)
        {
            if (($ext == 'xls') || ($ext == 'xlsx'))
            {
                System_helper::upload_excel_file($fileName, $save_dir="uploads/excel",$max_size=60000,$types='xls|xlsx');

                if ($ext == 'xls')
                {
                    $path = "uploads/excel/" . $fileName . '.xls';
                }
                else
                {
                    $path = "uploads/excel/" . $fileName . '.xlsx';
                }

                if($size < 60000)
                {
                    $i = 0;
                    $totalcount = 0;
                    $objPHPExcel = PHPExcel_IOFactory::load($path);

                    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
                    {
                        $worksheetTitle = $worksheet->getTitle();
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();

                        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                        $nrColumns = ord($highestColumn) - 64;

//                        echo "<br>The worksheet " . $worksheetTitle . " has ";
//                        echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
//                        echo ' and ' . $highestRow . ' row.';
//                        echo '<br>Data: <table border="1"><tr>';

                        for ($row = 1; $row <= $highestRow; ++$row)
                        {
//                            echo '<tr>';
                            for ($col = 0; $col < $highestColumnIndex; ++$col)
                            {
                                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                                $val = $cell->getValue();
                                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
//                                echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
                            }
//                            echo '</tr>';
                        }
//                        echo '</table>';
                    }

                    $total_men = 0;
                    $total_women = 0;
                    $total_services = 0;
                    $total_income = 0;

                    for($row = 3; $row <= $highestRow; ++$row)
                    {
                        $val = array();
                        for ($col = 0; $col < $highestColumnIndex; ++$col)
                        {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val[] = $cell->getValue();
                        }

                        if ($val[0] != "" && $val[0] != null)
                        {
                            $serial[$i] = System_helper::Get_Bng_to_Eng($val[0]);
                            $customer_name[$i] = $val[1];
                            $gender[$i] = $val[2];
                            $service_name[$i] = $val[3];
                            $amount[$i] = System_helper::Get_Bng_to_Eng($val[4]);
                            $totalcount = $totalcount + $i;
                            $total_services++;

                            $total_income = $total_income + System_helper::Get_Bng_to_Eng($amount[$i]);

                            if($gender[$i] == $this->lang->line('MALE_VAL'))
                            {
                                $total_men++;
                            }
                            elseif($gender[$i] == $this->lang->line('FEMALE_VAL'))
                            {
                                $total_women++;
                            }
                            ++$i;
                        }
                    }

                    $DateCell = $worksheet->getCellByColumnAndRow('1', '1');
                    $invDateRaw = $DateCell->getValue();

                    if(is_float($invDateRaw))
                    {
                        $newDate = System_helper::ExcelToPHPDate($invDateRaw);
                        $invDate = date('Y-m-d', $newDate);
                    }
                    else
                    {
                        $invDate = $invDateRaw;
                    }

                    $invoice_data = array();
                    $zilla_invoice_data = array();
                    $invoice_details_data = array();
                    $zilla_invoice_details_data = array();

                    $user_zilla = $user->zilla;
                    $zilla_table_invoice = str_pad($user_zilla, 2, "0", STR_PAD_LEFT).'_invoices';
                    $zilla_table_invoice_details = str_pad($user_zilla, 2, "0", STR_PAD_LEFT).'_invoice_details';

                    $uisc_id = $user->uisc_id;
                    $user_group_id = $user->user_group_id;
                    $division = $user->division;
                    $zilla = $user->zilla;
                    $upazila = $user->upazila;
                    $unioun = $user->unioun;
                    $citycorporation = $user->citycorporation;
                    //$citycorporationward = $user->citycorporationward;
                    $municipal = $user->municipal;
                    //$municipalward = $user->municipalward;

                    $invoice_date = $invDate;
                    $customerPost = $customer_name;
                    $servicePost = $service_name;
                    $genderPost = $gender;
                    $earningPost = $amount;
                    $count = sizeof($customerPost);

                    $invoice_data['uisc_id'] = $uisc_id;
                    $invoice_data['unionid'] = $unioun;
                    $invoice_data['municipalid'] = $municipal;
                    $invoice_data['citycorporationid'] = $citycorporation;
                    $invoice_data['upazilaid'] = $upazila;
                    $invoice_data['zillaid'] = $zilla;
                    $invoice_data['divid'] = $division;
                    $invoice_data['type'] = $user_group_id;
                    $invoice_data['invoice_date'] = $invoice_date;
                    $invoice_data['total_income'] = $total_income;
                    $invoice_data['total_service'] = $total_services;
                    $invoice_data['total_men'] = $total_men;
                    $invoice_data['total_women'] = $total_women;

                    $zilla_invoice_data['uisc_id'] = $uisc_id;
                    $zilla_invoice_data['unionid'] = $unioun;
                    $zilla_invoice_data['municipalid'] = $municipal;
                    $zilla_invoice_data['citycorporationid'] = $citycorporation;
                    $zilla_invoice_data['upazilaid'] = $upazila;
                    $zilla_invoice_data['zillaid'] = $zilla;
                    $zilla_invoice_data['divid'] = $division;
                    $zilla_invoice_data['type'] = $user_group_id;
                    $zilla_invoice_data['invoice_date'] = $invoice_date;
                    $zilla_invoice_data['total_income'] = $total_income;
                    $zilla_invoice_data['total_service'] = $total_services;
                    $zilla_invoice_data['total_men'] = $total_men;
                    $zilla_invoice_data['total_women'] = $total_women;

//                    echo $zilla_table_invoice;
//                    print_r($zilla_invoice_data);exit;

                    $this->db->trans_start();  //DB Transaction Handle START

                    $invoice_id = Query_helper::add('invoices', $invoice_data);
                    $zilla_invoice_id = Query_helper::add($zilla_table_invoice, $zilla_invoice_data);

                    for($i=0; $i<$count; $i++)
                    {
                        $invoice_details_data['invoice_id'] = $invoice_id;
                        $invoice_details_data['receiver_name'] = $customerPost[$i];
                        $invoice_details_data['receiver_sex'] = $genderPost[$i];
                        $invoice_details_data['service_id'] = $this->Service_template_model->get_service_id($servicePost[$i]);
                        $invoice_details_data['income'] = System_helper::Get_Bng_to_Eng($earningPost[$i]);
                        $invoice_details_data['service_name'] = $this->Service_template_model->get_service_name($servicePost[$i]);

                        $zilla_invoice_details_data['invoice_id'] = $zilla_invoice_id;
                        $zilla_invoice_details_data['receiver_name'] = $customerPost[$i];
                        $zilla_invoice_details_data['receiver_sex'] = $genderPost[$i];
                        $zilla_invoice_details_data['service_id'] = $this->Service_template_model->get_service_id($servicePost[$i]);
                        $zilla_invoice_details_data['income'] = System_helper::Get_Bng_to_Eng($earningPost[$i]);
                        $zilla_invoice_details_data['service_name'] = $this->Service_template_model->get_service_name($servicePost[$i]);

                        Query_helper::add('invoice_details', $invoice_details_data);
                        Query_helper::add($zilla_table_invoice_details, $zilla_invoice_details_data);
                    }

                    $fileInfo = array(
                        'user_id' => $user->id,
                        'uisc_id' => $uisc_id,
                        'file_name' => $fileName,
                        'upload_date' => strtotime(date('Y-m-d'))
                    );

                    Query_helper::add($this->config->item('table_excel_history'), $fileInfo);

                    $this->db->trans_complete();   //DB Transaction Handle END

                    if($this->db->trans_status() === TRUE)
                    {
                        $this->message = $this->lang->line("MSG_CREATE_SUCCESS");
                        $this->dcms_add();
                    }
                    else
                    {
                        $ajax['status']=false;
                        $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                        $this->jsonReturn($ajax);
                    }
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_MAX_SIZE");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_EXCEL_ONLY");
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("MSG_MAXIMUM_NUMBER_OF_FILES");
            $this->jsonReturn($ajax);
        }

    }

    private function check_validation()
    {
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules('name_en','Name English','required');
//        $this->form_validation->set_rules('name_bn','Name Bangla','required');
//        $this->form_validation->set_rules('ordering','Ordering','integer|max_length[3]');
//        if($this->form_validation->run() == FALSE)
//        {
//            $this->message=validation_errors();
//            return false;
//        }
        return true;
    }

}
