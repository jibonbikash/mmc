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
    <title><?php echo $title;?></title>
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
                    <th><?php echo $this->lang->line('UPAZILLA_NAME');?></th>
                    <th><?php echo $this->lang->line('UNION_NAME');?></th>
                    <th><?php echo $this->lang->line('UISC_NAME');?></th>
                    <th><?php echo $this->lang->line('ENTREPRENEUR_NAME');?></th>
                    <th><?php echo $this->lang->line('INVESTED_MONEY_AMOUNT');?></th>
                    <th><?php echo $this->lang->line('SELF_INVESTMENT');?></th>
                    <th><?php echo $this->lang->line('INVEST_DEBT');?></th>
                    <th><?php echo $this->lang->line('INVEST_SECTOR');?></th>
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
                    $show_division = '';
                    $show_zilla = '';
                    $show_upzilla = '';
                    $show_union='';
                    $show_uisc='';

                    foreach($getUiscInfos as $uisc)
                    {
                        ?>
                        <tr>
                            <td>
                                <?php
                                if ($show_division == '')
                                {
                                    echo $uisc['divname'];
                                    $show_division = $uisc['divname'];
                                    //$currentDate = $preDate;
                                }
                                else if ($show_division == $uisc['divname'])
                                {
                                    //exit;
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $uisc['divname'];
                                    $show_division = $uisc['divname'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($show_zilla == '')
                                {
                                    echo $uisc['zillaname'];
                                    $show_zilla = $uisc['zillaname'];
                                    //$currentDate = $preDate;
                                }
                                else if ($show_zilla == $uisc['zillaname'])
                                {
                                    //exit;
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $uisc['zillaname'];
                                    $show_zilla = $uisc['zillaname'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($show_upzilla == '')
                                {
                                    echo $uisc['upazilaname'];
                                    $show_upzilla = $uisc['upazilaname'];
                                    //$currentDate = $preDate;
                                }
                                else if ($show_upzilla == $uisc['upazilaname'])
                                {
                                    //exit;
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $uisc['upazilaname'];
                                    $show_upzilla = $uisc['upazilaname'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($show_union == '')
                                {
                                    echo $uisc['unionname'];
                                    $show_union = $uisc['unionname'];
                                    //$currentDate = $preDate;
                                }
                                else if ($show_union == $uisc['unionname'])
                                {
                                    //exit;
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $uisc['unionname'];
                                    $show_union = $uisc['unionname'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($show_uisc == '')
                                {
                                    echo $uisc['uisc_name'];
                                    $show_uisc = $uisc['uisc_name'];
                                    //$currentDate = $preDate;
                                }
                                else if ($show_uisc == $uisc['uisc_name'])
                                {
                                    //exit;
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $uisc['uisc_name'];
                                    $show_uisc = $uisc['uisc_name'];
                                }
                                ?>
                            </td>
                            <td><?php echo $uisc['entrepreneur_name'] ?></td>
                            <td><?php echo $uisc['invested_money']?$uisc['invested_money']:0; ?></td>
                            <td><?php echo $uisc['self_investment']?$uisc['self_investment']:0; ?></td>
                            <td><?php echo $uisc['invest_debt']?$uisc['invest_debt']:0; ?></td>
                            <td><?php echo $uisc['invest_sector'] ?></td>
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
</body>
</html>