<?php
/**
	* (Sample) Controller for Showing the use of Captcha*
	* @author     Arvind Kumar (arvind.mailto@gmail.com)
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2014 http://www.devarticles.in/
	* @version 2.5 Tested OK in Cakephp 2.5.4
	*/
class SignupsController extends AppController {

	var $name = 'Signups';
	var $uses = array('Signup');
	var $helpers = array('Html', 'Form', 'Captcha');
	//var $components = array('Captcha'=>array('jquerylib'=>true));//'Captcha'

	function captcha()	{
		$this->autoRender = false;
		$this->layout='ajax';
		if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
			$this->Captcha = $this->Components->load('Captcha', array(
				'width' => 150,
				'height' => 50,
				'theme' => 'random', //possible values : default, random ; No value means 'default'
			)); //load it
			}
		$this->Captcha->create();
	}

	function add()	{
    $this->Captcha = $this->Components->load('Captcha', array('jquerylib'=>true, 'modelName'=>'Signup', 'fieldName'=>'captcha')); //load it

		if(!empty($this->request->data))	{
			/*if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				$this->Captcha = $this->Components->load('Captcha'); //load it
			}*/
			$this->Signup->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
			$this->Signup->set($this->request->data);
			if($this->Signup->validates())	{ //as usual data save call
				//$this->Signup->save($this->request->data);//save or something
				// validation passed, do something
				$this->Session->setFlash('Data Validation Success', 'default', array('class' => 'notice success'));
			}	else	{ //or
				$this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
				//pr($this->Signup->validationErrors);
				//something do something else
			}
		}
	}
}