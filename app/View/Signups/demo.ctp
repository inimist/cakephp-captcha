<?php
$is_live = $_SERVER['HTTP_HOST']=='localhost' ? false : true;

if($is_live)  { ?>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=808999412449620&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

<?php } ?>
<style>
.creload{margin-left:15px;}
h1, h2, h3, h4{color: inherit;font-family: inherit;}
h2{
font-size:19px;
margin: 5px 0 20px;
background: rgba(0, 0, 0, 0);
}
pre.prettyprint{background: #FCFCFC;border:0;font-size:14px;margin: 0 0 1em 0;}
ul{margin: 0 0 1em 1.5em;}
ul li, p{line-height:1.5em;}
h3{font-size: 17px;}
pre.prettyprint{
box-shadow: none;
-moz-box-shadow: none;
-webkit-box-shadow: none;
border: 1px solid #E9E9E9;
}
</style>
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<table border="0" style="width:1068px;margin:0 auto;" >
	
<!--	<tr style="background: #FFF;">
		<td colspan="2" style="text-align:center;">
			<div style="width:768px;margin:0 auto;">



<div style="text-align:center;width:100%;margin:0 0 20px;">

<?php if($is_live)  { ?>

<script type="text/javascript">
google_ad_client = "ca-pub-3272796785992475";
/* Full Captcha Component Top */
google_ad_slot = "5785933608";
google_ad_width = 728;
google_ad_height = 90;
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<?php } ?>

</div>
		</td>
	</tr>
-->
	<tr style="background: #FFF;">

		<td style="padding-top:15px;">

<p><strong>Share</strong></p>

<?php if($is_live)  { ?>

<table>
	<tr>
		<td><div class="fb-like" data-href="http://www.devarticles.in/cakephp/simple-captcha-component-for-cakephp/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></td>
		<td><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.devarticles.in/cakephp/simple-captcha-component-for-cakephp/" data-via="arvindkthakur">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td></tr><tr>
		<td colspan="2"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="tall" data-annotation="inline" data-width="250" data-href="http://www.devarticles.in/cakephp/simple-captcha-component-for-cakephp/"></div></td>
	</tr>
</table>

<?php } ?>

<p><strong>Support CakePHP Captcha</strong></p>

<div style="">

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="text-align:center;text-align: center;
padding: 10px;
background: #ECECFF;
margin-bottom: 20px;">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GNQRYSLGTX8FS">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online."  style="width:auto;">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

<?php if($is_live)  { ?>

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Captcha-300x600-Right -->
	<ins class="adsbygoogle"
		 style="display:inline-block;width:300px;height:600px"
		 data-ad-client="ca-pub-3272796785992475"
		 data-ad-slot="5500484803"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>

<?php } ?>

</div></td>

		<td style="padding-top: 15px;">

<div id="mainwrapper" style="background: #F7F7F7;padding: 20px;position:relative;border:1px solid #ddd">

<h1 style="font-size:22px;margin:5px 0 20px;background:transparent">CakePHP Captcha component for CakePHP Version 2.x (Demo)</h1>

<p>Here is the latest CakePHP Captcha Support for CakePHP Version 2.5+. Tested up to CakePHP version 2.5.3.</p>

<p><b>DEMO</b></p>

<p style="text-align:right"><?php echo $this->Html->link( __('Single'), array('controller'=>'signups', 'action'=>'demo', 'single')); ?> | <?php echo $this->Html->link( __('Multiple'), array('controller'=>'signups', 'action'=>'demo', 'multiple')); ?> | <?php echo $this->Html->link( __('Math Catcha'), array('controller'=>'signups', 'action'=>'demo', 'math')); ?></p>



<div style="padding:15px 15px 0 15px;margin-bottom:15px;background-color:#fff;">


<?php

switch($ctype):

    case 'single':
 ?>

<style>
.creload{margin-left:5px;}
</style>
<?php
echo $this->Session->flash();
echo $this->Form->create("Signups");
?>
<fieldset style="border: 1px solid #B3B3B3;"><legend style="padding:0 10px;">Sign Up</legend>
<?php
$this->Captcha->render(array('type'=>'image'));
echo $this->Form->submit(__(' Submit ',true));
echo '</fieldset>';
echo $this->Form->end();
//Signup form ends

    break;
    case 'multiple':
?>


<?php
echo $this->Session->flash();
echo $this->Form->create("Signups");

?>
<fieldset style="border: 1px solid #B3B3B3;"><legend style="padding:0 10px;">Basic Theme</legend>

<p>Width: 150, Height: 50, Theme: Basic</p>

<?php

//custom settings for form 1
$custom1['width']=150;
$custom1['height']=50;
$custom1['theme']='default';
$this->Captcha->render($custom1);

echo $this->Form->submit(__(' Submit ',true));
echo '</fieldset>';
echo $this->Form->end();
//First form ends

//second form starts
echo $this->Form->create("Users");


?>
<fieldset style="border: 1px solid #B3B3B3;"><legend style="padding:0 10px;">Random Theme</legend>

<p>Width: 250, Height: 90, Theme: Random</p>

<?php

$custom2['width']=250;
$custom2['height']=90;
$custom2['model']='User';
$custom2['field']='ssecurity';
$custom2['theme']='random';
$this->Captcha->render($custom2);
//pr($this->Session->read('Captcha'));
echo $this->Form->submit(__(' Submit ',true));
echo '</fieldset>';
echo $this->Form->end();


echo $this->Form->create("Contacts");

?>
<fieldset style="border: 1px solid #B3B3B3;"><legend style="padding:0 10px;">Math Captcha</legend>
<?php
$custom3['model']='Contact';
$custom3['field']='math_question';
$custom3['type']='math';
$this->Captcha->render($custom3);
echo $this->Form->submit(__(' Submit ',true));
echo '</fieldset>';
echo $this->Form->end();

    break;

    case 'math':


//second form starts
echo $this->Session->flash();
echo $this->Form->create("Contacts");

    ?>
    <fieldset style="border: 1px solid #B3B3B3;"><legend style="padding:0 10px;">Math Captcha</legend>
    <?php
    $custom3['model']='Contact';
    $custom3['field']='math_question';
    $custom3['type']='math';
    $this->Captcha->render($custom3);
    echo $this->Form->submit(__(' Submit ',true));
    echo '</fieldset>';
    echo $this->Form->end();

    break;
endswitch;
?>

</div>

<h2>Features</h2>

<ul style="margin:0 0 15px 20px;">
	<li>Multiple Captcha Support.<br />
        - It simply supports multiple captchas on a page. In different forms or in a single form.</li>
	<li>Model Validation attahced as Behavior</li>
	<li>Image and/or Simple Math Captchas</li>
	<li>Configurable Model Name, Field Name, Captcha Height, Width, Number of Characters and Font Face, Size, Angle of rotation</li>
	<li>Works without GD Truetype font support</li>
	<li>Random or Fixed Captcha Themes for Image Captchaa</li>
	<li>Random Font face</li>
</ul>

<hr />

<h2>Installation</h2>

<p>Place all files bundled in this package in it's corresponding folders.</p>

<p><strong>In Controller</strong></p>

<p>Add in the top definitions of your controller.</p>

<pre class=prettyprint>
var $components = array('Captcha'=>array('Model'=>'Signup', 'field'=>'captcha'));//'Captcha'
</pre>

<p>Note: "<i>captcha</i>" is the field name for which we are binding this captcha here in examples. Replace with appropriate name.</p>

<p>Add this function in your controller.</p>

<pre class=prettyprint>
function captcha()	{
    $this->autoRender = false;
    $this->layout='ajax';
    $this->Captcha->create();
}
</pre>

<p>Add the similar logic to the function which is action of your form, in your controller. The highlighted line is the one which is related to the captcha component.</p>

<pre class=prettyprint>
function add()	{
    if(!empty($this->request->data))	{
        <span style="background:yellow">$this->Signup->setCaptcha('captcha', $this->Captcha->getCode('Signup.captcha'));</span>
        $this->Signup->set($this->request->data);
        if($this->Signup->validates())	{ //as usual data save call
            // validation passed, do save or something
        }	else	{ //or
            $this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
            //validation not passed, do something else
        }
    }
}
</pre>

<p><strong>In Model</strong></p>

<p>Add CaptchaBehaviour in the Model definitions, as following:</p>

<pre class=prettyprint>
public $actsAs = array(
    'Captcha' => array(
        'field' => array('captcha'),
        'error' => 'Incorrect captcha code value'
    )
);
</pre>

<p><strong>In View</strong></p>

<p>Add form code in the view file, in the form where you want the captcha image to appear:</p>

<pre class=prettyprint>
echo $this->Form->create("Signups");
$this->Captcha->render();
echo $this->Form->submit(__(' Submit ',true));
echo $this->Form->end();
</pre>

<p>And importanly place the following javascript script code in somewhere in your page so it is called properly and execute.</p>

<pre class=prettyprint>
&lt;script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">&lt;/script>
&lt;script>
jQuery('.creload').on('click', function() {
    var mySrc = $(this).prev().attr('src');
    var glue = '?';
    if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
    }
    $(this).prev().attr('src', mySrc + glue + new Date().getTime());
    return false;
});
&lt;/script>
</pre>


