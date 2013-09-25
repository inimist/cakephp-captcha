<?php
echo $this->Session->flash();
echo $this->Form->create("Signups"); 
//echo $captchaType;
$this->Captcha->render($captchaSettings);
//pr($captchaSettings);
/*echo $this->Html->image($this->Html->url(array('controller'=>'signups', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2));
echo '<p><a href="#" id="a-reload">Can\'t read? Reload</a></p>';
echo '<p>Enter security code shown above:</p>';
echo $this->Form->input('Signup.captcha',array('autocomplete'=>'off','label'=>false,'class'=>''));*/
echo $this->Form->submit(__(' Submit ',true));
echo $this->Form->end();
?>