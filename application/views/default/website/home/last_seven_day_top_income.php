<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
//echo "<pre>";
//print_r($report_records);
//echo "</pre>";
$end_date = date('Y-m-d', time());

$newdate_0 = strtotime('0 day', strtotime($end_date));
$newdate6 = strtotime('-6 day', strtotime($end_date));
$srt_date_0 = date('d-m-Y', $newdate_0);
$srt_date6 = date('d-m-Y', $newdate6);
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/templates/default/css/bootstrap.min.css">

<div class="clearfix"></div>
<div class="container">
    <div class="main_container">
        <div class="row show-grid hidden-print">
            <a class="btn btn-primary btn-rect pull-right" href="<?php echo $pdf_link;?>"><?php echo $this->lang->line("BUTTON_PDF"); ?></a>
            <a class="btn btn-primary btn-rect pull-right" style="margin-right: 10px;" href="javascript:window.print();"><?php echo $this->lang->line("BUTTON_PRINT"); ?></a>
            <div class="clearfix"></div>
            <span class="pull-right"><?php echo $this->lang->line('REPORT_CURRENT_DATE_VIEW');?></span>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-12 text-center">
                <h4><?php echo $this->lang->line('REPORT_HEADER_TITLE');?></h4>
                <h5><?php echo sprintf($this->lang->line('LAST_SEVEN_DAYS_TOP_INCOME_TITLE'),System_helper::Get_Eng_to_Bng($srt_date6)." -- ".System_helper::Get_Eng_to_Bng($srt_date_0));?></h5>
            </div>
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('SERIAL');?></th>
                    <th><?php echo $this->lang->line('UNION');?></th>
                    <th><?php echo $this->lang->line('UPAZILLA');?></th>
                    <th><?php echo $this->lang->line('MUNICIPALITY');?></th>
                    <th><?php echo $this->lang->line('ZILLA');?></th>
                    <th><?php echo $this->lang->line('CITY_CORPORATION');?></th>
                    <th><?php echo $this->lang->line('TOTAL_INCOME');?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(empty($report_records))
                {
                    ?>
                    <tr>
                        <td colspan="21" style="color: red; text-align: center;"><?php echo $this->lang->line('DATA_NOT_FOUND');?></td>
                    </tr>
                <?php
                }
                else
                {
                    $i=0;
                    foreach ($report_records as $report_record)
                    {
                        ++$i;
                        ?>
                        <tr>
                            <td align='center'><?php echo System_helper::Get_Eng_to_Bng($i); ?></td>
                            <td align='center'><?php echo $report_record['unionname'] ?></td>
                            <td align='center'><?php echo $report_record['upazilaname'] ?></td>
                            <td align='center'><?php echo $report_record['municipalname'] ?></td>
                            <td align='center'><?php echo $report_record['zillaname'] ?></td>
                            <td align='center'><?php echo $report_record['citycorporationname'] ?></td>
                            <td align='center'><?php echo System_helper::Get_Eng_to_Bng($report_record['total_income']) ?></td>
                        </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