<p>That should be it!</p>

<h2>Few more examples</h2>

<p>Example of custom settings:</p>

<pre class=prettyprint>
echo $this->Form->create("Signups");
$custom1['width']=150;
$custom1['height']=50;
$custom1['theme']='default';
$this->Captcha->render($custom1);
</pre>

<p>Example of multiple captchas:</p>

<pre class=prettyprint>
//form 1
echo $this->Form->create("Signups");
$custom1['width']=150;
$custom1['height']=50;
$this->Captcha->render($custom1);

//form 2, A math captcha, anywhere on the page
echo $this->Form->create("Users");
$custom2['type']='math';
$this->Captcha->render($custom2);
</pre>

<p><strong>Options which can be set in your view file with form, are:</strong></p>

<ul>
    <li><em>model</em>: model name.</li>
    <li><em>field</em>: field name.</li>
    <li><em>type</em>: image or math. If set to 'math' all settings given below are ignored</li>
    <li><em>width</em>: width of image captcha</li>
    <li><em>height</em>: height of image captcha</li>
    <li><em>theme</em>: theme/difficulty image captcha</li>
    <li><em>length</em>: number of characters in image captcha</li>
    <li><em>angle</em>: angle of rotation for characters in image captcha</li>
</ul>

<p><strong>There are a few other options which, at the moment, can be set in the component file directly</strong></p>

