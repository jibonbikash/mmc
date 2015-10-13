<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
echo "<pre>";
//print_r($incomes);
echo "</pre>";
?>
<html lang="en">
    <head>
        <title>send title from language file</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templates/default/css/bootstrap.min.css">
    </head>
    <body>
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
                    <h5><?php echo $title;?></h5>
                </div>

                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('DATE');?></th>
                            <th><?php echo $this->lang->line('DETAIL');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(is_array($incomes) && sizeof($incomes)>0)
                    {
                        foreach($incomes as $key=>$income)
                        {
                        ?>
                            <tr>
                                <td><?php echo System_helper::Get_Eng_to_Bng($income['invoice_date']);?></td>
                                <td>
                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th><?php echo $this->lang->line('SERVICE_RECEIVER');?></th>
                                            <th><?php echo $this->lang->line('SERVICE');?></th>
                                            <th><?php echo $this->lang->line('SERVICE_INCOME_TAKA');?></th>
                                        </tr>
                                        <?php
                                        $details = Website_helper::get_service_income_detail($income['invoice_id']);

                                        if(is_array($details) && sizeof($details)>0)
                                        {
                                            $total = 0;
                                            foreach($details as $detail)
                                            {
                                            ?>
                                            <tr>
                                                <td><?php echo $detail['receiver_name']?></td>
                                                <td><?php echo $detail['uisc_service_name']?></td>
                                                <td><?php echo System_helper::Get_Eng_to_Bng($detail['income']);?></td>
                                            </tr>

                                                <?php
                                                $total +=$detail['income'];
                                            }
                                            ?>
                                            <tr>
                                                <th></th>
                                                <th><?php echo $this->lang->line('TOTAL');?></th>
                                                <th><?php echo System_helper::Get_Eng_to_Bng($total);?></th>
                                            </tr>
                                            <?php
                                        }
                                        else
                                        {
                                            echo $this->lang->line('NO_DATA_FOUND');
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    else
                    {
                       echo $this->lang->line('DO_DATA_FOUND');
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>