<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

class Excel_download extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->lang->load('my');
        $this->load->model("user/Service_template_model");
    }

    public function index()
    {
        $this->load->model("user/Service_template_model");
        $user = User_helper::get_user();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); //0.33
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40); //12
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20); //15.29
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50); //11.71
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30); //5.14

        $objPHPExcel->getProperties()->setCreator("Kamrul Hasan")
            ->setLastModifiedBy("Kamrul Hasan")
            ->setTitle("Service Template")
            ->setSubject("PHPExcel Service Template")
            ->setDescription("Service Template")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");

        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("C2")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("D2")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("E2")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('000000');

        $td = Date('Y-m-d');

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $this->lang->line('DATE_YEAR_MONTH_DATE'))
            ->setCellValue('B1', $td);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', $this->lang->line('SERIAL'))
            ->setCellValue('B2', $this->lang->line('CUSTOMER_NAME'))
            ->setCellValue('C2', $this->lang->line('MALE_FEMALE'))
            ->setCellValue('D2', $this->lang->line('SERVICE_NAME'))
            ->setCellValue('E2', $this->lang->line('MONEY_EARNED_FROM_SERVICE'));

        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->setTitle('Report Template');

        $objPHPExcel->setActiveSheetIndex(0);
        $option = $this->Service_template_model->get_uisc_services();
        $service = '';

        foreach ($option as $value)
        {
            $service .=$value['service_name'] . ",";
        }

        for ($i = 3; $i <= 50; $i++)
        {
            $objValidation = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getDataValidation();
            $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from the drop-down list.');
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list');
            $objValidation->setFormula1('"' . $service . '"');

            $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getDataValidation();
            $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
            $objValidation2->setAllowBlank(false);
            $objValidation2->setShowInputMessage(true);
            $objValidation2->setShowDropDown(true);
            $objValidation2->setPromptTitle('Pick from list');
            $objValidation2->setPrompt('Please pick a value from the drop-down list.');
            $objValidation2->setErrorTitle('Input error');
            $objValidation2->setError('Value is not in list');
            $objValidation2->setFormula1('"পুরুষ,মহিলা"');
        }

        $fileName = 'template_' . $user->uisc_id . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$fileName");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . date('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}
