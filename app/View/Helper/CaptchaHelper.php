<?php
/**
	* Helper for Showing the use of Captcha*
	* @author     Arvind Kumar
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2013 http://www.devarticles.in/
  * @version 2.0 - Tested OK in Cakephp 2.4.1
	*/
class CaptchaHelper extends AppHelper {
  public $helpers = array('Html', 'Form');
  function render($settings=array()) {
    switch($settings['captchaType']):
      case 'image':
        echo $this->Html->image($this->Html->url(array('controller'=>'signups', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2));
        echo '<p><a href="#" id="a-reload">Can\'t read? Reload</a></p>';
        echo '<p>Enter security code shown above:</p>';
        echo $this->Form->input($settings['modelName'].'.'.$settings['fieldName'], array('autocomplete'=>'off','label'=>false,'class'=>''));
        if($settings['jquerylib'])  {
          echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
        }
?>
        <script>
        jQuery('#a-reload').click(function() {
          var $captcha = jQuery("#img-captcha");
            $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
          return false;
        });
        </script>
<?php
      break;
      case 'math':
        echo '<p>Answer simple math:</p>'.$settings['stringOperation'].' = ?';
        echo $this->Form->input($settings['modelName'].'.'.$settings['fieldName'],array('autocomplete'=>'off','label'=>false,'class'=>''));
      break;
    endswitch;
  }
}