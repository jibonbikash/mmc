<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/dashboard.css">

<style>
@import url(http://fonts.googleapis.com/css?family=Lato:300);



.profile-img {
  display: block;
  height: 7em;
  margin-right: auto;
  margin-left: auto;
  border: .5em solid #f2f2f2;
  border-radius: 100%;
  box-shadow:  0 1px 0 0 rgba(0,0,0,.1);
}

.profile-text {
  margin-top: -3.5em;
  padding: 5em 1.5em 1.5em 1.5em; 
  background: white;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1)
}

.profile-name{
  margin-right: -1em;
  margin-bottom: .75em;
  margin-left: -1em;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  padding-bottom: .75em;
  font-size: 1.5em;
  text-transform: uppercase;
}

.profile-title {
  color: #ccc;
  margin-right: -1em;
  margin-bottom: .75em;
  margin-left: -1em;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  padding-bottom: .75em;
}
</style>
<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

<!--<div class="col-sm-1 text-center" style="margin-top: 5px;">
&nbsp;
</div>-->
<div class="col-sm-3 text-center" style="margin-top: 5px;">

  <img src="<?php echo base_url().'images/entrepreneur/'.$user->picture_name; ?>" class="profile-img">
  <div class="profile-text">
    <h1 class="profile-name"><?php echo $this->lang->line('NAME');?> : <?php echo $user->name_bn ?></h1>
    
    <h4 class="profile-title"><?php echo $this->lang->line('PHONE');?> : <?php echo $user->mobile ?></h4>
    <h4 class="profile-title"><?php echo $this->lang->line('EMAIL');?> : <?php echo $user->email ?></h4>
    <h4 class="profile-title"><?php echo $this->lang->line('ADDRESS');?> : <?php echo $user->present_address ?></h4>
    
  </div>
    
</div>    

<div class="col-sm-7 text-center" style="margin-top: 5px;">
    <div class="system_content text-center" style="margin-top: 5px;">
        <div id="container" style="height: 400px"></div>
    </div>
</div>    

<div class="system_content col-sm-2 text-center" style="margin-top: 5px;">

        <ul id="dashboard">

			<li colore="emerald">
                <div class="contenuto">
                    <span class="titolo">সর্বোচ্চ আয়</span>
                    <span class="descrizione"><?php echo sprintf($CI->lang->line('TAKA_WITH_DATA'),Dashboard_helper::get_max_income_uisc($user->zilla,$user->upazila,$user->unioun)); ?></span>
                    <!-- <span class="valore"></span>	 -->
                </div>
            </li>

            <li colore="red">
                <div class="contenuto">
                    <span class="titolo">সর্বনিম্ন আয়</span>
                    <span class="descrizione"><?php echo sprintf($CI->lang->line('TAKA_WITH_DATA'),Dashboard_helper::get_min_income_uisc($user->zilla,$user->upazila,$user->unioun)); ?></span>
                </div>
            </li>

            <li colore="yellow">
                <div class="contenuto">
                    <span class="titolo">বিনিয়োগকৃত টাকা</span>
                    <span class="descrizione"><?php echo sprintf($CI->lang->line('TAKA_WITH_DATA'),Dashboard_helper::get_investment_uisc($user->uisc_id,$user->id)); ?></span>
                </div>
            </li>

            <li colore="lime">
                <div class="contenuto">
                    <span class="titolo">সেন্টারের ধরন</span>
                    <span class="descrizione">
                        <?php
                            $center_location =  Dashboard_helper::get_loacation_info_uisc($user->uisc_id,$user->id);
                            $config = $this->config->item('center_location_info');
                            if(isset($center_location['center_type']))
                            {
                                echo $config[$center_location['center_type']];
                            }
                        ?>
                    </span>
                </div>
            </li>
            <li colore="orange">
                <div class="contenuto">
                    <span class="titolo">বিদ্যুৎ</span>
                    <span class="descrizione">
                        <?php
                            $data = Dashboard_helper::get_electricity_info_uisc($user->uisc_id,$user->id);
                            if(isset($data['electricity']) && $data['electricity'] == 1)
                            {
                                echo $CI->lang->line('YES');
                            }
                            else
                            {
                                echo $CI->lang->line('NO');
                            }
                        ?>
                    </span>
                </div>
            </li>

            
        </ul>

    </div>
    


</div>

<div class="clearfix"></div>
<br/>
<br/>
<br/>
<?php
$week = Dashboard_helper::get_uisc_weekly_income($user);
?>
<script>
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $CI->lang->line('REPORT_TITLE_UISC');?>'
            },
            xAxis: {
                categories: [<?php
             $index=0;
             foreach($week as $day)
             {
                if($index==0)
                {
                    echo "'".$day['day']."'";
                }
                else
                {
                    echo ",'".$day['day']."'";
                }
                $index++;
             }
            ?>]
            },
            yAxis : {
                title : {
                    text : '<?php echo $CI->lang->line('TAKA');?>'
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
                    return this.x + this.series.name+ ' এর মোট আয় ' + this.y + ' টাকা';
                }
            },
            series: [{
                name : ' <?php echo $CI->lang->line('DAY') ?>',
                data: [<?php
             $index=0;
             foreach($week as $day)
             {
                if($index==0)
                {
                    echo $day['income'];
                }
                else
                {
                    echo ",".($day['income']);
                }
                $index++;
             }
            ?>]
            }]
        });
    });

</script>