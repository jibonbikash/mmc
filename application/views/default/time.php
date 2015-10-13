<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$h='';
$m='';
if(isset($edit_selected_time_int) && !empty($edit_selected_time_int))
{
    $h=date('h', $edit_selected_time_int);
    $m=date('i', $edit_selected_time_int);
    $hour_selected='';
    $minute_selected='';
}
else
{
    $h='';
    $m='';
}
if(isset($hour_name) && !empty($hour_name))
{
    $hour_name=$hour_name;
}
else
{
    $hour_name="hour_name";
}
if(isset($hour_id) && !empty($hour_id))
{
    $hour_id=$hour_id;
}
else
{
    $hour_id="hour_id";
}

if(isset($minute_name) && !empty($minute_name))
{
    $minute_name=$minute_name;
}
else
{
    $minute_name="minute_name";
}
if(isset($minute_id) && !empty($minute_id))
{
    $minute_id=$minute_id;
}
else
{
    $minute_id="minute_id";
}
if(isset($interval) && !empty($interval))
{
    $interval=$interval;
}
else
{
    $interval=1;
}
if(isset($hour_selected) && !empty($hour_selected))
{
    $hour_selected=$hour_selected;
}
else
{
    if(!empty($h))
    {
        $hour_selected=$h;
    }
    else
    {
        $hour_selected=' ';
    }

}
if(isset($minute_selected) && !empty($minute_selected))
{
    $minute_selected=$minute_selected;
}
else
{
    if(!empty($m))
    {
        $minute_selected=$m;
    }
    else
    {
        $minute_selected=' ';
    }

}

//if($drop_down_default_option)
//{
//    $options[]=array('value'=>'','text'=>$this->lang->line('SELECT'));
//}
$options=array();
//$options[]=array('value'=>'','text'=>$this->lang->line('SELECT'));
$hours=$CI->config->item('hour');
foreach($hours as $key=>$hour)
{
    $options[]=array('value'=>$key,'text'=>$hour);
}
?>
<div class="col-xs-6" style="margin-left: 0px; padding-left: 0px">
    <select class="form-control" name="<?php echo $hour_name;?>" id="<?php echo $hour_id;?>">
        <?php
        foreach($options as $option)
        {
            ?>
            <option value="<?php echo $option['value']; ?>" <?php if($option['value']==$hour_selected){echo "selected='selected'";}?>>
                <?php echo $option['text'];?>
            </option>

        <?php
        }
        ?>
    </select>
</div>
<div class="col-xs-6" style="margin-right: 0px; padding-right: 0px">
    <select class="form-control" name="<?php echo $minute_name;?>" id="<?php echo $minute_id;?>">
        <?php

        $total_minute=(60/$interval+1);
        for($i=0; $i<$total_minute-1; $i++)
        {
            $minute=($i*$interval);
            ?>
            <option value="<?php echo $minute; ?>" <?php if($minute==$minute_selected){echo "selected='selected'";}?>>
                <?php if(strlen($minute)==1) {echo "0".$minute;}else{echo $minute;}?>
            </option>

        <?php
        }
        ?>
    </select>
</div>
