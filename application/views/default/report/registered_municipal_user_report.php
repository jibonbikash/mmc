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
                            <th><?php echo $this->lang->line('ENTREPRENEUR_NAME');?></th>
                            <th><?php echo $this->lang->line('MOBILE_NO');?></th>
                            <th><?php echo $this->lang->line('ENTREPRENEUR_TYPE');?></th>
                            <th><?php echo $this->lang->line('STATUS');?></th>
                            <th><?php echo $this->lang->line('PROFILE_PIC');?></th>
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
                            $uisc_type = '';
                            foreach($getUiscInfos as $uisc)
                            {
                                if ($uisc['entrepreneur_type'] == 1)
                                {
                                    $uisc_type =  $this->lang->line('ENTREPRENEUR');
                                }
                                elseif ($uisc['entrepreneur_type'] == 2)
                                {
                                    $uisc_type = $this->lang->line('NOVICE_ENTREPRENEUR');
                                }
                                else
                                {
                                    $uisc_type='';
                                }

                                if ($uisc['status'] == $this->config->item('STATUS_INACTIVE'))
                                {
                                    $status = $this->lang->line('APPLIED');
                                }
                                else if ($uisc['status'] == $this->config->item('STATUS_ACTIVE'))
                                {
                                    $status = $this->lang->line('APPROVED');
                                }
                                else if ($uisc['status'] == $this->config->item('STATUS_REJECT'))
                                {
                                    $status = $this->lang->line('NOT_APPROVED');
                                }
                                else
                                {
                                    $status = '';
                                }
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
                                            echo $uisc['municipalname'];
                                            $show_upzilla = $uisc['municipalname'];
                                            //$currentDate = $preDate;
                                        }
                                        else if ($show_upzilla == $uisc['municipalname'])
                                        {
                                            //exit;
                                            echo "&nbsp;";
                                        }
                                        else
                                        {
                                            echo $uisc['municipalname'];
                                            $show_upzilla = $uisc['municipalname'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($show_union == '')
                                        {
                                            echo $uisc['wardname'];
                                            $show_union = $uisc['wardname'];
                                            //$currentDate = $preDate;
                                        }
                                        else if ($show_union == $uisc['wardname'])
                                        {
                                            //exit;
                                            echo "&nbsp;";
                                        }
                                        else
                                        {
                                            echo $uisc['wardname'];
                                            $show_union = $uisc['wardname'];
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $uisc['entrepreneur_name'] ?></td>
                                    <td><?php echo $uisc['entrepreneur_mobile'] ?></td>
                                    <td><?php echo $uisc_type; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        $image_path=base_url() . "images/entrepreneur/" . $uisc['picture_name'];
                                        if (!empty($uisc['picture_name']))
                                        {
                                            ?>
                                            <img src="<?php echo $image_path; ?>" width="40" title="<?php echo $uisc['picture_name'] ?>" />
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo base_url()."images/profile.png"; ?>" width="40" title="profile image" />
                                        <?php
                                        }
                                        ?>
                                    </td>
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