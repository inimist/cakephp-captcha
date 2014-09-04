<?php
/**
	* (Sample) Model for Showing the use of Captcha*
	* @author     Arvind K. 
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2008 www.devarticles.in
	* @version Tested ok in Cakephp 2.x
	*/
class Signup extends AppModel {
	
	var $useTable = false; //i dont have a table right now, just testing captcha!
	var $name='Signup';
	var $captcha = ''; //intializing captcha var

	var $validate = array(
			'captcha'=>array(
				'rule' => array('matchCaptcha'),
				'message'=>'Failed validating human check.'
			),
		);

	function matchCaptcha($inputValue)	{
		return $inputValue['captcha']==$this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
	}

	function setCaptcha($value)	{
		$this->captcha = $value; //setting captcha value
	}

	function getCaptcha()	{
		return $this->captcha; //getting captcha value
	}

}