<?php
echo $this->Session->flash();
echo $this->Form->create("Signups"); 
echo $this->Html->image($this->Html->url(array('controller'=>'signups', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2));
echo '<p><a href="#" id="a-reload">Can\'t read? Reload</a></p>';
echo '<p>Enter security code shown above:</p>';
echo $this->Form->input('Signup.captcha',array('autocomplete'=>'off','label'=>false,'class'=>''));
echo $this->Form->submit(__(' Submit ',true));
echo $this->Form->end();
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
jQuery('#a-reload').click(function() {
	var $captcha = jQuery("#img-captcha");
    $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
	return false;
});
</script>