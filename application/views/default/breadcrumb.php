<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
if(isset($breadcrumbs))
{
    $last_index =  key( array_slice( $breadcrumbs, -1, 1, TRUE ) );
    ?>
    <div class="col-lg-12" style="background:#FFF; border-bottom:1px dashed #EEEEEE; margin-bottom:15px; padding-left:5px; ">
        <ul class="breadcrumb system_content col-sm-7" style="margin-bottom: 10px; width: 100%">
            <?php
            foreach($breadcrumbs as $key=>$breadcrumb)
            {
                if($breadcrumb['link'])
                {
                    ?>
                        <li><a href="<?php echo $breadcrumb['link']; ?>"><?php echo $breadcrumb['text'] ?>&nbsp;</a> <span class="divider"><?php echo ($key != $last_index ?'→' :' '); ?></span></li>
                    <?php
                }
                else
                {
                    ?>
                        <li><span style="color: #666666"><?php echo $breadcrumb['text'] ?></span>&nbsp; <span class="divider"><?php echo ($key != $last_index ?'→' :' '); ?></span></li>
                    <?php
                }
                ?>

                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}
?>
