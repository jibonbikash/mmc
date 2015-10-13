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
        <form class="report_form" id="system_save_form" action="<?php echo $CI->get_encoded_url('report/uisc_invested_money_report/index/list'); ?>" method="get">
            <div class="row widget">
                <div class="widget-header">
                    <div class="title">
                        <?php echo $title; ?>
                    </div>
                    <div class="clearfix"></div>
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
    $(document).ready(function ()
    {
        $( ".report_date" ).datepicker({dateFormat : display_date_format});
    });
</script>