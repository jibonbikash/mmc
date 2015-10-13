<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$options=array();
if(!isset($drop_down_default_option))
{
    $drop_down_default_option=true;
}
if($drop_down_default_option)
{
    $options[]=array('value'=>'','text'=>$this->lang->line('SELECT'));
}
if(!isset($drop_down_selected))
{
    $drop_down_selected='';
}
if(isset($drop_down_options)&& is_array($drop_down_options)&& (sizeof($drop_down_options)>0))
{
    $keys=array_keys($drop_down_options);
    $first_element=$drop_down_options[$keys[0]];
    if(is_array($first_element))
    {
        $keys=array_keys($first_element);
        $option_value_key=$keys[0];
        $option_text_key=$keys[1];
        if(($keys[0]=='value')||($keys[1]=='value'))
        {
            $option_value_key='value';
        }
        if(($keys[0]=='text')||($keys[1]=='text'))
        {
            $option_text_key='text';
        }
        foreach($drop_down_options as $option)
        {
            $options[]=array('value'=>$option[$option_value_key],'text'=>$option[$option_text_key]);
        }
    }
    else
    {
        foreach($drop_down_options as $option)
        {
            $options[]=array('value'=>$option,'text'=>$option);
        }
    }

}
foreach($options as $option)
{
    ?>
    <option value="<?php echo $option['value']; ?>"
        <?php
        if(is_array($drop_down_selected))
        {
            if(in_array($option['value'], $drop_down_selected))
            {
                echo 'selected';
            }
        }
        elseif($drop_down_selected==$option['value'])
        {
            echo "selected";
        }
        ?>>
        <?php echo $option['text'];?>
    </option>
<?php
}

