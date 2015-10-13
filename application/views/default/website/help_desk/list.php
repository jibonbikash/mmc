<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

//echo "<pre>";
//print_r($services);
//echo "</pre>";

?>

<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/js/prefixfree.min.js"></script>


        <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(http://fonts.googleapis.com/css?family=Dosis:600,200|Great+Vibes);
@import url(http://weloveiconfonts.com/api/?family=fontawesome);
*, *:after, *:before {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}
* {margin:0;padding:0;border: 0 none;position: relative;}
[class*="fontawesome-"]:before {font-family: 'fontawesome', sans-serif;}

html {
  background: #33485E;
  width: 100%;
  height: 100%;
  font-family: dosis, sans-serif;
  font-weight: 300;
  color: #fff;
}

section {
  background: #31A66C;
  width: 80vw;
  max-width: 40rem;
  min-width: 390px;
  height: 25rem;
  margin: 4rem auto;
  box-shadow: 0 0 6px rgba(0,0,0,.4);
}
article {
  position: absolute;
  left: 0;
  top: 5rem;
  right: 0;
  bottom: 0;
  padding: 1rem 2rem 0;
  /*overflow: auto;*/
  margin-bottom:20px;
  transition: .7s;
  transform: scale(0);
  transform-origin: center right;
  transition-delay: .1s;
}
article:before {
  color: rgba(0,0,0,.2);
  font-size: 4rem;
  font-weight: 100;
  position: absolute;
  bottom: 1rem;
  right: 1rem;
}
h2 {
  font-size: 2.5rem;
  font-weight: 600;
  text-align: center;
  color: rgba(0,0,0,.6);
}
h2 img {
  width: 120px;
  height: auto;
  background: #f9f9f9;
  border: 5px solid rgba(0,0,0,.7);
  border-radius: 50%;
  padding: 5px;
  display: block;
  margin: 0 auto;
  box-shadow: 0 0 7px rgba(0,0,0,.5);
}
h2 span {
  font-family: Great Vibes;
  font-weight: 400;
  display: block;
  margin-bottom: 1rem;
}

p, dl, ol {
  line-height: 1.5;
  font-size: 1.3rem;
}
ol li {margin: 0 0 .5rem 1rem;}
dt {
  font-size: 1.6rem;
  font-weight: 600;
  text-indent: 1.5rem;
}
nav {
  background: #fff;
  width: 100%;
  height: 5rem;
  box-shadow: 0 0 6px rgba(0,0,0,.4);
}
nav:after {
  content:'';
  width: 25%;
  height: 5rem;
  background: #BEE3D1;
  position: absolute;
  transition: .5s;
}
input {
  display: none;
}
label {
  width: 25%;
  float: left;
  color: #BEE3D1;
  text-align: center;
  cursor: pointer;
  transition: .5s;
  z-index: 2;
}
label:hover {color: #1E6743;}
label:before {
  display: block;
  font-size: 3rem;
  line-height: 5rem;
  z-index: 2;
}
#profile:checked ~ nav [for='profile'],
#settings:checked ~ nav [for='settings'],
#posts:checked ~ nav [for='posts'],
#books:checked ~ nav [for='books'] {
  color: #1E6743;
  font-weight: 600;
}
#settings:checked ~ nav [for='settings'] {}
#profile:checked ~ nav [for='profile'] {}

#profile:checked ~ nav:after {
  left: 0;
}
#settings:checked ~ nav:after {
  left:25%;
  border-top: 0 none;
}
#posts:checked ~ nav:after {
  left: 50%;
}
#books:checked ~ nav:after {
  left: 75%;
}

#profile:checked ~ .uno,
#settings:checked ~ .dos,
#posts:checked ~ .tres,
#books:checked ~ .cuatro {
  display: block;
  transform: scale(1);
  transition-delay: .5s; 
}
a {color: rgba(0,0,0,.4)}
a:hover {color: rgba(0,0,0,.2)}
    </style>
    
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->

<div id="system_content" class="system_content_margin">

   
    <input type="hidden" name="id" value="<?php if(isset($ServiceInfo['service_id'])){echo $ServiceInfo['service_id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>


			<section>
<input type="radio" id="profile" value="1" name="tractor" checked='checked' />    
<input type="radio" id="settings" value="2" name="tractor" />      
<input type="radio" id="posts" value="3" name="tractor" />
<input type="radio" id="books" value="4" name="tractor" />
  
  <nav>   
  <label for="profile" class='fontawesome-phone'></label>
  <label for="settings" class='fontawesome-envelope'></label>
  <label for="posts" class='fontawesome-lightbulb'></label>
  <label for="books" class='fontawesome-map-marker'></label>
  </nav>
  
  <article class='uno'>
    <h2><span>ফোন</span></h2>
   
   		<li>+88 02 91919191</li>
        <li>+88 02 91919191</li>
        <li>+88 02 91919191</li>
        <li>+88 02 91919191</li>
        
  </article>
  
  <article class='dos fontawesome-envelope'>
    <h2><span>ইমেইল</span></h2>
   		<li>info1@dcms.gov.bd</li>
        <li>info1@dcms.gov.bd</li>
        <li>info1@dcms.gov.bd</li>
        <li>info1@dcms.gov.bd</li>        
  </article>
  
  <article class='tres fontawesome-lightbulb'>
    <h2><span>হেল্প ডেক্স টিকেট সাবমিট</span></h2>
    <ol>
      <li>টিকেট সাবমিট এর পূর্বে নির্দেশিকা পড়ুন</li>
      <li>এই <a href="#">লিঙ্ক</a> হতে টিকেট সাবমিট করুন</li>
    </ol>
  </article>
  
  <article class='cuatro fontawesome-map-marker'>
    <h2><span>ম্যাপ</span></h2>
    
  </article>
</section>
            
        </div>
    </div>
</div>
