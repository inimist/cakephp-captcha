<?php
/**
	* (Sample) Model for Showing the use of Captcha*
	* @author     Arvind K. 
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2008 www.devarticles.in
	* @version Tested ok in Cakephp 2.x
	*/
class Signup extends AppModel {
	
    var $useTable = false; //i dont have a table right now, just testing captcha

    public $actsAs = array(
        'Captcha.Captcha' => array(
            'field' => array('security_code'),
            'error' => 'Incorrect captcha code value'
        )
    );
}