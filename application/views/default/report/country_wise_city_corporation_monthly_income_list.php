<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();

?>
<div id="system_content" class="system_content_margin">
    <div class="col-lg-4">
        <?php
        $CI->load_view("report/report_menus");
        ?>

    </div>
    <div class="col-lg-8">

        <div class="clearfix"></div>
        <form class="report_form" id="system_save_form" action="<?php echo $CI->get_encoded_url('report/country_wise_city_corporation_monthly_income_report/index/list'); ?>" method="get">
            <div class="row widget">
                <div class="widget-header">
                    <div class="title">
                        <?php echo $title; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="row show-grid ">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('MONTH_NAME'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="month" class="form-control">
                            <?php
                            for($i=1; $i<13; $i++)
                            {
                                if(strlen($i)==1)
                                {
                                    $option="0".$i;
                                }
                                else
                                {
                                    $option=$i;
                                }
                                ?>
                                <option value="<?php echo $option;?>"><?php echo System_helper::Get_Bangla_Month($option);?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row show-grid ">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('YEAR'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="year" class="form-control">
                            <?php
                            $start_year=2011;
                            $end_year=date('Y');
                            for($i=$start_year; $i<=$end_year; $i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>"><?php echo System_helper::Get_Eng_to_Bng($i);?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">

                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="submit" class="btn btn-primary" value="<?php echo $CI->lang->line('SEARCH'); ?>">
                    </div>
                </div>

            </div>
        </form>
        <div class="clearfix"></div>

    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript">

</script>