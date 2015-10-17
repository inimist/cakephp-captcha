<?php
/**
	* (Sample) Model for Showing the use of Captcha*
	* @author     Arvind K. 
	* @link       http://www.devarticles.in/
	* @copyright  Copyright © 2008 www.devarticles.in
	* @version Tested ok in Cakephp 2.x
	*/
class User extends AppModel {
	
    var $useTable = false; //i dont have a table right now, just testing captcha

    public $actsAs = array(
        'Captcha' => array(
            'field' => array('ssecurity'),
            'error' => 'Incorrect captcha code value'
        )
    );
}