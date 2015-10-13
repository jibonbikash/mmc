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
                            <th><?php echo $this->lang->line('MODEM');?></th>
                            <th><?php echo $this->lang->line('CONNECTION_TYPE');?></th>
                            <th><?php echo $this->lang->line('IP_ADDRESS');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(is_array($devices) && sizeof($devices)>0)
                    {
                        foreach($devices as $key=>$device)
                        {
                        ?>
                            <tr>
                                <td><?php echo $device['modem'];?></td>
                                <td><?php echo $device['connection_type'];?></td>
                                <td><?php echo $device['ip_address'];?></td>
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