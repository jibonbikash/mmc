<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
//echo "<pre>";
//print_r($report_lists);
//echo "</pre>";
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
                            <th><?php echo $this->lang->line('DIVISION_NAME');?></th>
                            <th><?php echo $this->lang->line('ZILLA_NAME');?></th>
                            <th><?php echo $this->lang->line('MUNICIPAL_NAME');?></th>
                            <th><?php echo $this->lang->line('MUNICIPAL_WARD_NAME');?></th>
                            <th><?php echo $this->lang->line('IN_TOTAL');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(empty($report_lists))
                        {
                            ?>
                            <tr>
                                <td colspan="21" style="color: red; text-align: center;"><?php echo $this->lang->line('DATA_NOT_FOUND');?></td>
                            </tr>
                        <?php
                        }
                        else
                        {
                            ?>
                            <?php
                            $status="";
                            $show_division=true;
                            $show_zilla=true;
                            $show_upzilla=true;
                            $total_amount=0;
                            $total_zila=0;

                            $total_division=0;

                            $total=0;
                            $total_man=0;
                            $total_woman=0;


                            for ($i = 0; $i < sizeof($report_lists); $i++)
                            {
                                if($i==0)
                                {
                                    $show_division=true;
                                    $show_zilla=true;
                                    $show_upzilla=true;
                                }
                                else
                                {



                                    if($report_lists[$i]['municipalid']!=$report_lists[$i-1]['municipalid'])
                                    {
                                        $show_upzilla=true;

                                        ?>
                                        <tr style="background-color: #cccccc">
                                            <td colspan="2"> &nbsp;</td>
                                            <td ><?php echo $this->lang->line('MUNICIPALITY');?>  </td>
                                            <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                            <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total_amount); ?></td>
                                        </tr>
                                        <?php
                                        $total_amount=0;
                                        $total_amount_man=0;
                                        $total_amount_woman=0;

                                    }
                                    if($report_lists[$i]['zillaid']!=$report_lists[$i-1]['zillaid'])
                                    {
                                        $show_zilla=true;
                                        ?>
                                        <tr style="background-color: #cccccc">
                                            <td> &nbsp;</td>
                                            <td ><?php echo $this->lang->line('ZILLA');?></td>
                                            <td >&nbsp;</td>
                                            <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                            <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total_zila); ?></td>
                                        </tr>
                                        <?php
                                        $total_zila=0;
                                    }
                                    if($report_lists[$i]['divid']!=$report_lists[$i-1]['divid'])
                                    {
                                        $show_division=true;
                                        ?>
                                        <tr style="background-color: #cccccc">
                                            <td ><?php echo $this->lang->line('DIVISION');?></td>
                                            <td >&nbsp;</td>
                                            <td >&nbsp;</td>
                                            <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                            <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total_division); ?></td>
                                        </tr>
                                        <?php
                                        $total_division=0;
                                    }

                                }

                                if(!$report_lists[$i]['total_income'])
                                {
                                    $status = $this->lang->line('NOT_REGISTERED');
                                    $union_total=0;

                                }
                                else
                                {
                                    $status = $this->lang->line('REGISTERED');

                                    $union_total=$report_lists[$i]['total_income'];
                                    $total_amount=$total_amount+$union_total;

                                    $total_zila=$total_zila+$union_total;

                                    $total_division=$total_division+$union_total;

                                    $total=$total+$union_total;

                                }

                                ?>
                                <tr>
                                    <td><?php if($show_division){echo $report_lists[$i]['divname']; $show_division=false;}?></td>
                                    <td><?php if($show_zilla){echo $report_lists[$i]['zillaname']; $show_zilla=false;}?></td>
                                    <td><?php if($show_upzilla){echo $report_lists[$i]['municipalname']; $show_upzilla=false;}?></td>
                                    <td><?php echo $report_lists[$i]['wardname']?></td>
                                    <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($union_total);?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr style="background-color: #cccccc">
                                <td colspan="2"> &nbsp;</td>
                                <td ><?php echo $this->lang->line('MUNICIPALITY');?>  </td>
                                <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total_amount); ?></td>
                            </tr>
                            <tr style="background-color: #cccccc">
                                <td> &nbsp;</td>
                                <td ><?php echo $this->lang->line('ZILLA');?></td>
                                <td >&nbsp;</td>
                                <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total_zila); ?></td>
                            </tr>
                            <tr style="background-color: #cccccc">
                                <td ><?php echo $this->lang->line('DIVISION');?></td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total_division); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><?php echo $this->lang->line('IN_TOTAL');?>: </td>
                                <td style="text-align: center;"><?php echo System_helper::Get_Eng_to_Bng($total); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>