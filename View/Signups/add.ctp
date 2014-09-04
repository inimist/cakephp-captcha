<?php
echo $this->Session->flash();
echo $this->Form->create("Signups"); 
$this->Captcha->render($captchaSettings);
echo $this->Form->submit(__(' Submit ',true));
echo $this->Form->end();
?>