<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
//echo "<pre>";
//print_r($user);
//echo "</pre>";
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/dashboard.css">

<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

    <div class="system_content col-sm-2 text-center" >
        <div class="shadow curved-2">
            <img src="<?php echo base_url();?>images/dashboard/office.png" width="40">
            <br/>
            <h4><?php echo sprintf($CI->lang->line('TOTAL_DIGITAL_CENTER'),Dashboard_helper::get_center_count_division($user->division)); ?></h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center" >
        <div class="shadow curved-2">
            <img src="<?php echo base_url();?>images/dashboard/user_female.png" width="40">
            <br/>
            <h4><?php echo sprintf($CI->lang->line('TOTAL_USERS'),Dashboard_helper::get_uisc_user_count_division($user->division,$CI->config->item('GENDER_FEMALE'))); ?></h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center" >
        <div class="shadow curved-2">
            <img src="<?php echo base_url();?>images/dashboard/user_male.png" width="40">
            <br/>
            <h4><?php echo sprintf($CI->lang->line('TOTAL_USERS'),Dashboard_helper::get_uisc_user_count_division($user->division,$CI->config->item('GENDER_MALE'))); ?></h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center" >
        <div class="shadow curved-2">
            <img src="<?php echo base_url();?>images/dashboard/network_service.png" width="40">
            <br/>
            <h4><?php echo sprintf($CI->lang->line('TOTAL_SERVICES'),Dashboard_helper::get_division_services($user->division)); ?></h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center" >
        <div class="shadow curved-2">
            <img src="<?php echo base_url();?>images/dashboard/report_check.png" width="40">
            <br/>
            <h4><?php echo sprintf($CI->lang->line('TOTAL_INVOICES'),Dashboard_helper::get_total_invoices_division($user->division)); ?></h4>
        </div>
    </div>

    <div class="system_content col-sm-2 text-center" >
        <div class="shadow curved-2">
            <img src="<?php echo base_url();?>images/dashboard/taka.png" width="40">
            <br/>
            <h4><?php echo sprintf($CI->lang->line('TOTAL'),Dashboard_helper::get_total_invoice_income_division($user->division)); ?></h4>
        </div>
    </div>

</div>

<br/>
<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

    <div class="system_content col-sm-7 text-center" style="margin-top: 5px;">
        <div id="container" style="height: 400px"></div>
    </div>

    <div class="system_content col-sm-3 text-center" style="margin-top: 5px;">
        <div id="pie_container" style="height: 400px;"></div>
    </div>

    <div class="system_content col-sm-2 text-center" style="margin-top: 5px;">
        <ul id="dashboard">
            <li colore="red">
                <div class="contenuto">
                    <span class="titolo">ডিজিটাল সেন্টার</span>
                    <span class="descrizione">নিস্ক্রিয় সেন্টার</span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'),Dashboard_helper::get_total_inactive_center_division($user->division)); ?></span>
                </div>
            </li>

            <li colore="yellow">
                <div class="contenuto">
                    <span class="titolo">অনুমোদন</span>
                    <span class="descrizione">আবেদনের সংখ্যা</span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'),Dashboard_helper::get_total_approval_division($user->division)); ?></span>
                </div>
            </li>

            <li colore="lime">
                <div class="contenuto">
                    <span class="titolo">নোটিশ</span>
                    <span class="descrizione">সক্রিয় তথ্য</span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'),Dashboard_helper::get_total_notice_division()); ?></span>
                </div>
            </li>
            <li colore="orange">
                <div class="contenuto">
                    <span class="titolo">প্রশ্নোত্তর</span>
                    <span class="descrizione">উত্তরের অপেক্ষায়</span>
                    <span class="valore"><?php echo sprintf($CI->lang->line('TI'),Dashboard_helper::get_total_faqs_division($user->division)); ?></span>
                </div>
            </li>

            <li colore="emerald">
                <div class="contenuto">
                    <span class="titolo">সেরা (গতকাল)</span>
                    <span class="descrizione">কলমাকান্দা ডিজিটাল সেন্টার </span>
                    <!-- <span class="valore"></span>	 -->
                </div>
            </li>
        </ul>
    </div>
</div>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->
<?php
$district_info=Dashboard_helper::get_district_wise_income($user->division);
$total_male_female=Dashboard_helper::get_total_male_female_user_division($user->division);
?>
<script>
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $CI->lang->line('REPORT_TITLE_DISTRICTS');?>'
            },
            xAxis: {
                categories: [<?php
             $index=0;
             foreach($district_info as $district)
             {
                if($index==0)
                {
                    echo "'".$district['name']."'";
                }
                else
                {
                    echo ",'".$district['name']."'";
                }
                $index++;
             }
            ?>]
            },
            yAxis : {
                title : {
                    text : '<?php echo $CI->lang->line('TAKA_LAC');?>'
                },
                min : 0
            },
            plotOptions: {
                series: {
                    pointWidth: 35//width of the column bars irrespective of the chart size
                }
            },
            tooltip: {
                formatter: function() {
                    return this.x + this.series.name+ ' এর মোট সাপ্তাহিক আয় ' + this.y + ' লক্ষ টাকা';
                }
            },
            series: [{
                name : ' <?php echo $CI->lang->line('ZILLA') ?>',
                data: [<?php
             $index=0;
             foreach($district_info as $district)
             {
                if($index==0)
                {
                    echo ($district['income'] ? $district['income']/100000 : 0);
                }
                else
                {
                    echo ",".($district['income'] ? $district['income']/100000 : 0);
                }
                $index++;
             }
            ?>]
            }]
        });

        //////////// PIE CHART ///////////////
        $('#pie_container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '<?php echo $CI->lang->line('SERVICE_USER_DATA') ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Brands",
                colorByPoint: true,
                data: [{
                    name: "<?php echo $CI->lang->line('FEMALE_SERVICE_USER') ?>",
                    y:  <?php echo $total_male_female['female'] ?>
                }, {
                    name: "<?php echo $CI->lang->line('MALE_SERVICE_USER') ?>",
                    y:  <?php echo $total_male_female['male'] ?>,
                    sliced: true,
                    selected: true
                }]
            }]
        });
    });

</script>