<h2>Download</h2>

<p><a href="https://github.com/inimist/cakephp-captcha">Download at Github</a></p>


<!-- <ul>
	<li>
	<a href="https://github.com/arvindk/Cakephp-Captcha-Component-v2.5" target="_blank">Download at Github</a></li>
	<li><a href="http://www.devarticles.in/wp-content/uploads/2010/10/CaptchaComponent.zip">Download Captcha Component for Cakephp 1.x
	</a></li>
</ul>
<br />
<p>
<a href="https://github.com/inimist/Cakephp-Captcha-Component-v2.5/archive/master.zip">Download Captcha Component for Cakephp 2.x (Github)</a><br />

<a href="http://www.devarticles.in/wp-content/uploads/2010/10/CaptchaComponent.zip">Download Captcha Component for Cakephp 1.x</a></p> -->

<p><b>Change Log (Updated on)</b> – Septermber 10, 2014</p>

<ul>
    <li>Model Validation works as Behavior</li>
	<li>Supports Multiple Image and Simple Math Captchas</li>
	<li>Works without GD Truetype font support (NOT RECOMMENDED though)</li>
	<li>Default and Random themes for Image Captcha</li>
	<li>Checks for missing font file</li>
</ul>
<br />

<p style="border:2px dashed #333; padding:10px;background:#ffffd0;">
If you should have any question or comment regarding the use of this captcha component please <a href="//devarticles.in/cakephp/simple-captcha-component-for-cakephp/#comments">post it here</a>
</p>


</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
jQuery('.creload').on('click', function() {
    var mySrc = $(this).prev().attr('src');
    var glue = '?';
    if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
    }
    $(this).prev().attr('src', mySrc + glue + new Date().getTime());
    return false;
});
</script>

</div></td>
	</tr>


	<tr style="background: #FFF;">
		<td colspan="2" style="text-align:center;">
			<div style="width:768px;margin:0 auto;">



<div style="text-align:center;width:100%;margin:0 0 20px;padding-top: 10px;">

<?php if($is_live)  { ?>

<script type="text/javascript"><!--
google_ad_client = "ca-pub-3272796785992475";
/* Full Captcha Component Bottom */
google_ad_slot = "1216133205";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<?php } ?>

</div>
		</td>
	</tr>

</table>