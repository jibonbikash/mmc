<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_action_button_container" class="system_action_button_container">
    <?php
    //$CI->load_view('system_action_buttons');

    ?>
</div>
<link rel="stylesheet"  href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/light-gallery/css/lightGallery.css"/>
<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/light-gallery/js/lightGallery.js"></script>
<style>
    body {
        background: #e9e9e9;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    	ul{
			list-style: none outside none;
		    padding-left: 0;
		}
		.gallery li {
			display: block;
			float: left;
			height: 100px;
			margin-bottom: 6px;
			margin-right: 6px;
			width: 100px;
		}
		.gallery li a {
			height: 100px;
			width: 100px;
		}
		.gallery li a img {
			max-width: 100px;
		}

</style>
    
    <script type="text/javascript">
  $(document).ready(function() {
    $('#light-gallery').lightGallery({
        showThumbByDefault:true,
        addClass:'showThumbByDefault'
    }); 
  });
  
  
  $(document).ready(function() {
    $("#video").lightGallery(); 
  });
</script>
<div class="clearfix"></div>
<div id="system_content" class="dashboard-wrapper">
<div class="col-lg-12" >
<h3>ছবি কর্নার</h3>

<ul id="light-gallery" class="gallery">
        <li data-src="<?php echo base_url() ?>/images/media/img1.jpg">
        	<a href="#">
            <img src="<?php echo base_url() ?>/images/media/thumb1.jpg" />
            </a>
        </li>
        <li data-src="<?php echo base_url() ?>/images/media/img2.jpg" >
        	<a href="#">
            <img src="<?php echo base_url() ?>/images/media/thumb2.jpg" />
            </a>
        </li>
        <li data-src="<?php echo base_url() ?>/images/media/img3.jpg">
        	<a href="#">
            <img src="<?php echo base_url() ?>/images/media/thumb3.jpg" />
            </a>
        </li>
        <li data-src="<?php echo base_url() ?>/images/media/img4.jpg" >
        	<a href="#">
            <img src="<?php echo base_url() ?>/images/media/thumb4.jpg" />
            </a>
        </li>
        <li data-src="<?php echo base_url() ?>/images/media/img4.jpg" >
        	<a href="#">
            <img src="<?php echo base_url() ?>/images/media/thumb4.jpg" />
            </a>
        </li>
        
</ul>

</div>
<div class="col-lg-12" >
<h3>ভিডিও কর্নার</h3>

<ul id="video" class="gallery">
    <li data-src="http://www.youtube.com/watch?v=eKG08z85DtY"> 
      <a href="#">
        <img src="<?php echo base_url() ?>/images/media/thumb1.jpg" />
      </a> 
    </li>
    <li data-src="http://vimeo.com/1084537"> 
      <a href="#">
        <img src="<?php echo base_url() ?>/images/media/thumb1.jpg" />
      </a> 
    </li>
    <li data-src="http://www.youtube.com/watch?v=c0asJgSyxcY"> 
      <a href="#">
        <img src="<?php echo base_url() ?>/images/media/thumb1.jpg" />
      </a> 
    </li>
    <li data-src="http://vimeo.com/35451452"> 
      <a href="#">
        <img src="<?php echo base_url() ?>/images/media/thumb1.jpg" />
      </a> 
    </li>
</ul>
    
    
</div>
</div>

<div class="clear">
</div>
<div style="line-height:15px;">&nbsp;</div>
</div>
