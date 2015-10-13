<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
//echo "<pre>";
//print_r($getUiscInfos);
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
                            <th><?php echo $this->lang->line('UISC_REGISTRATION_STATUS');?></th>
                            <th><?php echo $this->lang->line('TOTAL_UISC_PDC');?></th>
                            <th><?php echo $this->lang->line('TOTAL_MALE');?></th>
                            <th><?php echo $this->lang->line('TOTAL_FEMALE');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(empty($getUiscInfos))
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
                            $total_upazila=0;
                            $total_upazila_man=0;
                            $total_upazila_woman=0;
                            $total_zila=0;
                            $total_zila_man=0;
                            $total_zila_woman=0;

                            $total_division=0;
                            $total_division_man=0;
                            $total_division_woman=0;

                            $total=0;
                            $total_man=0;
                            $total_woman=0;


                            for ($i = 0; $i < sizeof($getUiscInfos); $i++)
                            {
                                if($i==0)
                                {
                                    $show_division=true;
                                    $show_zilla=true;
                                    $show_upzilla=true;
                                }
                                else
                                {



                                    if($getUiscInfos[$i]['municipalid']!=$getUiscInfos[$i-1]['municipalid'])
                                    {
                                        $show_upzilla=true;

                                        ?>
                                        <tr style="background-color: #cccccc">
                                            <td colspan="2"> &nbsp;</td>
                                            <td ><?php echo $this->lang->line('MUNICIPALITY');?> </td>
                                            <td >&nbsp;</td>
                                            <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                            <td style="text-align: center;"><?php echo $total_upazila; ?></td>
                                            <td style="text-align: center;"><?php echo $total_upazila_man; ?></td>
                                            <td style="text-align: center;"><?php echo $total_upazila_woman; ?></td>
                                        </tr>
                                        <?php
                                        $total_upazila=0;
                                        $total_upazila_man=0;
                                        $total_upazila_woman=0;

                                    }
                                    if($getUiscInfos[$i]['zillaid']!=$getUiscInfos[$i-1]['zillaid'])
                                    {
                                        $show_zilla=true;
                                        ?>
                                        <tr style="background-color: #cccccc">
                                            <td> &nbsp;</td>
                                            <td ><?php echo $this->lang->line('ZILLA');?></td>
                                            <td >&nbsp;</td>
                                            <td >&nbsp;</td>
                                            <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                            <td style="text-align: center;"><?php echo $total_zila; ?></td>
                                            <td style="text-align: center;"><?php echo $total_zila_man; ?></td>
                                            <td style="text-align: center;"><?php echo $total_zila_woman; ?></td>
                                        </tr>
                                        <?php
                                        $total_zila=0;
                                        $total_zila_man=0;
                                        $total_zila_woman=0;
                                    }
                                    if($getUiscInfos[$i]['divid']!=$getUiscInfos[$i-1]['divid'])
                                    {
                                        $show_division=true;
                                        ?>
                                        <tr style="background-color: #cccccc">
                                            <td ><?php echo $this->lang->line('DIVISION');?></td>
                                            <td >&nbsp;</td>
                                            <td >&nbsp;</td>
                                            <td >&nbsp;</td>
                                            <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                            <td style="text-align: center;"><?php echo $total_division; ?></td>
                                            <td style="text-align: center;"><?php echo $total_division_man; ?></td>
                                            <td style="text-align: center;"><?php echo $total_division_woman; ?></td>
                                        </tr>
                                        <?php
                                        $total_division=0;
                                        $total_division_man=0;
                                        $total_division_woman=0;
                                    }

                                }

                                if(!$getUiscInfos[$i]['total_uisc'])
                                {
                                    $status = $this->lang->line('NOT_REGISTERED');
                                    $union_total=0;
                                    $union_man=0;
                                    $union_woman=0;

                                }
                                else
                                {
                                    $status =  $this->lang->line('REGISTERED');

                                    $union_man=0;
                                    $union_woman=0;

                                    $union_man=$getUiscInfos[$i]['total_male_user'];
                                    $union_woman=$getUiscInfos[$i]['total_female_user'];
                                    if(sizeof($getUiscInfos)>($i+1))
                                    {

                                        if(($getUiscInfos[$i]['divid']==$getUiscInfos[$i+1]['divid'])&&($getUiscInfos[$i]['zillaid']==$getUiscInfos[$i+1]['zillaid'])&&($getUiscInfos[$i]['municipalid']==$getUiscInfos[$i+1]['municipalid'])&&($getUiscInfos[$i]['wardid']==$getUiscInfos[$i+1]['wardid']))
                                        {
                                            $i++;

                                            $union_man=$union_man+$getUiscInfos[$i]['total_male_user'];
                                            $union_woman=$union_woman+$getUiscInfos[$i]['total_female_user'];
                                        }

                                    }
                                    $union_total=$getUiscInfos[$i]['total_uisc'];
                                    $total_upazila=$total_upazila+$union_total;
                                    $total_upazila_man=$total_upazila_man+$union_man;
                                    $total_upazila_woman=$total_upazila_woman+$union_woman;

                                    $total_zila=$total_zila+$union_total;
                                    $total_zila_man=$total_zila_man+$union_man;
                                    $total_zila_woman=$total_zila_woman+$union_woman;

                                    $total_division=$total_division+$union_total;
                                    $total_division_man=$total_division_man+$union_man;
                                    $total_division_woman=$total_division_woman+$union_woman;

                                    $total=$total+$union_total;
                                    $total_man=$total_man+$union_man;
                                    $total_woman=$total_woman+$union_woman;

                                }

                                ?>
                                <tr>
                                    <td><?php if($show_division){echo $getUiscInfos[$i]['divname']; $show_division=false;}?></td>
                                    <td><?php if($show_zilla){echo $getUiscInfos[$i]['zillaname']; $show_zilla=false;}?></td>
                                    <td><?php if($show_upzilla){echo $getUiscInfos[$i]['municipalname']; $show_upzilla=false;}?></td>
                                    <td><?php echo $getUiscInfos[$i]['wardname']?></td>
                                    <td><?php echo $status;?></td>
                                    <td style="text-align: center;"><?php echo $union_total;?></td>
                                    <td style="text-align: center;"><?php echo $union_man;?></td>
                                    <td style="text-align: center;"><?php echo $union_woman;?></td>

                                </tr>
                            <?php
                            }
                            ?>
                            <tr style="background-color: #cccccc">
                                <td colspan="2"> &nbsp;</td>
                                <td ><?php echo $this->lang->line('MUNICIPALITY');?> </td>
                                <td >&nbsp;</td>
                                <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                <td style="text-align: center;"><?php echo $total_upazila; ?></td>
                                <td style="text-align: center;"><?php echo $total_upazila_man; ?></td>
                                <td style="text-align: center;"><?php echo $total_upazila_woman; ?></td>
                            </tr>
                            <tr style="background-color: #cccccc">
                                <td> &nbsp;</td>
                                <td ><?php echo $this->lang->line('ZILLA');?></td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                <td style="text-align: center;"><?php echo $total_zila; ?></td>
                                <td style="text-align: center;"><?php echo $total_zila_man; ?></td>
                                <td style="text-align: center;"><?php echo $total_zila_woman; ?></td>
                            </tr>
                            <tr style="background-color: #cccccc">
                                <td ><?php echo $this->lang->line('DIVISION');?></td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td align="right"><?php echo $this->lang->line('TOTAL');?>:</td>
                                <td style="text-align: center;"><?php echo $total_division; ?></td>
                                <td style="text-align: center;"><?php echo $total_division_man; ?></td>
                                <td style="text-align: center;"><?php echo $total_division_woman; ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right"><?php echo $this->lang->line('IN_TOTAL');?>: </td>
                                <td style="text-align: center;"><?php echo $total; ?></td>
                                <td style="text-align: center;"><?php echo $total_man; ?></td>
                                <td style="text-align: center;"><?php echo $total_woman; ?></td>
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